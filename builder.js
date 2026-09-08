/**
 * ==========================================================================
 * صانع السير الذاتية - محرك المعاينة والربط الحي (builder.js)
 * يدعم:
 * 1. التبديل الفوري بين القوالب الأربعة عبر الـ CSS Class على #cv-container.
 * 2. قراءة القالب من معلمة الرابط (?theme=theme-...).
 * 3. الربط الحي المباشر (Live Data Binding) لجميع الحقول والبيانات.
 * 4. معاينة الصورة المرفوعة لحظياً بواسطة FileReader API.
 * 5. أدوات التكبير والتصغير وتصدير PDF والتبديل بين خطوات الإدخال.
 * 6. حفظ البيانات في MySQL عبر AJAX (save_cv.php).
 * ==========================================================================
 */

document.addEventListener('DOMContentLoaded', () => {

  // --------------------------------------------------------------------------
  // 1. العناصر الرئيسية
  // --------------------------------------------------------------------------
  const cvContainer = document.getElementById('cv-container');
  const themeSelect = document.getElementById('themeSelect');
  const cvBuilderForm = document.getElementById('cvBuilderForm');
  const btnSaveCv = document.getElementById('btnSaveCv');

  // عناصر إدخال البيانات في الشريط الجانبي
  const inPhoto = document.getElementById('in-photo');
  const sidebarAvatarImg = document.getElementById('sidebarAvatarImg');
  const inName = document.getElementById('in-name');
  const inTitle = document.getElementById('in-title');
  const inPhone = document.getElementById('in-phone');
  const inEmail = document.getElementById('in-email');
  const inLocation = document.getElementById('in-location');
  const inBio = document.getElementById('in-bio');
  const inExperience = document.getElementById('in-experience');
  const inEducation = document.getElementById('in-education');
  const inSkills = document.getElementById('in-skills');
  const inProjects = document.getElementById('in-projects');

  // عناصر المعاينة الحية في ورقة السيرة الذاتية (#cv-container)
  const cvImage = document.getElementById('cv-image');
  const cvName = document.getElementById('cv-name');
  const cvTitle = document.getElementById('cv-title');
  const cvPhone = document.getElementById('cv-phone');
  const cvEmail = document.getElementById('cv-email');
  const cvLocation = document.getElementById('cv-location');
  const cvBio = document.getElementById('cv-bio');
  const cvExperience = document.getElementById('cv-experience');
  const cvEducation = document.getElementById('cv-education');
  const cvSkills = document.getElementById('cv-skills');
  const cvProjects = document.getElementById('cv-projects');

  // أدوات التكبير والتنقل بين الخطوات
  const btnZoomIn = document.getElementById('btnZoomIn');
  const btnZoomOut = document.getElementById('btnZoomOut');
  const btnFullscreen = document.getElementById('btnFullscreen');
  const previewArea = document.querySelector('.builder-preview-area');
  const stepItems = document.querySelectorAll('.step-item');
  const stepPanels = document.querySelectorAll('.step-panel');

  let currentZoom = 0.7;

  // --------------------------------------------------------------------------
  // 2. إدارة وتحديد القالب النشط (Theme Selection)
  // --------------------------------------------------------------------------
  const validThemes = [
    'theme-professional',
    'theme-creative',
    'theme-modern',
    'theme-comprehensive'
  ];

  const themeAliasMap = {
    'classic': 'theme-professional',
    'professional': 'theme-professional',
    'theme-professional': 'theme-professional',
    'creative': 'theme-creative',
    'theme-creative': 'theme-creative',
    'modern': 'theme-modern',
    'theme-modern': 'theme-modern',
    'comprehensive': 'theme-comprehensive',
    'theme-comprehensive': 'theme-comprehensive',
    'academic': 'theme-comprehensive'
  };

  const urlParams = new URLSearchParams(window.location.search);
  const rawTheme = urlParams.get('theme') || urlParams.get('template') || 'theme-professional';
  let activeTheme = themeAliasMap[rawTheme] || 'theme-professional';

  function applyTheme(themeClass) {
    if (!validThemes.includes(themeClass)) {
      themeClass = 'theme-professional';
    }
    activeTheme = themeClass;

    if (cvContainer) {
      // إزالة أي ثيمات قديمة ثم تطبيق الجديد
      validThemes.forEach(t => cvContainer.classList.remove(t));
      cvContainer.classList.add(activeTheme);
    }

    if (themeSelect && themeSelect.value !== activeTheme) {
      themeSelect.value = activeTheme;
    }

    // تحديث الرابط دون إعادة تحميل الصفحة
    const newUrl = new URL(window.location.href);
    newUrl.searchParams.set('theme', activeTheme);
    window.history.replaceState({}, '', newUrl);
  }

  // تطبيق القالب عند التحميل
  applyTheme(activeTheme);

  // التبديل عند تغيير القائمة المنسدلة
  if (themeSelect) {
    themeSelect.addEventListener('change', (e) => {
      applyTheme(e.target.value);
    });
  }

  // --------------------------------------------------------------------------
  // 3. التنقل بين خطوات إدخال البيانات (Wizard Steps)
  // --------------------------------------------------------------------------
  stepItems.forEach(item => {
    item.addEventListener('click', () => {
      const stepNum = item.getAttribute('data-step');
      
      stepItems.forEach(s => s.classList.remove('active'));
      item.classList.add('active');

      stepPanels.forEach(p => p.classList.remove('active'));
      const targetPanel = document.getElementById(`panel-${stepNum}`);
      if (targetPanel) {
        targetPanel.classList.add('active');
      }
    });
  });

  // --------------------------------------------------------------------------
  // 4. دوال التطهير وتنسيق الحقول المتعددة
  // --------------------------------------------------------------------------
  function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  // معالجة الخبرات العملية
  function renderExperience(text) {
    if (!cvExperience) return;
    if (!text || !text.trim()) {
      cvExperience.innerHTML = '<p class="empty-hint" style="color:#94a3b8; font-size:0.88rem;">لم يتم إدخال خبرات بعد...</p>';
      return;
    }

    const lines = text.split('\n');
    let html = '';
    lines.forEach(line => {
      const clean = line.trim();
      if (!clean) return;

      const parts = clean.split('*').map(p => p.trim());
      const title = escapeHtml(parts[0] || '');
      const subtitleRaw = escapeHtml(parts[1] || '');
      const desc = escapeHtml(parts.slice(2).join(' - ') || '');

      let dateStr = '';
      let companyStr = subtitleRaw;
      const dateMatch = subtitleRaw.match(/\((.*?)\)/);
      if (dateMatch) {
        dateStr = dateMatch[1];
        companyStr = subtitleRaw.replace(/\(.*?\)/, '').trim();
      }

      html += `
        <div class="timeline-item">
          <div class="item-head">
            <h3 class="item-title">${title}</h3>
            ${dateStr ? `<span class="item-date">${dateStr}</span>` : ''}
          </div>
          ${companyStr ? `<div class="item-subtitle">${companyStr}</div>` : ''}
          ${desc ? `<p class="item-desc">${desc}</p>` : ''}
        </div>
      `;
    });

    cvExperience.innerHTML = html;
  }

  // معالجة التعليم والمؤهلات
  function renderEducation(text) {
    if (!cvEducation) return;
    if (!text || !text.trim()) {
      cvEducation.innerHTML = '<p class="empty-hint" style="color:#94a3b8; font-size:0.88rem;">لم يتم إدخال مؤهلات بعد...</p>';
      return;
    }

    const lines = text.split('\n');
    let html = '';
    lines.forEach(line => {
      const clean = line.trim();
      if (!clean) return;

      const parts = clean.split('*').map(p => p.trim());
      const degree = escapeHtml(parts[0] || '');
      const instRaw = escapeHtml(parts[1] || '');
      const notes = escapeHtml(parts.slice(2).join(' - ') || '');

      let dateStr = '';
      let instStr = instRaw;
      const dateMatch = instRaw.match(/\((.*?)\)/);
      if (dateMatch) {
        dateStr = dateMatch[1];
        instStr = instRaw.replace(/\(.*?\)/, '').trim();
      }

      html += `
        <div class="edu-item">
          <div class="item-head">
            <h3 class="item-title">${degree}</h3>
            ${dateStr ? `<span class="item-date">${dateStr}</span>` : ''}
          </div>
          ${instStr ? `<div class="item-subtitle">${instStr}</div>` : ''}
          ${notes ? `<p class="item-desc">${notes}</p>` : ''}
        </div>
      `;
    });

    cvEducation.innerHTML = html;
  }

  // معالجة المهارات
  function renderSkills(text) {
    if (!cvSkills) return;
    if (!text || !text.trim()) {
      cvSkills.innerHTML = '<span style="color:#94a3b8; font-size:0.85rem;">لم يتم إدخال مهارات بعد...</span>';
      return;
    }

    const lines = text.split('\n');
    let html = '';
    lines.forEach(line => {
      const clean = line.trim();
      if (!clean) return;
      html += `<div class="skill-pill">${escapeHtml(clean)}</div>`;
    });

    cvSkills.innerHTML = html;
  }

  // معالجة المشاريع
  function renderProjects(text) {
    if (!cvProjects) return;
    if (!text || !text.trim()) {
      cvProjects.innerHTML = '<p class="empty-hint" style="color:#94a3b8; font-size:0.88rem;">لم يتم إدخال مشاريع بعد...</p>';
      return;
    }

    const lines = text.split('\n');
    let html = '';
    lines.forEach(line => {
      const clean = line.trim();
      if (!clean) return;

      const parts = clean.split('*').map(p => p.trim());
      const title = escapeHtml(parts[0] || '');
      const desc = escapeHtml(parts.slice(1).join(' - ') || '');

      html += `
        <div class="project-card">
          <h4 class="project-title">${title}</h4>
          ${desc ? `<p class="project-desc">${desc}</p>` : ''}
        </div>
      `;
    });

    cvProjects.innerHTML = html;
  }

  // --------------------------------------------------------------------------
  // 5. الربط الحي المباشر لجميع حقول الإدخال (Live Data Binding)
  // --------------------------------------------------------------------------
  if (inName) {
    inName.addEventListener('input', () => {
      if (cvName) cvName.textContent = inName.value.trim() || 'الاسم الكامل';
    });
  }

  if (inTitle) {
    inTitle.addEventListener('input', () => {
      if (cvTitle) cvTitle.textContent = inTitle.value.trim() || 'المسمى الوظيفي';
    });
  }

  if (inPhone) {
    inPhone.addEventListener('input', () => {
      if (cvPhone) cvPhone.textContent = inPhone.value.trim() || '-';
    });
  }

  if (inEmail) {
    inEmail.addEventListener('input', () => {
      if (cvEmail) cvEmail.textContent = inEmail.value.trim() || '-';
    });
  }

  if (inLocation) {
    inLocation.addEventListener('input', () => {
      if (cvLocation) cvLocation.textContent = inLocation.value.trim() || '-';
    });
  }

  if (inBio) {
    inBio.addEventListener('input', () => {
      if (cvBio) cvBio.textContent = inBio.value.trim() || 'اكتب نبذتك الشخصية هنا...';
    });
  }

  if (inExperience) {
    inExperience.addEventListener('input', () => {
      renderExperience(inExperience.value);
    });
  }

  if (inEducation) {
    inEducation.addEventListener('input', () => {
      renderEducation(inEducation.value);
    });
  }

  if (inSkills) {
    inSkills.addEventListener('input', () => {
      renderSkills(inSkills.value);
    });
  }

  if (inProjects) {
    inProjects.addEventListener('input', () => {
      renderProjects(inProjects.value);
    });
  }

  // معاينة الصورة الحية عند الرفع
  if (inPhoto) {
    inPhoto.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (file) {
        if (!file.type.startsWith('image/')) {
          alert('يرجى اختيار ملف صورة صالح (JPG, PNG, WEBP).');
          return;
        }
        const reader = new FileReader();
        reader.onload = (loadEvt) => {
          const result = loadEvt.target.result;
          if (cvImage) cvImage.src = result;
          if (sidebarAvatarImg) sidebarAvatarImg.src = result;
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // --------------------------------------------------------------------------
  // 6. أدوات التكبير والتصغير وتوسيع المعاينة (Zoom Controls)
  // --------------------------------------------------------------------------
  function updateZoom(newZoom) {
    currentZoom = Math.min(Math.max(newZoom, 0.35), 1.4);
    if (cvContainer) {
      cvContainer.style.transform = `scale(${currentZoom})`;
      cvContainer.style.transformOrigin = 'top center';
      cvContainer.style.marginBottom = `calc(297mm * ${currentZoom - 1})`;
      cvContainer.style.transition = 'transform 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
    }
  }

  if (btnZoomIn) {
    btnZoomIn.addEventListener('click', () => {
      updateZoom(currentZoom + 0.1);
    });
  }

  if (btnZoomOut) {
    btnZoomOut.addEventListener('click', () => {
      updateZoom(currentZoom - 0.1);
    });
  }

  if (btnFullscreen) {
    btnFullscreen.addEventListener('click', () => {
      if (!document.fullscreenElement) {
        if (previewArea && previewArea.requestFullscreen) {
          previewArea.requestFullscreen();
        }
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      }
    });
  }

  // --------------------------------------------------------------------------
  // 7. رسائل التنبيه العائمة (Toast Notifications)
  // --------------------------------------------------------------------------
  function showToast(message, type = 'success') {
    let toast = document.getElementById('cvToastNotification');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'cvToastNotification';
      toast.style.cssText = `
        position: fixed;
        bottom: 25px;
        left: 25px;
        z-index: 99999;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 22px;
        border-radius: 10px;
        font-family: 'Tajawal', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        box-shadow: 0 10px 25px rgba(0,0,0,0.18);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        transform: translateY(20px);
      `;
      document.body.appendChild(toast);
    }

    if (type === 'success') {
      toast.style.backgroundColor = '#0b7a6f';
      toast.style.color = '#ffffff';
      toast.innerHTML = `<span>✓</span> <span>${escapeHtml(message)}</span>`;
    } else {
      toast.style.backgroundColor = '#e11d48';
      toast.style.color = '#ffffff';
      toast.innerHTML = `<span>⚠️</span> <span>${escapeHtml(message)}</span>`;
    }

    requestAnimationFrame(() => {
      toast.style.opacity = '1';
      toast.style.transform = 'translateY(0)';
    });

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(20px)';
    }, 4500);
  }

  // --------------------------------------------------------------------------
  // 8. حفظ السيرة الذاتية عبر AJAX (save_cv.php)
  // --------------------------------------------------------------------------
  const cvFormElement = document.getElementById('cv-form') || document.getElementById('cvBuilderForm');
  const submitButton = document.getElementById('btnSaveCv') || (cvFormElement ? cvFormElement.querySelector('button[type="submit"]') : null);

  if (cvFormElement) {
    cvFormElement.addEventListener('submit', async (e) => {
      // 1. منع السلوك الافتراضي للمتصفح (إعادة تحميل الصفحة)
      e.preventDefault();

      // 2. التحقق من الحقول الأساسية
      if (!inName.value.trim() || !inTitle.value.trim() || !inPhone.value.trim() || !inEmail.value.trim()) {
        showToast('يرجى تعبئة الحقول الأساسية: الاسم، المسمى، الهاتف، والبريد.', 'error');
        return;
      }

      // 3. تجميع كافة بيانات النموذج تلقائياً باستخدام كائن FormData
      const formData = new FormData(cvFormElement);

      // استخراج اسم القالب المختار حالياً من الحاوية وإلحاقه بالبيانات المرسلة
      const activeThemeClass = cvContainer
        ? (Array.from(cvContainer.classList).find(c => c.startsWith('theme-')) || 'theme-professional')
        : (themeSelect ? themeSelect.value : 'theme-professional');
      formData.append('theme_selected', activeThemeClass);

      // 4. إدارة حالة واجهة المستخدم: تعطيل الزر وإظهار مؤشر التحميل
      const originalBtnHtml = submitButton ? submitButton.innerHTML : '';
      if (submitButton) {
        submitButton.disabled = true;
        submitButton.innerHTML = `
          <svg style="animation: spin 0.9s linear infinite; width: 18px; height: 18px; vertical-align: middle; margin-left: 8px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
            <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
          </svg>
          <span>جاري الحفظ...</span>
        `;
      }

      // 5. إرسال الطلب إلى السيرفر عبر Fetch API
      try {
        const response = await fetch('save_cv.php', {
          method: 'POST',
          body: formData
        });

        if (!response.ok) {
          throw new Error(`خطأ في استجابة الخادم (رمز الحالة: ${response.status})`);
        }

        // قراءة ومعالجة استجابة الـ JSON
        const result = await response.json();

        // 6. التعامل مع نتيجة الاستجابة وإشعار المستخدم
        if (result.status === 'success') {
          showToast(result.message || 'تم حفظ السيرة الذاتية بنجاح في قاعدة البيانات!', 'success');
        } else {
          showToast(result.message || 'حدث خطأ أثناء معالجة البيانات.', 'error');
        }

      } catch (error) {
        console.error('AJAX Submit Error:', error);
        showToast(error.message || 'تعذر الاتصال بالخادم، يرجى التأكد من تشغيل Apache و MySQL.', 'error');
      } finally {
        // إعادة زر الحفظ إلى حالته الطبيعية
        if (submitButton) {
          submitButton.disabled = false;
          submitButton.innerHTML = originalBtnHtml;
        }
      }
    });
  }

  // --------------------------------------------------------------------------
  // 9. تشغيل التهيئة الأولية لعرض البيانات المكتوبة افتراضياً في النموذج
  // --------------------------------------------------------------------------
  if (inExperience) renderExperience(inExperience.value);
  if (inEducation) renderEducation(inEducation.value);
  if (inSkills) renderSkills(inSkills.value);
  if (inProjects) renderProjects(inProjects.value);

});
