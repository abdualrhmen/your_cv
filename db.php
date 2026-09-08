<?php
/**
 * =======================================================
 * db.php - ملف الاتصال بقاعدة البيانات (MySQL via PDO)
 * =======================================================
 * يستخدم تقنية PDO الآمنة مع Prepared Statements لمنع هجمات SQL Injection.
 * يقوم بتهيئة قاعدة البيانات وإنشاء جدول cv_data تلقائياً عند التشغيل الأول.
 */

// إعدادات الاتصال بقاعدة البيانات (افتراضيات XAMPP / WampServer)
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'cv_builder_db';
$charset  = 'utf8mb4';

try {
    // 1. الاتصال المبدئي بخادم MySQL للتأكد من وجود قاعدة البيانات وإنشائها إن لزم
    $initDsn = "mysql:host={$host};charset={$charset}";
    $tempPdo = new PDO($initDsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    // إنشاء قاعدة البيانات إن لم تكن متوفرة
    $tempPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

    // 2. الاتصال الفعلي بقاعدة بيانات المشروع
    $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,        // إطلاق الاستثناءات عند الأخطاء البرمجية
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,            // استرجاع السجلات كمصفوفة تجميعية
        PDO::ATTR_EMULATE_PREPARES   => false,                        // استخدام الاستعلامات المجهزة الحقيقية من المحرك
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // 3. التحقق من وجود جدول cv_data وإنشاؤه تلقائياً ليعمل المشروع فوراً دون تدخل يدوي
    $tableSql = "CREATE TABLE IF NOT EXISTS `cv_data` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(150) NOT NULL,
        `job_title` VARCHAR(150) NOT NULL,
        `phone` VARCHAR(50) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `bio` TEXT NULL,
        `skills` TEXT NULL,
        `projects` TEXT NULL,
        `image_path` VARCHAR(255) NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($tableSql);

} catch (PDOException $e) {
    // في حالة استدعاء الملف عبر طلب AJAX نرجع الخطأ بصيغة JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' 
        || (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false)) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status'  => 'error',
            'message' => 'فشل الاتصال بقاعدة البيانات: ' . $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // للمتصفح العادي
    die('خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}
