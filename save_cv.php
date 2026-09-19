<?php
/**
 * =======================================================
 * save_cv.php - نقطة اتصال AJAX لمعالجة وحفظ بيانات السيرة
 * =======================================================
 * يستقبل البيانات عبر طلب POST باستخدام Fetch API (FormData).
 * يقوم بالتحقق من المدخلات، ورفع الصورة الشخصية بأمان، ثم
 * حفظ البيانات في جدول cv_data باستخدام Prepared Statements.
 */

// تعيين ترويسة الاستجابة كـ JSON وتشفير UTF-8
header('Content-Type: application/json; charset=utf-8');

// التأكد من أن الطلب تم عبر طريقة POST فقط
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status'  => 'error',
        'message' => 'طريقة الطلب غير مسموح بها (Only POST method is allowed).'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// استدعاء ملف الاتصال بقاعدة البيانات
require_once __DIR__ . '/db.php';

try {
    // 1. استقبال وتطهير البيانات النصية (Sanitization)
    $full_name = isset($_POST['full_name']) ? trim(strip_tags($_POST['full_name'])) : '';
    $job_title = isset($_POST['job_title']) ? trim(strip_tags($_POST['job_title'])) : '';
    $phone     = isset($_POST['phone'])     ? trim(strip_tags($_POST['phone'])) : '';
    $email     = isset($_POST['email'])     ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
    $location  = isset($_POST['location'])  ? trim(strip_tags($_POST['location'])) : '';
    $bio       = isset($_POST['bio'])        ? trim($_POST['bio']) : '';
    $experience = isset($_POST['experience']) ? trim($_POST['experience']) : '';
    $education = isset($_POST['education']) ? trim($_POST['education']) : '';
    $skills    = isset($_POST['skills'])     ? trim($_POST['skills']) : '';
    $projects  = isset($_POST['projects'])   ? trim($_POST['projects']) : '';

    // التحقق من الحقول الأساسية الإلزامية
    if (empty($full_name) || empty($job_title) || empty($email) || empty($phone)) {
        echo json_encode([
            'status'  => 'error',
            'message' => 'يرجى تعبئة جميع الحقول الأساسية: الاسم، المسمى الوظيفي، الهاتف، والبريد الإلكتروني.'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status'  => 'error',
            'message' => 'صيغة البريد الإلكتروني غير صحيحة، يرجى كتابة بريد صالح (مثال: name@example.com).'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 2. معالجة رفع الصورة الشخصية (إن وجدت)
    $image_path = null;
    $upload_dir = __DIR__ . '/uploads/';

    // التأكد من وجود مجلد uploads وإنشائه إن لم يكن موجوداً
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'تعذر إنشاء مجلد رفع الصور uploads على الخادم. يرجى التحقق من صلاحيات المجلد.'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['profile_image'];

        // التحقق من أكواد أخطاء الرفع
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE   => 'حجم الصورة يتجاوز الحد المسموح به في إعدادات السيرفر.',
                UPLOAD_ERR_FORM_SIZE  => 'حجم الصورة يتجاوز الحد المسموح به في النموذج.',
                UPLOAD_ERR_PARTIAL    => 'تم رفع جزء من ملف الصورة فقط، يرجى المحاولة ثانية.',
                UPLOAD_ERR_NO_TMP_DIR => 'المجلد المؤقت للرفع غير متوفر على السيرفر.',
                UPLOAD_ERR_CANT_WRITE => 'فشل في كتابة وحفظ ملف الصورة على القرص.',
                UPLOAD_ERR_EXTENSION  => 'تم إيقاف رفع الملف بواسطة إضافة برمجية في PHP.',
            ];
            $errMessage = $uploadErrors[$file['error']] ?? ('خطأ أثناء رفع الصورة رقم: ' . $file['error']);
            echo json_encode(['status' => 'error', 'message' => $errMessage], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // الحد الأقصى 5 ميجابايت
        $max_size = 5 * 1024 * 1024;
        if ($file['size'] > $max_size) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'حجم الصورة كبير جداً. الحد الأقصى المسموح به هو 5 ميجابايت.'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // التحقق من نوع الملف المرفوع
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $allowed_mimes = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
            'image/gif'  => 'gif'
        ];

        if (!array_key_exists($mime_type, $allowed_mimes)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'نوع الملف غير مدعوم. الصيغ المسموحة هي: JPG, PNG, WEBP, GIF.'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // توليد اسم فريد للصورة
        $extension = $allowed_mimes[$mime_type];
        $new_filename = 'cv_' . bin2hex(random_bytes(8)) . '_' . time() . '.' . $extension;
        $destination = $upload_dir . $new_filename;

        // نقل الملف المؤقت إلى مجلد uploads
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'فشل في حفظ الصورة داخل مجلد uploads. يرجى مراجعة الصلاحيات.'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $image_path = 'uploads/' . $new_filename;
    }

    // 3. إدخال البيانات في قاعدة البيانات باستخدام Prepared Statements
        $sql = "INSERT INTO `cv_data`
            (`full_name`, `job_title`, `phone`, `email`, `location`, `bio`, `experience`, `education`, `skills`, `projects`, `image_path`)
            VALUES (:full_name, :job_title, :phone, :email, :location, :bio, :experience, :education, :skills, :projects, :image_path)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name'  => $full_name,
        ':job_title'  => $job_title,
        ':phone'      => $phone,
        ':email'      => $email,
        ':location'   => $location,
        ':bio'        => $bio,
        ':experience' => $experience,
        ':education'  => $education,
        ':skills'     => $skills,
        ':projects'   => $projects,
        ':image_path' => $image_path
    ]);

    $lastInsertId = $pdo->lastInsertId();

    // 4. إرجاع استجابة النجاح
    echo json_encode([
        'status'     => 'success',
        'message'    => 'تم حفظ السيرة الذاتية بنجاح في قاعدة البيانات!',
        'id'         => $lastInsertId,
        'image_path' => $image_path
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    error_log('CV Builder database error: ' . $e->getMessage());
    echo json_encode([
        'status'  => 'error',
        'message' => 'حدث خطأ أثناء تسجيل البيانات في قاعدة البيانات.'
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    error_log('CV Builder unexpected error: ' . $e->getMessage());
    echo json_encode([
        'status'  => 'error',
        'message' => 'حدث خطأ غير متوقع أثناء معالجة الطلب.'
    ], JSON_UNESCAPED_UNICODE);
}
