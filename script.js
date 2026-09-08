/**
 * =======================================================
 * script.js - التفاعلات الحية لـ Live CV Builder (Vanilla JS)
 * =======================================================
 * يحتوي على:
 * 1. Live Data Binding: التحديث اللحظي لبيانات السيرة الذاتية عبر حدث input.
 * 2. FileReader API: قراءة الصورة الشخصية وعرضها فوراً في المعاينة قبل الرفع.
 * 3. Dynamic Parsers: تحليل الأسطر وعلامة النجمة (*) لتوليد بطاقات المهارات والمشاريع.
 * 4. AJAX Submission: إرسال البيانات وملف الصورة عبر Fetch API إلى save_cv.php.
 * 5. الطباعة وتصدير PDF وإدارة إشعارات Toast.
 */

document.addEventListener('DOMContentLoaded', () => {

    // -------------------------------------------------------
    // 1. تحديد عناصر الواجهة (DOM Elements)
    // -------------------------------------------------------
    const cvForm         = document.getElementById('cvForm');
    const inputPhoto     = document.getElementById('profile_image');
    const inputFullName  = document.getElementById('full_name');
    const inputJobTitle  = document.getElementById('job_title');
    const inputPhone     = document.getElementById('phone');
    const inputEmail     = document.getElementById('email');
    const inputBio       = document.getElementById('bio');
    const inputSkills    = document.getElementById('skills');
    const inputProjects  = document.getElementById('projects');

    // عناصر المعاينة الحية (Live Preview Elements)
    const previewAvatar       = document.getElementById('previewAvatar');
    const previewName         = document.getElementById('previewName');
    const previewTitle        = document.getElementById('previewTitle');
    const previewPhone        = document.getElementById('previewPhone');
    const previewEmail        = document.getElementById('previewEmail');
    const previewBio          = document.getElementById('previewBio');
    const previewSkillsGrid   = document.getElementById('previewSkillsGrid');
    const previewProjectsGrid = document.getElementById('previewProjectsGrid');

    // أزرار التحكم وحالة الحفظ
    const btnSave      = document.getElementById('btnSave');
    const btnPrint     = document.getElementById('btnPrint');
    const saveSpinner  = document.getElementById('saveSpinner');
    const btnText      = btnSave.querySelector('.btn-text');
    const toast        = document.getElementById('toastNotification');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon    = document.getElementById('toastIcon');

    // -------------------------------------------------------
    // 2. دوال التحليل الديناميكي (Dynamic Parsers)
    // -------------------------------------------------------

    /**
     * دالة تحليل وتوليد بطاقات المهارات
     * تفصل النص إلى أسطر، وتفصل المهارة عن مستواها بعلامة النجمة (*)
     * @param {string} rawText 
     */
    function renderSkills(rawText) {
        previewSkillsGrid.innerHTML = '';
        const lines = rawText.split('\n');

        let count = 0;
        lines.forEach(line => {
            const cleanLine = line.trim();
            if (!cleanLine) return; // تجاهل الأسطر الفارغة

            const card = document.createElement('div');
            card.className = 'skill-card';

            if (cleanLine.includes('*')) {
                const parts = cleanLine.split('*');
                const title = parts[0].trim();
                const badge = parts.slice(1).join('*').trim();

                card.innerHTML = `
                    <span class="skill-title">${escapeHTML(title)}</span>
                    ${badge ? `<span class="skill-badge">${escapeHTML(badge)}</span>` : ''}
                `;
            } else {
                card.innerHTML = `<span class="skill-title">${escapeHTML(cleanLine)}</span>`;
            }

            previewSkillsGrid.appendChild(card);
            count++;
        });

        // إذا كانت الحقول فارغة نعرض رسالة أو نص توضيحي
        if (count === 0) {
            previewSkillsGrid.innerHTML = '<p class="text-muted" style="color:#94a3b8; font-size:0.85rem;">أدخل مهاراتك لتظهر هنا كبطاقات أنيقة...</p>';
        }
    }

    /**
     * دالة تحليل وتوليد بطاقات المشاريع
     * تفصل كل سطر إلى عنوان ووصف عبر علامة النجمة (*)
     * @param {string} rawText 
     */
    function renderProjects(rawText) {
        previewProjectsGrid.innerHTML = '';
        const lines = rawText.split('\n');

        let count = 0;
        lines.forEach(line => {
            const cleanLine = line.trim();
            if (!cleanLine) return; // تجاهل الأسطر الفارغة

            const card = document.createElement('div');
            card.className = 'project-card';

            if (cleanLine.includes('*')) {
                const parts = cleanLine.split('*');
                const title = parts[0].trim();
                const description = parts.slice(1).join('*').trim();

                card.innerHTML = `
                    <div class="project-card-header">
                        <h4 class="project-card-title">${escapeHTML(title)}</h4>
                    </div>
                    ${description ? `<p class="project-card-desc">${escapeHTML(description)}</p>` : ''}
                `;
            } else {
                card.innerHTML = `
                    <div class="project-card-header">
                        <h4 class="project-card-title">${escapeHTML(cleanLine)}</h4>
                    </div>
                `;
            }

            previewProjectsGrid.appendChild(card);
            count++;
        });

        // في حال عدم إدخال مشاريع
        if (count === 0) {
            previewProjectsGrid.innerHTML = '<p class="text-muted" style="color:#94a3b8; font-size:0.85rem;">أدخل مشاريعك لعرضها هنا بشكل منظم...</p>';
        }
    }

    /**
     * دالة حماية النصوص من هجمات XSS
     * @param {string} str 
     * @returns {string}
     */
    function escapeHTML(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    // -------------------------------------------------------
    // 3. الربط الحي للبيانات (Live Data Binding)
    // -------------------------------------------------------

    // ربط الحقول النصية البسيطة مع المعاينة لحظياً عند الكتابة (input event)
    inputFullName.addEventListener('input', () => {
        previewName.textContent = inputFullName.value.trim() || 'الاسم الكامل';
    });

    inputJobTitle.addEventListener('input', () => {
        previewTitle.textContent = inputJobTitle.value.trim() || 'المسمى الوظيفي';
    });

    inputPhone.addEventListener('input', () => {
        previewPhone.textContent = inputPhone.value.trim() || 'رقم الهاتف';
    });

    inputEmail.addEventListener('input', () => {
        previewEmail.textContent = inputEmail.value.trim() || 'البريد الإلكتروني';
    });

    inputBio.addEventListener('input', () => {
        previewBio.textContent = inputBio.value.trim() || 'أدخل نبذة شخصية تعرف فيها بمسارك المهني وشغفك...';
    });

    // ربط الحقول المعقدة مع محللات النصوص الديناميكية
    inputSkills.addEventListener('input', () => {
        renderSkills(inputSkills.value);
    });

    inputProjects.addEventListener('input', () => {
        renderProjects(inputProjects.value);
    });

    // -------------------------------------------------------
    // 4. FileReader API: المعاينة اللحظية للصورة الشخصية
    // -------------------------------------------------------
    inputPhoto.addEventListener('change', function(e) {
        const file = this.files[0];
        if (!file) return;

        // التحقق من أن الملف صورة
        if (!file.type.startsWith('image/')) {
            showToast('الملف المحدد ليس صورة صالحة!', 'error');
            this.value = '';
            return;
        }

        // قراءة الملف عبر FileReader API
        const reader = new FileReader();
        reader.onload = function(event) {
            previewAvatar.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });

    // -------------------------------------------------------
    // 5. حفظ البيانات عبر AJAX (Fetch API & FormData)
    // -------------------------------------------------------
    cvForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // التحقق من الحقول الإلزامية الأساسية في المتصفح
        if (!inputFullName.value.trim() || !inputJobTitle.value.trim() || 
            !inputPhone.value.trim() || !inputEmail.value.trim()) {
            showToast('يرجى تعبئة الحقول الأساسية المطلوبة!', 'error');
            return;
        }

        // تجهيز كائن FormData وإضافة كافة الحقول والملفات تلقائياً
        const formData = new FormData(cvForm);

        // تغيير حالة الزر أثناء الإرسال
        setButtonLoading(true);

        try {
            // إرسال الطلب غير المتزامن إلى ملف save_cv.php
            const response = await fetch('save_cv.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            // التحقق من نوع الاستجابة وتفاصيل الحالة
            const contentType = response.headers.get('content-type') || '';
            let result;

            if (contentType.includes('application/json')) {
                result = await response.json();
            } else {
                const rawText = await response.text();
                console.error('Server non-JSON response:', rawText);
                throw new Error(`استجابة غير متوقعة من السيرفر (كود الحالة: ${response.status}). يرجى التحقق من لوحة التحكم أو ملف save_cv.php`);
            }

            if (result.status === 'success') {
                showToast(result.message || 'تم حفظ السيرة الذاتية بنجاح!', 'success');
                
                // في حال تم رفع صورة وتم إرجاع مسارها، يتم تحديث الرابط في المعاينة
                if (result.image_path) {
                    previewAvatar.dataset.savedPath = result.image_path;
                }
            } else {
                showToast(result.message || 'حدث خطأ أثناء الحفظ!', 'error');
            }
        } catch (error) {
            console.error('Save CV Error:', error);
            const errorMsg = error.message || 'تعذر الاتصال بالخادم، يرجى التأكد من تشغيل Apache & MySQL في XAMPP.';
            showToast(errorMsg, 'error');
        } finally {
            setButtonLoading(false);
        }
    });

    /**
     * تحديث حالة زر الحفظ (إظهار/إخفاء Spinner)
     * @param {boolean} isLoading 
     */
    function setButtonLoading(isLoading) {
        if (isLoading) {
            btnSave.disabled = true;
            saveSpinner.classList.remove('hidden');
            btnText.textContent = 'جاري الحفظ...';
        } else {
            btnSave.disabled = false;
            saveSpinner.classList.add('hidden');
            btnText.textContent = 'حفظ السيرة الذاتية';
        }
    }

    // -------------------------------------------------------
    // 6. إدارة التنبيهات المنبثقة (Toast Notifications)
    // -------------------------------------------------------
    let toastTimeout;
    function showToast(message, type = 'success') {
        clearTimeout(toastTimeout);
        toastMessage.textContent = message;
        toast.className = `toast ${type}`;

        if (type === 'success') {
            toastIcon.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>`;
        } else {
            toastIcon.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>`;
        }

        toast.classList.remove('hidden');

        toastTimeout = setTimeout(() => {
            toast.classList.add('hidden');
        }, 4000);
    }

    // -------------------------------------------------------
    // 7. زر الطباعة / تصدير PDF
    // -------------------------------------------------------
    btnPrint.addEventListener('click', () => {
        window.print();
    });

    // -------------------------------------------------------
    // 8. تهيئة البيانات الافتراضية عند أول تحميل للصفحة
    // -------------------------------------------------------
    function initDefaultData() {
        // تعبئة بعض الحقول الأولية النموذجية لتبدو السيرة الذاتية مكتملة وجذابة عند الفتح
        inputFullName.value = 'عبدالرحمن علي الحميدي';
        inputJobTitle.value = 'مهندس برمجيات ومطور واجهات ويب';
        inputPhone.value = '713 766 854';
        inputEmail.value = 'alhmydybdalrhmn997@gmail.com';
        inputBio.value = 'مهندس برمجيات متمرس بخبرة تتجاوز 5 سنوات في بناء وتطوير منصات الويب الحديثة وتصميم واجهات المستخدم التفاعلية. شغوف بالأداء العالي وتجربة المستخدم وتطبيق أفضل الممارسات البرمجية.';
        
        inputSkills.value = `تطوير الواجهات Front-End * خبير
PHP & MySQL * متقدم
تصميم تجربة المستخدم UI/UX * محترف
JavaScript (Vanilla & Modern) * متقدم
RESTful APIs & Web Services * متقدم
Git & Version Control * خبير`;

        inputProjects.value = `منصة تجارة إلكترونية ذكية * متجر رقمي متكامل يدعم الدفع الإلكتروني وتتبع الشحنات وتطبيق نظام إدارة المخزون اللحظي.
نظام إدارة الحجوزات والعيادات * تطبيق سحابي لحجز المواعيد وإدارة الملفات الطبية مع لوحة تحكم وإحصائيات متقدمة.
منصة التعليم التفاعلي * نظام لإدارة المساقات التعليمية مع غرف نقاش فورية واختبارات تفاعلية.`;

        // تشغيل دوال التوليد للبيانات الأولية
        previewName.textContent = inputFullName.value;
        previewTitle.textContent = inputJobTitle.value;
        previewPhone.textContent = inputPhone.value;
        previewEmail.textContent = inputEmail.value;
        previewBio.textContent = inputBio.value;
        renderSkills(inputSkills.value);
        renderProjects(inputProjects.value);
    }

    initDefaultData();

    // التحقق من طريقة فتح الصفحة (إذا فُتحت عبر file:// يتم إرشاد المستخدم إلى localhost)
    if (window.location.protocol === 'file:') {
        setTimeout(() => {
            showToast('تنبيه: أنت تفتح الصفحة كملف محلي. يجب تشغيلها عبر سيرفر XAMPP: http://localhost/cv-builder/', 'error');
        }, 800);
    }

});
