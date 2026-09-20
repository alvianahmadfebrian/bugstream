<!-- Global Confirmation & Alert Modal Component -->
<div id="global-action-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 transition-all duration-200 opacity-0 pointer-events-none" style="background-color: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
    <div id="global-modal-card" class="bg-surface rounded-2xl shadow-2xl border border-outline-variant max-w-md w-full p-6 transform scale-95 transition-all duration-200 flex flex-col gap-4 text-left">
        <div class="flex items-start gap-3.5">
            <!-- Dynamic Icon Container -->
            <div id="global-modal-icon-container" class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-red-100 text-red-600 transition-colors">
                <span id="global-modal-icon" class="material-symbols-outlined text-[26px]">delete_forever</span>
            </div>
            
            <div class="flex-1 min-w-0 pt-0.5">
                <h3 id="global-modal-title" class="font-headline-sm text-base text-on-surface font-bold mb-1">Konfirmasi Tindakan</h3>
                <p id="global-modal-message" class="text-sm font-body-md text-on-surface-variant leading-relaxed">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2 mt-2 border-t border-outline-variant/60">
            <button id="global-modal-cancel" type="button" class="px-4 py-2 rounded-xl border border-outline-variant text-on-surface font-semibold text-sm hover:bg-surface-container-low transition-all active:scale-95 duration-100 cursor-pointer">
                Batal
            </button>
            <button id="global-modal-confirm" type="button" class="px-5 py-2 rounded-xl font-semibold text-sm transition-all active:scale-95 duration-100 flex items-center justify-center gap-1.5 shadow-sm cursor-pointer bg-red-600 hover:bg-red-700 text-white">
                <span id="global-modal-confirm-text">Ya, Lanjutkan</span>
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        const modal = document.getElementById('global-action-modal');
        const card = document.getElementById('global-modal-card');
        const iconContainer = document.getElementById('global-modal-icon-container');
        const iconElem = document.getElementById('global-modal-icon');
        const titleElem = document.getElementById('global-modal-title');
        const messageElem = document.getElementById('global-modal-message');
        const cancelBtn = document.getElementById('global-modal-cancel');
        const confirmBtn = document.getElementById('global-modal-confirm');
        const confirmTextElem = document.getElementById('global-modal-confirm-text');

        let currentOnConfirm = null;
        let currentOnCancel = null;

        const typeStyles = {
            danger: {
                iconBg: 'bg-red-100 text-red-600',
                iconName: 'delete_forever',
                btnClass: 'bg-red-600 hover:bg-red-700 text-white shadow-red-500/20'
            },
            warning: {
                iconBg: 'bg-amber-100 text-amber-600',
                iconName: 'warning',
                btnClass: 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-500/20'
            },
            info: {
                iconBg: 'bg-blue-100 text-blue-600',
                iconName: 'info',
                btnClass: 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-500/20'
            },
            success: {
                iconBg: 'bg-green-100 text-green-600',
                iconName: 'check_circle',
                btnClass: 'bg-green-600 hover:bg-green-700 text-white shadow-green-500/20'
            }
        };

        function closeModal() {
            if (!modal) return;
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
        }

        function openModal() {
            if (!modal) return;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }

        window.showConfirmModal = function (options = {}) {
            const {
                title = 'Konfirmasi Tindakan',
                message = 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
                confirmText = 'Ya, Lanjutkan',
                cancelText = 'Batal',
                type = 'danger',
                onConfirm = () => {},
                onCancel = () => {}
            } = options;

            titleElem.textContent = title;
            messageElem.textContent = message;
            confirmTextElem.textContent = confirmText;
            cancelBtn.textContent = cancelText;
            cancelBtn.classList.remove('hidden');

            const style = typeStyles[type] || typeStyles.danger;
            iconContainer.className = `w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors ${style.iconBg}`;
            iconElem.textContent = style.iconName;
            confirmBtn.className = `px-5 py-2 rounded-xl font-semibold text-sm transition-all active:scale-95 duration-100 flex items-center justify-center gap-1.5 shadow-sm cursor-pointer ${style.btnClass}`;

            currentOnConfirm = onConfirm;
            currentOnCancel = onCancel;

            openModal();
        };

        window.showAlertModal = function (options = {}) {
            if (typeof options === 'string') {
                options = { message: options };
            }
            const {
                title = 'Informasi',
                message = '',
                buttonText = 'Mengerti',
                type = 'warning',
                onClose = () => {}
            } = options;

            titleElem.textContent = title;
            messageElem.textContent = message;
            confirmTextElem.textContent = buttonText;
            cancelBtn.classList.add('hidden');

            const style = typeStyles[type] || typeStyles.warning;
            iconContainer.className = `w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors ${style.iconBg}`;
            iconElem.textContent = style.iconName;
            confirmBtn.className = `px-5 py-2 rounded-xl font-semibold text-sm transition-all active:scale-95 duration-100 flex items-center justify-center gap-1.5 shadow-sm cursor-pointer ${style.btnClass}`;

            currentOnConfirm = onClose;
            currentOnCancel = onClose;

            openModal();
        };

        // Form submission confirmation helper
        window.confirmModal = function (event, message, title = 'Konfirmasi Hapus', type = 'danger', confirmText = 'Ya, Hapus') {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const form = event ? event.target.closest('form') : null;
            showConfirmModal({
                title: title,
                message: message,
                type: type,
                confirmText: confirmText,
                onConfirm: () => {
                    if (form) {
                        form.submit();
                    }
                }
            });
            return false;
        };

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                closeModal();
                if (typeof currentOnCancel === 'function') currentOnCancel();
            });
        }

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function () {
                closeModal();
                if (typeof currentOnConfirm === 'function') currentOnConfirm();
            });
        }

        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal();
                    if (typeof currentOnCancel === 'function') currentOnCancel();
                }
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal && modal.classList.contains('opacity-100')) {
                closeModal();
                if (typeof currentOnCancel === 'function') currentOnCancel();
            }
        });
    })();
</script>
