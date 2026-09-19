/**
 * ==========================================================================
 * صانع السير الذاتية - التفاعلات الحية (main.js)
 * بدون أطر عمل - Vanilla JavaScript
 * ==========================================================================
 */

document.addEventListener('DOMContentLoaded', () => {

  // --------------------------------------------------------------------------
  // 1. نظام فلترة القوالب التفاعلي (صفحة templates.php)
  // --------------------------------------------------------------------------
  const filterButtons = document.querySelectorAll('.filter-btn');
  const templateCards = document.querySelectorAll('.template-card');

  if (filterButtons.length > 0 && templateCards.length > 0) {
    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        // إزالة الكلاس النشط من كافة الأزرار
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // تفعيل الزر المختار
        button.classList.add('active');

        const filterValue = button.getAttribute('data-filter');

        // فلترة البطاقات
        templateCards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filterValue === 'all' || category === filterValue) {
            card.style.display = 'flex';
            setTimeout(() => {
              card.style.opacity = '1';
              card.style.transform = 'translateY(0)';
            }, 10);
          } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            setTimeout(() => {
              card.style.display = 'none';
            }, 200);
          }
        });
      });
    });
    // تمكين فتح القالب فور النقر على أي جزء من البطاقة
    templateCards.forEach(card => {
      card.style.cursor = 'pointer';
      card.addEventListener('click', (e) => {
        if (e.target.tagName !== 'A' && !e.target.closest('a')) {
          const selectBtn = card.querySelector('.btn-select-template');
          if (selectBtn && selectBtn.href) {
            window.location.href = selectBtn.href;
          }
        }
      });
    });
  }

  // --------------------------------------------------------------------------
  // 2. أدوات التحكم بالمعاينة (صفحة builder.php)
  // --------------------------------------------------------------------------
  const btnZoomIn = document.getElementById('btnZoomIn');
  const btnZoomOut = document.getElementById('btnZoomOut');
  const btnFullscreen = document.getElementById('btnFullscreen');
  const a4Canvas = document.getElementById('a4Canvas');
  const previewArea = document.querySelector('.builder-preview-area');

  let currentScale = 1;

  if (a4Canvas) {
    // تكبير الورقة
    if (btnZoomIn) {
      btnZoomIn.addEventListener('click', () => {
        if (currentScale < 1.6) {
          currentScale += 0.1;
          a4Canvas.style.transform = `scale(${currentScale})`;
        }
      });
    }

    // تصغير الورقة
    if (btnZoomOut) {
      btnZoomOut.addEventListener('click', () => {
        if (currentScale > 0.6) {
          currentScale -= 0.1;
          a4Canvas.style.transform = `scale(${currentScale})`;
        }
      });
    }

    // ملء الشاشة
    if (btnFullscreen && previewArea) {
      btnFullscreen.addEventListener('click', () => {
        if (!document.fullscreenElement) {
          previewArea.requestFullscreen().catch(err => {
            console.warn(`Fullscreen error: ${err.message}`);
          });
        } else {
          document.exitFullscreen();
        }
      });
    }
  }

  // --------------------------------------------------------------------------
  // 3. التنقل بين خطوات البناء (صفحة builder.php)
  // --------------------------------------------------------------------------
  const stepItems = document.querySelectorAll('.step-item');
  if (stepItems.length > 0) {
    stepItems.forEach(item => {
      item.addEventListener('click', () => {
        stepItems.forEach(step => step.classList.remove('active'));
        item.classList.add('active');
      });
    });
  }

  const contactLink = document.getElementById('contactLink');
  const contactModal = document.getElementById('contactModal');

  if (contactLink && contactModal) {
    const closeContactModal = () => {
      contactModal.hidden = true;
      document.body.style.overflow = '';
    };

    contactLink.addEventListener('click', (event) => {
      event.preventDefault();
      contactModal.hidden = false;
      document.body.style.overflow = 'hidden';
    });

    contactModal.querySelectorAll('[data-close-contact]').forEach((element) => {
      element.addEventListener('click', closeContactModal);
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && !contactModal.hidden) {
        closeContactModal();
      }
    });
  }

});
