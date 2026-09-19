<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>صانع السير الذاتية | اختر قالبك الجديد</title>
  
  <!-- خط تجوال من Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  
  <!-- ملف التنسيقات الشامل -->
  <link rel="stylesheet" href="global.css">
</head>
<body>

  <!-- ========================================================================
       1. الهيدر العام (Site Header)
       ======================================================================== -->
  <header class="site-header">
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

      <!-- روابط التنقل (القوالب نشطة) -->
      <nav class="main-nav">
        <a href="index.php" class="nav-link">الرئيسية</a>
        <a href="templates.php" class="nav-link active">القوالب</a>
        <a href="#pricing" class="nav-link">الأسعار</a>
        <a href="#about" class="nav-link">حولنا</a>
      </nav>

      <!-- أزرار الإجراء -->
      <div class="header-actions">
        <a href="#login" class="btn-login">تسجيل الدخول</a>
        <a href="builder.php?theme=theme-professional" class="btn-start">ابدأ الآن</a>
      </div>
    </div>
  </header>

  <main class="container">
    <!-- ========================================================================
         2. عنوان ووصف صفحة القوالب الجديدة
         ======================================================================== -->
    <header class="templates-page-header">
      <h1>اختر قالب سيرتك الذاتية</h1>
      <p>اختر من بين القوالب الاحترافية الأربعة المصممة بأعلى معايير التوظيف، وانقر على أي قالب لفتحه مباشرة مع نافذة تعبئة البيانات.</p>
      
      <!-- أزرار الفلترة الأفقية -->
      <div class="filter-tabs">
        <button type="button" class="filter-btn active" data-filter="all">الكل</button>
        <button type="button" class="filter-btn" data-filter="classic">كلاسيكي</button>
        <button type="button" class="filter-btn" data-filter="creative">إبداعي</button>
        <button type="button" class="filter-btn" data-filter="modern">حديث</button>
      </div>
    </header>

    <!-- ========================================================================
         3. شبكة القوالب الأربعة الجديدة (CSS Grid)
         ======================================================================== -->
    <section class="templates-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));">

      <!-- القالب 1: المسار الاحترافي (theme-professional) -->
      <article class="template-card featured" data-category="classic">
        <span class="card-badge selected">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          محدد
        </span>
        <div class="template-thumb-wrap">
          <!-- محاكاة القالب الأول بصرياً: صورة أعلى اليسار، اسم أعلى اليمين، خطوط خضراء -->
          <svg viewBox="0 0 300 400" width="100%" height="100%">
            <rect width="300" height="400" fill="#ffffff"/>
            <!-- الهيدر -->
            <rect x="130" y="30" width="140" height="10" rx="3" fill="#2c3e50"/>
            <rect x="170" y="46" width="100" height="6" rx="2" fill="#0b7a6f"/>
            <circle cx="50" cy="45" r="24" fill="#ffffff" stroke="#0b7a6f" stroke-width="2"/>
            <circle cx="50" cy="45" r="18" fill="#e2e8f0"/>
            <line x1="25" y1="85" x2="275" y2="85" stroke="#e2e8f0" stroke-width="1.5"/>
            <!-- الأقسام مع الخط الأخضر الأفقي بجوار العنوان -->
            <rect x="190" y="105" width="85" height="7" rx="2" fill="#0b7a6f"/>
            <line x1="25" y1="108" x2="180" y2="108" stroke="#0b7a6f" stroke-width="1.5" stroke-opacity="0.4"/>
            <rect x="25" y="122" width="250" height="4" rx="2" fill="#94a3b8"/>
            <rect x="25" y="132" width="220" height="4" rx="2" fill="#94a3b8"/>

            <rect x="190" y="160" width="85" height="7" rx="2" fill="#0b7a6f"/>
            <line x1="25" y1="163" x2="180" y2="163" stroke="#0b7a6f" stroke-width="1.5" stroke-opacity="0.4"/>
            <rect x="25" y="178" width="250" height="35" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
            <rect x="25" y="220" width="250" height="35" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>

            <rect x="190" y="275" width="85" height="7" rx="2" fill="#0b7a6f"/>
            <line x1="25" y1="278" x2="180" y2="278" stroke="#0b7a6f" stroke-width="1.5" stroke-opacity="0.4"/>
            <rect x="25" y="295" width="120" height="40" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
            <rect x="155" y="295" width="120" height="40" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
          </svg>
        </div>
        <div class="template-info">
          <h3 class="template-title">المسار الاحترافي</h3>
          <p class="template-desc">كلاسيكي، نظيف وبسيط، خلفية بيضاء بالكامل مع خطوط خضراء</p>
          <a href="builder.php?theme=theme-professional" class="btn-select-template btn-filled">اختيار هذا القالب</a>
        </div>
      </article>

      <!-- القالب 2: القالب الإبداعي (theme-creative) -->
      <article class="template-card" data-category="creative">
        <span class="card-badge new">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          جديد
        </span>
        <div class="template-thumb-wrap">
          <!-- محاكاة القالب الثاني: شريط جانبي 30% داكن يميناً، 70% أبيض يساراً -->
          <svg viewBox="0 0 300 400" width="100%" height="100%">
            <rect width="300" height="400" fill="#ffffff"/>
            <!-- الشريط الجانبي الداكن (30% يميناً) -->
            <rect x="210" y="0" width="90" height="400" fill="#2c3e50"/>
            <circle cx="255" cy="55" r="26" fill="#ffffff" stroke="#0b7a6f" stroke-width="3"/>
            <rect x="220" y="100" width="70" height="4" rx="2" fill="#ffffff"/>
            <rect x="220" y="112" width="60" height="3" rx="1.5" fill="#5eead4"/>
            <rect x="220" y="122" width="65" height="3" rx="1.5" fill="#5eead4"/>
            <line x1="220" y1="140" x2="290" y2="140" stroke="#475569" stroke-width="1"/>
            <rect x="220" y="155" width="70" height="15" rx="3" fill="#0b7a6f"/>
            <rect x="220" y="175" width="70" height="15" rx="3" fill="#0b7a6f"/>
            <rect x="220" y="195" width="70" height="15" rx="3" fill="#0b7a6f"/>
            <!-- القسم الأيسر (70% أبيض) -->
            <rect x="30" y="35" width="140" height="10" rx="3" fill="#0b7a6f"/>
            <rect x="60" y="52" width="110" height="6" rx="2" fill="#2c3e50"/>
            <rect x="30" y="75" width="160" height="3" rx="1.5" fill="#94a3b8"/>
            <rect x="30" y="83" width="140" height="3" rx="1.5" fill="#94a3b8"/>
            <!-- أقسام المحتوى -->
            <rect x="110" y="115" width="60" height="6" rx="2" fill="#0b7a6f"/>
            <rect x="30" y="130" width="160" height="45" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
            <rect x="110" y="195" width="60" height="6" rx="2" fill="#0b7a6f"/>
            <rect x="30" y="210" width="160" height="45" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
            <rect x="110" y="275" width="60" height="6" rx="2" fill="#0b7a6f"/>
            <rect x="30" y="290" width="160" height="45" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
          </svg>
        </div>
        <div class="template-info">
          <h3 class="template-title">القالب الإبداعي</h3>
          <p class="template-desc">شريط جانبي داكن بنسبة 30% مع صورة دائرية بالمنتصف وتنسيق فني</p>
          <a href="builder.php?theme=theme-creative" class="btn-select-template btn-outline">اختيار هذا القالب</a>
        </div>
      </article>

      <!-- القالب 3: الرؤية الحديثة (theme-modern) -->
      <article class="template-card" data-category="modern">
        <span class="card-badge new" style="background-color:#0b7a6f;">
          شائع
        </span>
        <div class="template-thumb-wrap">
          <!-- محاكاة القالب الثالث: هيدر أخضر عريض وصورة متداخلة على اليسار -->
          <svg viewBox="0 0 300 400" width="100%" height="100%">
            <rect width="300" height="400" fill="#ffffff"/>
            <!-- الهيدر الأخضر الواسع -->
            <rect x="0" y="0" width="300" height="100" fill="#0b7a6f"/>
            <rect x="100" y="25" width="170" height="10" rx="3" fill="#ffffff"/>
            <rect x="140" y="42" width="130" height="6" rx="2" fill="#d1fae5"/>
            <rect x="160" y="60" width="110" height="4" rx="2" fill="#f0fdfa"/>
            <!-- الصورة المتداخلة على اليسار -->
            <circle cx="60" cy="100" r="28" fill="#ffffff" stroke="#ffffff" stroke-width="3" filter="drop-shadow(0 2px 5px rgba(0,0,0,0.15))"/>
            <circle cx="60" cy="100" r="24" fill="#e2e8f0"/>
            <!-- المحتوى السفلي -->
            <rect x="180" y="130" width="90" height="7" rx="3" fill="#0b7a6f"/>
            <rect x="30" y="146" width="240" height="3" rx="1.5" fill="#94a3b8"/>
            <rect x="30" y="154" width="200" height="3" rx="1.5" fill="#94a3b8"/>

            <rect x="180" y="180" width="90" height="7" rx="3" fill="#0b7a6f"/>
            <rect x="30" y="196" width="240" height="35" rx="3" fill="#ffffff" stroke="#e2e8f0"/>
            <rect x="30" y="240" width="240" height="35" rx="3" fill="#ffffff" stroke="#e2e8f0"/>

            <rect x="180" y="295" width="90" height="7" rx="3" fill="#0b7a6f"/>
            <rect x="30" y="312" width="115" height="40" rx="3" fill="#ffffff" stroke="#e2e8f0"/>
            <rect x="155" y="312" width="115" height="40" rx="3" fill="#ffffff" stroke="#e2e8f0"/>
          </svg>
        </div>
        <div class="template-info">
          <h3 class="template-title">الرؤية الحديثة</h3>
          <p class="template-desc">هيدر ملون بخلفية خضراء واسعة مع صورة متداخلة وتنسيق معاصر</p>
          <a href="builder.php?theme=theme-modern" class="btn-select-template btn-outline">اختيار هذا القالب</a>
        </div>
      </article>

      <!-- القالب 4: القالب الاحترافي الشامل (theme-comprehensive) -->
      <article class="template-card" data-category="classic">
        <span class="card-badge new">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          جديد
        </span>
        <div class="template-thumb-wrap">
          <!-- محاكاة القالب الرابع: هيدر داكن رفيع مع صورة بأقصى اليمين وشبكة Grid وحدود سفلية خضراء -->
          <svg viewBox="0 0 300 400" width="100%" height="100%">
            <rect width="300" height="400" fill="#ffffff"/>
            <!-- الهيدر الداكن الرفيع -->
            <rect x="0" y="0" width="300" height="55" fill="#2c3e50"/>
            <circle cx="270" cy="27" r="16" fill="#ffffff" stroke="#ffffff" stroke-width="1.5"/>
            <rect x="120" y="18" width="125" height="8" rx="2" fill="#ffffff"/>
            <rect x="150" y="31" width="95" height="5" rx="2" fill="#94a3b8"/>
            <rect x="25" y="24" width="70" height="7" rx="2" fill="#e2e8f0" opacity="0.8"/>
            <!-- المحتوى بنظام الشبكة (Grid) مع حدود سفلية خضراء -->
            <rect x="25" y="70" width="250" height="6" rx="2" fill="#0b7a6f"/>
            <line x1="25" y1="80" x2="275" y2="80" stroke="#0b7a6f" stroke-width="2"/>
            <rect x="25" y="88" width="250" height="3" rx="1.5" fill="#94a3b8"/>
            <rect x="25" y="95" width="220" height="3" rx="1.5" fill="#94a3b8"/>

            <line x1="25" y1="120" x2="275" y2="120" stroke="#0b7a6f" stroke-width="2"/>
            <rect x="25" y="130" width="250" height="30" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
            <rect x="25" y="165" width="250" height="30" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>

            <!-- شبكة عمودين في الأسفل -->
            <line x1="155" y1="215" x2="275" y2="215" stroke="#0b7a6f" stroke-width="2"/>
            <rect x="155" y="225" width="120" height="45" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>

            <line x1="25" y1="215" x2="145" y2="215" stroke="#0b7a6f" stroke-width="2"/>
            <rect x="25" y="225" width="120" height="45" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>

            <line x1="25" y1="290" x2="275" y2="290" stroke="#0b7a6f" stroke-width="2"/>
            <rect x="25" y="300" width="120" height="40" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
            <rect x="155" y="300" width="120" height="40" rx="3" fill="#f8fafc" stroke="#e2e8f0"/>
          </svg>
        </div>
        <div class="template-info">
          <h3 class="template-title">القالب الاحترافي الشامل</h3>
          <p class="template-desc">رسمي ومكثف، مستطيل علوي رفيع داكن، مع شبكة Grid وحدود سفلية خضراء</p>
          <a href="builder.php?theme=theme-comprehensive" class="btn-select-template btn-outline">اختيار هذا القالب</a>
        </div>
      </article>

    </section>
  </main>

  <!-- ========================================================================
       4. الفوتر العام (Site Footer)
       ======================================================================== -->
  <footer class="site-footer">
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

  <!-- ملف الجافاسكربت -->
  <script src="main.js"></script>
</body>
</html>
