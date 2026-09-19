<?php
declare(strict_types=1);

// عدّل هذه القيم وفق بيانات XAMPP أو InfinityFree قبل النشر.
$db_host = '127.0.0.1';
$db_name = 'cv_builder_db';
$db_user = 'root';
$db_password = '';
$db_charset = 'utf8mb4';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";

try {
    $pdo = new PDO($dsn, $db_user, $db_password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $exception) {
    error_log('CV Builder database connection failed: ' . $exception->getMessage());

    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status' => 'error',
        'message' => 'تعذر الاتصال بقاعدة البيانات. تحقق من إعدادات db.php وبيانات MySQL.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
