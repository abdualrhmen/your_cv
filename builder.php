<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>صانع السير الذاتية | مساحة العمل ومحرر القوالب</title>
  
  <!-- خط تجوال من Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  
  <!-- ملفات التنسيقات -->
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="cv-templates.css">
</head>
<body>

  <!-- ========================================================================
       1. الهيدر العام (Site Header)
       ======================================================================== -->
  <header class="site-header no-print">
    <div class="header-inner">
      <!-- الشعار -->
      <a href="index.php" class="site-logo">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
          <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        <span>صانع السير الذاتية</span>
      </a>

      <!-- روابط التنقل -->
      <nav class="main-nav">
        <a href="index.php" class="nav-link">الرئيسية</a>
        <a href="templates.php" class="nav-link">القوالب</a>
        <a href="#pricing" class="nav-link">الأسعار</a>
        <a href="#about" class="nav-link">حولنا</a>
      </nav>

      <!-- أزرار الإجراء -->
      <div class="header-actions">
        <a href="#login" class="btn-login">تسجيل الدخول</a>
        <a href="templates.php" class="btn-start">تغيير القالب</a>
      </div>
    </div>
  </header>

  <!-- ========================================================================
       2. واجهة مساحة العمل (Builder Layout)
       القسم الأيمن: نافذة إدخال البيانات والخطوات (25%)
       القسم الأيسر: المعاينة الحية لورقة A4 للقالب المختار (75%)
       ======================================================================== -->
  <main class="builder-layout">

    <!-- القسم الأيمن: نافذة وشريط إدخال البيانات -->
    <aside class="builder-sidebar no-print">
      
      <div>
        <div class="sidebar-heading-area">
          <h2 class="sidebar-title">خطوات البناء</h2>
          <p class="sidebar-subtitle">أكمل بياناتك وتابع التحديث المباشر على القالب</p>
        </div>

        <!-- شريط اختيار وتبديل القالب لحظياً -->
        <div class="template-selector-bar">
          <span class="template-selector-label">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="3" y1="9" x2="21" y2="9"></line>
              <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
            القالب:
          </span>
          <select id="themeSelect" class="template-dropdown">
            <option value="theme-professional">1. المسار الاحترافي</option>
            <option value="theme-creative">2. القالب الإبداعي</option>
            <option value="theme-modern">3. الرؤية الحديثة</option>
            <option value="theme-comprehensive">4. الاحترافي الشامل</option>
          </select>
        </div>

        <!-- قائمة الخطوات الأربع -->
        <ul class="steps-list">
          <li class="step-item active" data-step="1">
            <span class="step-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <span class="step-text">المعلومات الشخصية</span>
          </li>

          <li class="step-item" data-step="2">
            <span class="step-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
              </svg>
            </span>
            <span class="step-text">الخبرة العملية</span>
          </li>

          <li class="step-item" data-step="3">
            <span class="step-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path>
              </svg>
            </span>
            <span class="step-text">التعليم والمؤهلات</span>
          </li>

          <li class="step-item" data-step="4">
            <span class="step-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
              </svg>
            </span>
            <span class="step-text">المهارات والمشاريع</span>
          </li>
        </ul>

        <!-- نافذة ونموذج إدخال البيانات (Form) المربوط حياً -->
        <form id="cvBuilderForm" class="builder-form-wrapper" action="save_cv.php" method="post" enctype="multipart/form-data">
          
          <!-- القسم 1: المعلومات الشخصية -->
          <div class="step-panel active" id="panel-1">
            <!-- رفع الصورة الشخصية -->
            <div class="sidebar-avatar-upload">
              <img id="sidebarAvatarImg" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='%230b7a6f'%3E%3Cpath d='M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z' opacity='0.85'/%3E%3C/svg%3E" alt="معاينة الصورة" class="sidebar-avatar-preview">
              <div class="avatar-upload-action">
                <label for="in-photo" class="btn-upload-label">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                  </svg>
                  <span>تغيير الصورة الشخصية</span>
                </label>
                <input type="file" id="in-photo" name="profile_image" accept="image/*">
                <span class="form-hint">الصيغ المدعومة: JPG, PNG, WEBP</span>
              </div>
            </div>

            <div class="form-group">
              <label for="in-name">الاسم الكامل</label>
              <input type="text" id="in-name" name="full_name" value="عبدالرحمن الحميدي" required>
            </div>

            <div class="form-group">
              <label for="in-title">المسمى الوظيفي</label>
              <input type="text" id="in-title" name="job_title" value="مهندس برمجيات أول ومطور نظم سحابية" required>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="in-phone">رقم الهاتف</label>
                <input type="tel" id="in-phone" name="phone" value="+966 50 123 4567" required>
              </div>
              <div class="form-group">
                <label for="in-email">البريد الإلكتروني</label>
                <input type="email" id="in-email" name="email" value="abdulrahman@example.com" required>
              </div>
            </div>

            <div class="form-group">
              <label for="in-location">المدينة / الدولة</label>
              <input type="text" id="in-location" name="location" value="الرياض، المملكة العربية السعودية">
            </div>

            <div class="form-group">
              <label for="in-bio">النبذة الشخصية (Bio)</label>
              <textarea id="in-bio" name="bio" rows="4">مهندس برمجيات متمرس بخبرة تتجاوز 6 سنوات في تصميم وبناء التطبيقات السحابية عالية الأداء وقواعد البيانات المتطورة. متخصص في هندسة النظم وتطوير واجهات المستخدم التفاعلية وفق أعلى معايير الجودة والأمان.</textarea>
            </div>
          </div>

          <!-- القسم 2: الخبرة العملية -->
          <div class="step-panel" id="panel-2">
            <div class="form-group">
              <label for="in-experience">الخبرات الوظيفية (كل خبرة في سطر، افصل بين المسمى والشركة والوصف بنجمة *)</label>
              <textarea id="in-experience" name="experience" rows="8">كبير مهندسي البرمجيات * شركة الحلول الرقمية المتقدمة (2022 - الآن) * قيادة فريق تطوير المنصات السحابية وتحسين كفاءة استهلاك الموارد بنسبة 40% وتأمين واجهات الويب.
مطور Full-Stack * مؤسسة تقنية المستقبل (2019 - 2022) * تطوير تطبيقات الويب التفاعلية وإدارة قواعد البيانات وتطبيق معايير CI/CD في نشر النظم.</textarea>
              <span class="form-hint">مثال: المسمى الوظيفي * الشركة والفترة * الوصف والمهام</span>
            </div>
          </div>

          <!-- القسم 3: التعليم والمؤهلات -->
          <div class="step-panel" id="panel-3">
            <div class="form-group">
              <label for="in-education">المؤهلات الأكاديمية (كل مؤهل في سطر، افصل بين الدرجة والجامعة بنجمة *)</label>
              <textarea id="in-education" name="education" rows="6">بكالوريوس في علوم الحاسب والمعلومات * جامعة الملك سعود (2015 - 2019) * مع مرتبة الشرف الأولى ومشروع تخرج متميز في الذكاء الاصطناعي.</textarea>
              <span class="form-hint">مثال: المؤهل * الجامعة والسنة * التقدير</span>
            </div>
          </div>

          <!-- القسم 4: المهارات والمشاريع -->
          <div class="step-panel" id="panel-4">
            <div class="form-group">
              <label for="in-skills">المهارات التقنية (مهارة واحدة في كل سطر)</label>
              <textarea id="in-skills" name="skills" rows="4">تطوير الواجهات (HTML5, CSS3, JS)
برمجة السيرفر (PHP, Node.js)
قواعد البيانات (MySQL, PostgreSQL)
الحوسبة السحابية (AWS, Docker)
تصميم المعماريات وتكامل النظم
إدارة الإصدارات (Git, GitHub)</textarea>
            </div>

            <div class="form-group">
              <label for="in-projects">أبرز المشاريع (كل مشروع في سطر، افصل بين العنوان والوصف بنجمة *)</label>
              <textarea id="in-projects" name="projects" rows="4">منصة الفوترة والمدفوعات السحابية * تطوير نظام مدفوعات متكامل يدعم ملايين العمليات الشهرية مع بوابات الدفع الإلكتروني وتشفير البيانات.
تطبيق إدارة العمليات اللوجستية * لوحة تحكم لحظية لتتبع مسارات الشحنات وإدارة المخزون وتقديم تحليلات بيانية دقيقة لصناع القرار.</textarea>
            </div>
          </div>

          <!-- زر الحفظ في MySQL -->
          <div style="margin-top: 14px;">
            <button type="submit" id="btnSaveCv" class="btn-pdf-download" style="width:100%; border:none; background-color:#0b7a6f; color:#ffffff;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
              </svg>
              <span>حفظ السيرة الذاتية</span>
            </button>
          </div>

        </form>
      </div>

      <!-- أزرار الإجراءات السفلية -->
      <div class="sidebar-bottom-actions">
        <button type="button" class="btn-pdf-download" onclick="window.print()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
          <span>تحميل وتصدير PDF</span>
        </button>

        <a href="templates.php" class="btn-edit-data">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
          </svg>
          <span>تصفح قوالب أخرى</span>
        </a>
      </div>

    </aside>

    <!-- القسم الأيسر: منطقة المعاينة الحية لورقة A4 (75%) -->
    <section class="builder-preview-area">
      
      <!-- ====================================================================
           هيكل HTML الموحد الوحيد للقوالب الأربعة (Single Unified DOM)
           يتغير شكل الورقة بالكامل فقط بتغيير الـ Class في الحاوية الرئيسية
           ==================================================================== -->
      <div id="cv-container" class="theme-professional" dir="rtl">

        <!-- 1. رأس السيرة الذاتية (Header) -->
        <header class="cv-header" id="cv-header">
          
          <div class="cv-header-top">
            <!-- بيانات الاسم والمسمى -->
            <div class="cv-identity-box">
              <h1 id="cv-name">عبدالرحمن الحميدي</h1>
              <p id="cv-title">مهندس برمجيات أول ومطور نظم سحابية</p>
            </div>

            <!-- الصورة الشخصية -->
            <div class="cv-photo-box">
              <img id="cv-image" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140' viewBox='0 0 24 24' fill='%230b7a6f'%3E%3Cpath d='M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z' opacity='0.85'/%3E%3C/svg%3E" alt="الصورة الشخصية">
            </div>
          </div>

          <!-- معلومات الاتصال -->
          <div class="cv-contact-box" id="cv-contact">
            <div class="cv-contact-item">
              <span class="contact-icon">📞</span>
              <span id="cv-phone">+966 50 123 4567</span>
            </div>
            <div class="cv-contact-item">
              <span class="contact-icon">✉️</span>
              <span id="cv-email">abdulrahman@example.com</span>
            </div>
            <div class="cv-contact-item">
              <span class="contact-icon">📍</span>
              <span id="cv-location">الرياض، المملكة العربية السعودية</span>
            </div>
          </div>

        </header>

        <!-- 2. جسم السيرة الذاتية الرئيسي (Main Content) -->
        <main class="cv-main" id="cv-main">

          <!-- قسم النبذة الشخصية (Bio) -->
          <section class="cv-section cv-bio-section" id="section-bio">
            <div class="cv-section-header">
              <h2 class="cv-section-title">الملخص المهني</h2>
              <span class="cv-section-line"></span>
            </div>
            <p id="cv-bio">
              مهندس برمجيات متمرس بخبرة تتجاوز 6 سنوات في تصميم وبناء التطبيقات السحابية عالية الأداء وقواعد البيانات المتطورة. متخصص في هندسة النظم وتطوير واجهات المستخدم التفاعلية وفق أعلى معايير الجودة والأمان.
            </p>
          </section>

          <!-- قسم الخبرة العملية (Experience) -->
          <section class="cv-section cv-exp-section" id="section-experience">
            <div class="cv-section-header">
              <h2 class="cv-section-title">الخبرة العملية</h2>
              <span class="cv-section-line"></span>
            </div>
            <div class="cv-timeline" id="cv-experience">
              
              <div class="timeline-item">
                <div class="item-head">
                  <h3 class="item-title">كبير مهندسي البرمجيات</h3>
                  <span class="item-date">2022 - الآن</span>
                </div>
                <div class="item-subtitle">شركة الحلول الرقمية المتقدمة | الرياض</div>
                <p class="item-desc">
                  قيادة فريق تطوير المنصات السحابية، تحسين كفاءة استهلاك الموارد بنسبة 40%، وتأمين الواجهات البرمجية وتوسيعها.
                </p>
              </div>

              <div class="timeline-item">
                <div class="item-head">
                  <h3 class="item-title">مطور Full-Stack</h3>
                  <span class="item-date">2019 - 2022</span>
                </div>
                <div class="item-subtitle">مؤسسة تقنية المستقبل | الرياض</div>
                <p class="item-desc">
                  تطوير تطبيقات الويب التفاعلية، بناء وإدارة قواعد البيانات، والمشاركة في أتمتة عمليات النشر والاختبار المستمر (CI/CD).
                </p>
              </div>

            </div>
          </section>

          <!-- قسم التعليم والمؤهلات (Education) -->
          <section class="cv-section cv-edu-section" id="section-education">
            <div class="cv-section-header">
              <h2 class="cv-section-title">التعليم والمؤهلات</h2>
              <span class="cv-section-line"></span>
            </div>
            <div class="cv-edu-list" id="cv-education">
              
              <div class="edu-item">
                <div class="item-head">
                  <h3 class="item-title">بكالوريوس في علوم الحاسب والمعلومات</h3>
                  <span class="item-date">2015 - 2019</span>
                </div>
                <div class="item-subtitle">جامعة الملك سعود | مع مرتبة الشرف الأولى</div>
                <p class="item-desc">مشروع التخرج: بناء نظام ذكي لإدارة وتوزيع البيانات بالذكاء الاصطناعي.</p>
              </div>

            </div>
          </section>

          <!-- قسم المهارات التقنية (Skills) -->
          <section class="cv-section cv-skills-section" id="section-skills">
            <div class="cv-section-header">
              <h2 class="cv-section-title">المهارات التقنية</h2>
              <span class="cv-section-line"></span>
            </div>
            <div class="cv-skills-grid" id="cv-skills">
              <div class="skill-pill">تطوير الواجهات (HTML5, CSS3, JS)</div>
              <div class="skill-pill">برمجة السيرفر (PHP, Node.js)</div>
              <div class="skill-pill">قواعد البيانات (MySQL, PostgreSQL)</div>
              <div class="skill-pill">الحوسبة السحابية (AWS, Docker)</div>
              <div class="skill-pill">تصميم المعماريات وتكامل النظم</div>
              <div class="skill-pill">إدارة الإصدارات (Git, GitHub)</div>
            </div>
          </section>

          <!-- قسم المشاريع والإنجازات (Projects) -->
          <section class="cv-section cv-projects-section" id="section-projects">
            <div class="cv-section-header">
              <h2 class="cv-section-title">أبرز المشاريع</h2>
              <span class="cv-section-line"></span>
            </div>
            <div class="cv-projects-grid" id="cv-projects">
              
              <div class="project-card">
                <h4 class="project-title">منصة الفوترة والمدفوعات السحابية</h4>
                <p class="project-desc">
                  تطوير نظام مدفوعات متكامل يدعم ملايين العمليات الشهرية مع بوابات الدفع الإلكتروني وتشفير البيانات.
                </p>
              </div>

              <div class="project-card">
                <h4 class="project-title">تطبيق إدارة العمليات اللوجستية</h4>
                <p class="project-desc">
                  لوحة تحكم لحظية لتتبع مسارات الشحنات وإدارة المخزون وتقديم تحليلات بيانية دقيقة لصناع القرار.
                </p>
              </div>

            </div>
          </section>

        </main>

      </div>

      <!-- أزرار التحكم الصغيرة العائمة على يمين الورقة -->
      <div class="floating-zoom-toolbar no-print">
        <button type="button" class="zoom-btn" id="btnZoomIn" title="تكبير الورقة">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            <line x1="11" y1="8" x2="11" y2="14"></line>
            <line x1="8" y1="11" x2="14" y2="11"></line>
          </svg>
        </button>

        <button type="button" class="zoom-btn" id="btnZoomOut" title="تصغير الورقة">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            <line x1="8" y1="11" x2="14" y2="11"></line>
          </svg>
        </button>

        <span class="zoom-divider"></span>

        <button type="button" class="zoom-btn" id="btnFullscreen" title="ملء الشاشة">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <polyline points="15 3 21 3 21 9"></polyline>
            <polyline points="9 21 3 21 3 15"></polyline>
            <line x1="21" y1="3" x2="14" y2="10"></line>
            <line x1="3" y1="21" x2="10" y2="14"></line>
          </svg>
        </button>
      </div>

    </section>

  </main>

  <!-- ========================================================================
       3. الفوتر العام (Site Footer)
       ======================================================================== -->
  <footer class="site-footer no-print">
    <div class="footer-inner">
      <div class="footer-brand">صانع السير الذاتية</div>
      <div class="footer-author">
        <img class="footer-author-avatar" src="uploads/abdulrahman.jpg" alt="صورة م/ عبد الرحمن الحميدي" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <span class="footer-author-fallback" aria-hidden="true">م ع</span>
        <div>تصميم وتطوير: م/ عبد الرحمن الحميدي<small>&copy; 2026 جميع الحقوق محفوظة</small></div>
      </div>
      <ul class="footer-links">
        <li><a href="#privacy">سياسة الخصوصية</a></li>
        <li><a href="#terms">شروط الخدمة</a></li>
        <li><a href="#contact">اتصل بنا</a></li>
      </ul>
    </div>
  </footer>

  <!-- محرك القوالب والربط الحي المحدث -->
  <script src="builder.js"></script>
</body>
</html>
