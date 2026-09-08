<?php
/**
 * =======================================================
 * db.php - ملف الاتصال بقاعدة البيانات (MySQL via PDO)
 * =======================================================
 * يدعم الاتصال المرن عبر 127.0.0.1 و localhost لتفادي مشاكل الـ IPv6.
 * يقوم بإنشاء قاعدة البيانات وجدول cv_data تلقائياً عند التشغيل الأول.
 */

$username = 'root';
$password = '';
$dbname   = 'cv_builder_db';
$charset  = 'utf8mb4';

$pdo = null;
$lastError = null;

// محاولة الاتصال عبر 127.0.0.1 أولاً ثم localhost لتجنب مشاكل دقة أسماء النطاقات في ويندوز
$hosts = ['127.0.0.1', 'localhost'];

foreach ($hosts as $host) {
    try {
        // 1. الاتصال لإنشاء قاعدة البيانات إن لم تكن متوفرة
        $tempDsn = "mysql:host={$host};charset={$charset}";
        $tempPdo = new PDO($tempDsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 2
        ]);
        $tempPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

        // 2. الاتصال الفعلي بقاعدة البيانات
        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        // 3. التحقق من وجود جدول cv_data وإنشاؤه تلقائياً
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

        // تم الاتصال بنجاح، إنهاء حلقة المحاولات
        break;

    } catch (PDOException $e) {
        $lastError = $e->getMessage();
    }
}

// في حال فشل الاتصال مع كافة العناوين
if (!$pdo) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status'  => 'error',
        'message' => 'تعذر الاتصال بخادم MySQL. يرجى التأكد من تشغيل MySQL في لوحة XAMPP (تفاصيل الخطأ: ' . $lastError . ')'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
