<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صانع السير الذاتية التفاعلي | Live CV Builder</title>
    
    <!-- خط تجوال (Tajawal) من Google Fonts لدعم اللغة العربية بتنسيق عصري -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- ملف التنسيقات الأساسي -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- تحديث المشروع للتجربة -->
    <!-- الترويسة الرئيسية للتطبيق (Header) -->
    <header class="main-header no-print">
        <div class="header-container">
            <div class="logo-area">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <span class="logo-text">صانع السير الذاتية</span>
            </div>
            
            <div class="header-actions">
                <button type="button" id="btnPrint" class="btn btn-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                    طباعة / تصدير PDF
                </button>
            </div>
        </div>
    </header>

    <!-- منطقة التنبيهات المنبثقة (Toast Notification) -->
    <div id="toastNotification" class="toast hidden no-print" role="alert">
        <div class="toast-content">
            <span id="toastIcon" class="toast-icon"></span>
            <span id="toastMessage" class="toast-message"></span>
        </div>
    </div>

    <!-- نظام الشاشة المقسومة (Split-Screen Layout) -->
    <main class="app-layout">
        
        <!-- القسم الأيمن: نموذج إدخال البيانات (Form Controls) -->
        <aside class="editor-pane no-print">
            <div class="editor-card">
                <div class="pane-title">
                    <h2>بيانات السيرة الذاتية</h2>
                    <p>أدخل بياناتك وسيتم تحديث ورقة السيرة الذاتية تلقائياً وبشكل حي.</p>
                </div>

                <form id="cvForm" enctype="multipart/form-data" novalidate>
                    
                    <!-- قسم رفع الصورة الشخصية -->
                    <div class="form-section">
                        <label class="section-label">الصورة الشخصية</label>
                        <div class="avatar-upload-box">
                            <div class="avatar-input-wrapper">
                                <input type="file" id="profile_image" name="profile_image" accept="image/*">
                                <label for="profile_image" class="avatar-upload-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>اختر صورة شخصية</span>
                                </label>
                            </div>
                            <small class="field-hint">الصيغ المدعومة: JPG, PNG, WEBP (الحد الأقصى 3MB)</small>
                        </div>
                    </div>

                    <!-- قسم البيانات الشخصية الأساسية -->
                    <div class="form-section">
                        <label class="section-label">المعلومات الشخصية</label>
                        
                        <div class="form-group">
                            <label for="full_name">الاسم الكامل <span class="required">*</span></label>
                            <input type="text" id="full_name" name="full_name" placeholder="مثال: أحمد المنصور" required>
                        </div>

                        <div class="form-group">
                            <label for="job_title">المسمى الوظيفي <span class="required">*</span></label>
                            <input type="text" id="job_title" name="job_title" placeholder="مثال: مهندس برمجيات ومطور واجهات" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">رقم الهاتف <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" placeholder="مثال: +966 50 123 4567" required>
                            </div>

                            <div class="form-group">
                                <label for="email">البريد الإلكتروني <span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="مثال: ahmed@example.com" required>
                            </div>
                        </div>
                    </div>

                    <!-- قسم النبذة الشخصية -->
                    <div class="form-section">
                        <label class="section-label" for="bio">النبذة الشخصية (Bio)</label>
                        <div class="form-group">
                            <textarea id="bio" name="bio" rows="4" placeholder="اكتب ملخصاً مهنياً يبرز خبراتك وشغفك في مجال عملك..."></textarea>
                        </div>
                    </div>

                    <!-- قسم المهارات -->
                    <div class="form-section">
                        <label class="section-label" for="skills">المهارات (Skills)</label>
                        <div class="form-group">
                            <textarea id="skills" name="skills" rows="4" placeholder="اكتب كل مهارة في سطر مستقل. يمكنك إضافة تصنيف أو مستوى بفصله بنجمة *.
مثال:
تطوير واجهات المستخدم * متقدم
PHP & MySQL * خبير
تصميم UI/UX * جيد جداً
إدارة قواعد البيانات * متقدم"></textarea>
                            <small class="field-hint">نصيحة: افصل اسم المهارة عن مستواها بعلامة النجمة (*).</small>
                        </div>
                    </div>

                    <!-- قسم المشاريع -->
                    <div class="form-section">
                        <label class="section-label" for="projects">المشاريع (Projects)</label>
                        <div class="form-group">
                            <textarea id="projects" name="projects" rows="5" placeholder="اكتب كل مشروع في سطر مستقل مع فصل العنوان عن الوصف بنجمة *.
مثال:
منصة تجارة إلكترونية * متجر تفاعلي متكامل يدعم الدفع الإلكتروني وتتبع الشحنات ولوحة تحكم متقدمة.
نظام إدارة عيادات * تطبيق ويب لإدارة حجوزات المرضى والتقارير الطبية بكفاءة عالية."></textarea>
                            <small class="field-hint">نصيحة: افصل عنوان المشروع عن الوصف التفصيلي بعلامة النجمة (*).</small>
                        </div>
                    </div>

                    <!-- زر الحفظ عبر AJAX -->
                    <div class="form-actions">
                        <button type="submit" id="btnSave" class="btn btn-primary btn-block">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="btn-icon">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            <span class="btn-text">حفظ السيرة الذاتية</span>
                            <span class="spinner hidden" id="saveSpinner"></span>
                        </button>
                    </div>

                </form>
            </div>
        </aside>

        <!-- القسم الأيسر: المعاينة الحية لورقة السيرة الذاتية (Live A4 Preview) -->
        <section class="preview-pane">
            <div class="preview-workspace">
                
                <!-- ورقة السيرة الذاتية المحاكية لقياس A4 -->
                <article class="cv-sheet" id="cvSheet">
                    
                    <!-- الترويسة الرئيسية لقالب السيرة (CV Header) -->
                    <header class="cv-header">
                        <div class="cv-header-content">
                            <!-- الصورة الشخصية -->
                            <div class="cv-avatar-container">
                                <img id="previewAvatar" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140' viewBox='0 0 24 24' fill='%230d746f'%3E%3Cpath d='M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z' opacity='0.8'/%3E%3C/svg%3E" alt="الصورة الشخصية" class="cv-avatar">
                            </div>

                            <!-- معلومات الاسم والمسمى -->
                            <div class="cv-identity">
                                <h1 id="previewName" class="cv-name">أحمد المنصور</h1>
                                <p id="previewTitle" class="cv-title">مهندس برمجيات ومطور واجهات ويب</p>
                            </div>
                        </div>

                        <!-- شريط معلومات التواصل (Contact Bar) -->
                        <div class="cv-contact-bar">
                            <div class="contact-item">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span id="previewPhone">+966 50 123 4567</span>
                            </div>

                            <div class="contact-item">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span id="previewEmail">ahmed@example.com</span>
                            </div>
                        </div>
                    </header>

                    <!-- جسم السيرة الذاتية (CV Body) -->
                    <div class="cv-body">
                        
                        <!-- قسم النبذة الشخصية -->
                        <section class="cv-block">
                            <div class="block-heading">
                                <span class="heading-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <h3 class="block-title">النبذة الشخصية</h3>
                            </div>
                            <p id="previewBio" class="bio-paragraph">
                                مطور ويب متمرس وشغوف بابتكار حلول برمجية تفاعلية وعالية الأداء. أمتلك خبرة عملية في تطوير تطبيقات الويب الحديثة، بناء قواعد البيانات الآمنة، وتصميم تجارب مستخدم متميزة تلبي تطلعات الشركات ورواد الأعمال.
                            </p>
                        </section>

                        <!-- قسم المهارات (CSS Grid Cards) -->
                        <section class="cv-block">
                            <div class="block-heading">
                                <span class="heading-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                </span>
                                <h3 class="block-title">المهارات التقنية والمهنية</h3>
                            </div>
                            <!-- الشبكة المخصصة للمهارات -->
                            <div id="previewSkillsGrid" class="skills-grid">
                                <!-- يتم التوليد التلقائي بواسطة Dynamic Parser في JavaScript -->
                            </div>
                        </section>

                        <!-- قسم المشاريع (CSS Grid Cards) -->
                        <section class="cv-block">
                            <div class="block-heading">
                                <span class="heading-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                </span>
                                <h3 class="block-title">المشاريع والإنجازات</h3>
                            </div>
                            <!-- الشبكة المخصصة للمشاريع -->
                            <div id="previewProjectsGrid" class="projects-grid">
                                <!-- يتم التوليد التلقائي بواسطة Dynamic Parser في JavaScript -->
                            </div>
                        </section>

                    </div>

                </article>

            </div>
        </section>

    </main>

    <!-- ملف التفاعلات الحية والجافاسكربت -->
    <script src="script.js"></script>
</body>
</html>
