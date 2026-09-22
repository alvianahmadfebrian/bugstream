<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign In - QATrack</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind Config -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
              "brand-primary": "#1B2CC1",
              "brand-hover": "#14219A",
              "on-primary-container": "#dbeafe",
              "tertiary-fixed-dim": "#fde68a",
              "inverse-on-surface": "#ffffff",
              "surface-container-lowest": "#ffffff",
              "secondary": "#71717a",
              "surface-bright": "#ffffff",
              "on-error-container": "#991b1b",
              "primary-container": "#1e40af",
              "on-secondary-fixed-variant": "#3f3f46",
              "on-tertiary-fixed": "#78350f",
              "surface": "#ffffff",
              "primary-fixed-dim": "#e4e4e7",
              "on-secondary-fixed": "#18181b",
              "outline-variant": "#e4e4e7",
              "secondary-fixed": "#f4f4f5",
              "tertiary": "#78350f",
              "surface-container-highest": "#e4e4e7",
              "error": "#dc2626",
              "on-tertiary-container": "#92400e",
              "tertiary-container": "#fef3c7",
              "inverse-primary": "#e4e4e7",
              "on-surface": "#18181b",
              "surface-tint": "#1e40af",
              "background": "#ffffff",
              "surface-dim": "#f4f4f5",
              "secondary-fixed-dim": "#e4e4e7",
              "on-secondary-container": "#1e3a8a",
              "surface-container": "#f4f4f5",
              "primary": "#1B2CC1",
              "surface-variant": "#f4f4f5",
              "on-background": "#18181b",
              "tertiary-fixed": "#fef3c7",
              "on-surface-variant": "#52525b",
              "primary-fixed": "#f4f4f5",
              "secondary-container": "#eff6ff",
              "on-primary": "#ffffff",
              "error-container": "#fee2e2",
              "on-secondary": "#ffffff",
              "inverse-surface": "#1e3a8a",
              "outline": "#a1a1aa",
              "on-tertiary": "#ffffff",
              "on-primary-fixed-variant": "#3f3f46",
              "surface-container-high": "#e4e4e7",
              "surface-container-low": "#fafafa",
              "on-error": "#ffffff",
              "on-primary-fixed": "#18181b",
              "on-tertiary-fixed-variant": "#92400e"
            },
            "borderRadius": {
              "DEFAULT": "0.25rem",
              "lg": "0.5rem",
              "xl": "0.75rem",
              "2xl": "1rem",
              "full": "9999px"
            },
            "spacing": {
              "sidebar-width": "260px",
              "grid-gutter": "16px",
              "element-gap": "12px",
              "section-padding": "32px",
              "container-gap": "20px",
              "grid-margin": "24px"
            },
            "fontFamily": {
              "headline-sm": ["Inter", "sans-serif"],
              "display-lg": ["Inter", "sans-serif"],
              "mono-code": ["jetbrainsMono", "monospace"],
              "headline-md": ["Inter", "sans-serif"],
              "label-md": ["Inter", "sans-serif"],
              "body-md": ["Inter", "sans-serif"],
              "body-lg": ["Inter", "sans-serif"]
            },
            "fontSize": {
              "headline-sm": ["18px", {"lineHeight": "28px", "fontWeight": "600"}],
              "display-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "600"}],
              "mono-code": ["13px", {"lineHeight": "20px", "fontWeight": "400"}],
              "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
              "label-md": ["13px", {"lineHeight": "18px", "fontWeight": "500"}],
              "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
              "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          }
        }
      }
    </script>
    <style>
        /* Import Inter for exact matching */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            background-color: #F5F6FA; 
            background-image: radial-gradient(circle at top right, rgba(27, 44, 193, 0.05) 0%, transparent 60%);
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center px-4 py-8 text-on-background relative overflow-x-hidden">
    <!-- Decorative subtle background elements for modern minimalism -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-40">
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-blue-100 blur-3xl mix-blend-multiply opacity-40"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[40%] h-[40%] rounded-full bg-slate-200 blur-3xl mix-blend-multiply opacity-50"></div>
    </div>
    
    <!-- Login Card Container -->
    <div class="w-full max-w-[420px] bg-white rounded-2xl shadow-[0_10px_25px_-5px_rgba(27,44,193,0.07),0_8px_10px_-6px_rgba(0,0,0,0.04)] border border-slate-200/90 p-8 sm:p-9 relative z-10">
        <!-- Header / Logo Area -->
        <div class="flex flex-col items-center mb-7">
            <img src="{{ asset('images/logo.png') }}" alt="QATrack" class="h-14 sm:h-16 w-auto object-contain mb-4">
            <h1 class="sr-only">QATrack</h1>
            <p class="text-sm sm:text-[14px] text-slate-500 text-center leading-relaxed">Sign in to manage bugs and testing workflows.</p>
        </div>

        <!-- Success Flash Message -->
        @if (session('status'))
            <div class="mb-5 p-3.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-start gap-2.5">
                <span class="material-symbols-outlined text-[20px] text-emerald-600 shrink-0">check_circle</span>
                <p class="font-medium pt-0.5 leading-snug">{{ session('status') }}</p>
            </div>
        @endif

        <!-- Validation Error Message Block -->
        @if ($errors->any() && !$errors->has('reset_email') && !$errors->has('new_password'))
            <div class="mb-5 p-3.5 rounded-lg bg-red-50 border border-red-200 text-red-700 text-xs sm:text-sm flex items-start gap-2.5">
                <span class="material-symbols-outlined text-[20px] text-red-600 shrink-0">error</span>
                <div class="flex flex-col gap-1 pt-0.5">
                    @foreach ($errors->all() as $error)
                        @if (!str_contains($error, 'reset') && !str_contains($error, 'Reset'))
                            <p class="font-medium leading-snug">{{ $error }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Form -->
        <form class="flex flex-col gap-5" action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email or Username Input Group -->
            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-slate-800" for="email">Email or Username</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3.5 text-slate-600 text-[20px] pointer-events-none select-none">person</span>
                    <input 
                        class="w-full h-11 pl-11 pr-4 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] transition-all text-sm text-slate-900 placeholder:text-slate-400 {{ $errors->has('email') ? 'border-red-400 bg-red-50/20' : 'border-slate-300' }}" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="admin@company.com or username" 
                        required 
                        type="text"
                    />
                </div>
            </div>

            <!-- Password Input Group -->
            <div class="flex flex-col gap-1.5">
                <div class="flex justify-between items-center">
                    <label class="text-sm font-medium text-slate-800" for="password">Password</label>
                    <button type="button" onclick="openForgotPasswordModal()" class="text-sm font-medium text-[#1B2CC1] hover:text-[#14219A] hover:underline transition-colors focus:outline-none cursor-pointer">
                        Forgot password?
                    </button>
                </div>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3.5 text-slate-600 text-[20px] pointer-events-none select-none">lock</span>
                    <input 
                        class="w-full h-11 pl-11 pr-11 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] transition-all text-sm text-slate-900 placeholder:text-slate-400 {{ $errors->has('password') ? 'border-red-400 bg-red-50/20' : 'border-slate-300' }}" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required 
                        type="password"
                    />
                    <button 
                        type="button" 
                        id="toggle-password-btn" 
                        onclick="togglePasswordVisibility('password', 'password-eye-icon')" 
                        class="absolute right-3 text-slate-500 hover:text-slate-700 focus:outline-none p-1 flex items-center justify-center transition-colors cursor-pointer"
                        title="Show or hide password"
                        aria-label="Show or hide password"
                    >
                        <span id="password-eye-icon" class="material-symbols-outlined text-[20px] select-none">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Remember Me checkbox -->
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="h-4 w-4 text-[#1B2CC1] focus:ring-[#1B2CC1]/30 border-slate-300 rounded cursor-pointer"
                />
                <label for="remember" class="ml-2.5 text-sm font-medium text-slate-600 select-none cursor-pointer">Remember me</label>
            </div>

            <!-- Submit Button -->
            <button 
                class="w-full h-11 mt-1 flex items-center justify-center text-white rounded-lg font-semibold text-sm shadow-md shadow-[#1B2CC1]/20 transition-all duration-150 cursor-pointer active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/40" 
                style="background-color: #1B2CC1;"
                onmouseover="this.style.backgroundColor='#14219A'" 
                onmouseout="this.style.backgroundColor='#1B2CC1'"
                type="submit"
            >
                Sign In
            </button>
        </form>
    </div>

    <!-- Forgot Password Modal Dialog -->
    <div 
        id="forgot-password-modal" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs transition-opacity duration-200 {{ ($errors->has('reset_email') || $errors->has('new_password') || session('show_reset_modal')) ? '' : 'hidden' }}"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
    >
        <div class="bg-white w-full max-w-[420px] rounded-2xl shadow-2xl border border-slate-100 p-6 sm:p-8 relative transform transition-all">
            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeForgotPasswordModal()" 
                class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-1.5 rounded-full hover:bg-slate-100 transition-colors focus:outline-none cursor-pointer"
                aria-label="Close"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>

            <!-- Modal Header -->
            <div class="flex flex-col items-center text-center mb-6">
                <div class="w-12 h-12 rounded-full bg-blue-50 text-[#1B2CC1] flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-[26px]">lock_reset</span>
                </div>
                <h2 id="modal-title" class="text-lg font-bold text-slate-900">Reset Password</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Enter your registered email and set a new password for your account.</p>
            </div>

            <!-- Modal Errors -->
            @if ($errors->has('reset_email') || $errors->has('new_password'))
                <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-xs flex items-start gap-2">
                    <span class="material-symbols-outlined text-[18px] text-red-600 shrink-0">error</span>
                    <div class="flex flex-col gap-0.5">
                        @if ($errors->has('reset_email'))
                            <p class="font-medium">{{ $errors->first('reset_email') }}</p>
                        @endif
                        @if ($errors->has('new_password'))
                            <p class="font-medium">{{ $errors->first('new_password') }}</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Modal Form -->
            <form action="{{ route('password.reset.guest') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <!-- Email Field -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs sm:text-sm font-medium text-slate-800" for="reset_email">Registered Email</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-slate-600 text-[18px] pointer-events-none select-none">mail</span>
                        <input 
                            class="w-full h-10 pl-10 pr-3.5 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] text-xs sm:text-sm text-slate-900 placeholder:text-slate-400" 
                            id="reset_email" 
                            name="reset_email" 
                            value="{{ old('reset_email') }}" 
                            placeholder="admin@company.com" 
                            required 
                            type="email"
                        />
                    </div>
                </div>

                <!-- New Password Field -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs sm:text-sm font-medium text-slate-800" for="new_password">New Password</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-slate-600 text-[18px] pointer-events-none select-none">lock</span>
                        <input 
                            class="w-full h-10 pl-10 pr-10 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] text-xs sm:text-sm text-slate-900 placeholder:text-slate-400" 
                            id="new_password" 
                            name="new_password" 
                            placeholder="Min. 6 characters" 
                            required 
                            type="password"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('new_password', 'new-pwd-eye-icon')" 
                            class="absolute right-2.5 text-slate-400 hover:text-slate-600 focus:outline-none p-1 flex items-center justify-center cursor-pointer"
                            aria-label="Toggle password visibility"
                        >
                            <span id="new-pwd-eye-icon" class="material-symbols-outlined text-[18px]">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs sm:text-sm font-medium text-slate-800" for="new_password_confirmation">Confirm New Password</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-slate-600 text-[18px] pointer-events-none select-none">lock</span>
                        <input 
                            class="w-full h-10 pl-10 pr-10 bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B2CC1]/20 focus:border-[#1B2CC1] text-xs sm:text-sm text-slate-900 placeholder:text-slate-400" 
                            id="new_password_confirmation" 
                            name="new_password_confirmation" 
                            placeholder="Re-enter new password" 
                            required 
                            type="password"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('new_password_confirmation', 'confirm-pwd-eye-icon')" 
                            class="absolute right-2.5 text-slate-400 hover:text-slate-600 focus:outline-none p-1 flex items-center justify-center cursor-pointer"
                            aria-label="Toggle password confirmation visibility"
                        >
                            <span id="confirm-pwd-eye-icon" class="material-symbols-outlined text-[18px]">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Modal Action Buttons -->
                <div class="flex items-center gap-3 mt-3">
                    <button 
                        type="button" 
                        onclick="closeForgotPasswordModal()" 
                        class="w-1/2 h-10 border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium text-xs sm:text-sm rounded-lg transition-colors cursor-pointer"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="w-1/2 h-10 text-white font-semibold text-xs sm:text-sm rounded-lg transition-all duration-150 cursor-pointer shadow-sm shadow-[#1B2CC1]/20"
                        style="background-color: #1B2CC1;"
                        onmouseover="this.style.backgroundColor='#14219A'" 
                        onmouseout="this.style.backgroundColor='#1B2CC1'"
                    >
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        function openForgotPasswordModal() {
            const modal = document.getElementById('forgot-password-modal');
            const loginEmail = document.getElementById('email');
            const resetEmail = document.getElementById('reset_email');
            
            if (loginEmail && resetEmail && !resetEmail.value && loginEmail.value) {
                resetEmail.value = loginEmail.value;
            }
            
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeForgotPasswordModal() {
            const modal = document.getElementById('forgot-password-modal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        // Close modal on Escape key press
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeForgotPasswordModal();
            }
        });

        // Close modal when clicking on backdrop
        document.getElementById('forgot-password-modal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeForgotPasswordModal();
            }
        });
    </script>
</body>
</html>
