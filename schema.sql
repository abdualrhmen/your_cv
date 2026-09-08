-- =======================================================
-- هيكل قاعدة بيانات تطبيق صانع السيرة الذاتية (Live CV Builder)
-- Database Schema for CV Builder Application
-- =======================================================

CREATE DATABASE IF NOT EXISTS `cv_builder_db` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `cv_builder_db`;

-- إنشاء جدول حفظ بيانات السير الذاتية
CREATE TABLE IF NOT EXISTS `cv_data` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(150) NOT NULL COMMENT 'الاسم الكامل',
  `job_title` VARCHAR(150) NOT NULL COMMENT 'المسمى الوظيفي',
  `phone` VARCHAR(50) NOT NULL COMMENT 'رقم الهاتف',
  `email` VARCHAR(150) NOT NULL COMMENT 'البريد الإلكتروني',
  `bio` TEXT NULL COMMENT 'النبذة الشخصية',
  `skills` TEXT NULL COMMENT 'المهارات المدخلة',
  `projects` TEXT NULL COMMENT 'المشاريع المدخلة',
  `image_path` VARCHAR(255) NULL COMMENT 'مسار الصورة المرفوعة في المجلد uploads',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'تاريخ ووقت الإنشاء'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
