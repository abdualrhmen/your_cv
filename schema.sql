CREATE TABLE IF NOT EXISTS `cv_data` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(150) NOT NULL COMMENT 'الاسم الكامل',
  `job_title` VARCHAR(150) NOT NULL COMMENT 'المسمى الوظيفي',
  `phone` VARCHAR(50) NOT NULL COMMENT 'رقم الهاتف',
  `email` VARCHAR(150) NOT NULL COMMENT 'البريد الإلكتروني',
  `location` VARCHAR(150) NULL COMMENT 'المدينة والدولة',
  `bio` TEXT NULL COMMENT 'النبذة الشخصية',
  `experience` TEXT NULL COMMENT 'الخبرات العملية',
  `education` TEXT NULL COMMENT 'المؤهلات الأكاديمية',
  `skills` TEXT NULL COMMENT 'المهارات المدخلة',
  `projects` TEXT NULL COMMENT 'المشاريع المدخلة',
  `image_path` VARCHAR(255) NULL COMMENT 'مسار الصورة المرفوعة في المجلد uploads',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'تاريخ ووقت الإنشاء'
);
