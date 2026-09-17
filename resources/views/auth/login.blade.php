<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - QATrack</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind Config -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {                    "colors": {
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
                        "primary": "#1e3a8a",
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
                    "full": "9999px"
            },
            "spacing": {
                    "sidebar-width": "260px",
                    "grid-gutter": "16px",
                    "element-gap": "12px",
                    "section-padding": "32px",
                    "container-gap": "24px",
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
                    "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500"}],
                    "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          }
        }
      }
    </script>
    <style>
        /* Import Inter for exact matching */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            /* Applying subtle light gray background specifically requested, mapped to design system */
            background-color: #F5F6FA; 
            /* Overlaying the design system background to blend */
            background-image: radial-gradient(circle at top right, var(--tw-colors-surface-container-high) 0%, transparent 60%);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center px-4 font-body-md text-body-md text-on-background relative overflow-hidden">
    <!-- Decorative subtle background elements for modern minimalism -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-40">
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-primary-fixed-dim blur-3xl mix-blend-multiply opacity-20"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[40%] h-[40%] rounded-full bg-surface-container-high blur-3xl mix-blend-multiply opacity-30"></div>
    </div>
    
    <!-- Login Card Container -->
    <div class="w-full max-w-[400px] bg-surface-container-lowest rounded-[10px] shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30 p-section-padding relative z-10">
        <!-- Header / Logo Area -->
        <div class="flex flex-col items-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="QATrack" class="h-12 w-auto object-contain mb-3">
            <h1 class="sr-only">QATrack</h1>
            <p class="font-body-md text-body-md text-on-surface-variant text-center">Sign in to manage your enterprise workflows.</p>
        </div>

        <!-- Validation Error Message Block -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-[#ffdad6] border border-[#ba1a1a]/20 text-[#93000a] text-xs flex items-start gap-2">
                <span class="material-symbols-outlined text-[18px] shrink-0">error</span>
                <div class="flex flex-col gap-0.5">
                    @foreach ($errors->all() as $error)
                        <p class="font-medium">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Form -->
        <form class="flex flex-col gap-container-gap" action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email Input Group -->
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-label-md text-on-surface" for="email">Email or Username</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/70 text-[20px] pointer-events-none">mail</span>
                    <input 
                        class="w-full h-11 pl-10 pr-4 bg-surface-container-lowest border rounded-md focus:outline-none focus:ring-2 transition-all font-body-md text-body-md placeholder:text-on-surface-variant/50 {{ $errors->has('email') ? 'border-error text-error focus:border-error focus:ring-error/20' : 'border-outline-variant text-on-surface focus:border-primary focus:ring-primary/20' }}" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="admin@company.com" 
                        required 
                        type="text"
                    />
                </div>
            </div>
            <!-- Password Input Group -->
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
                    <a class="font-label-md text-label-md text-primary hover:text-primary-fixed-dim transition-colors" href="#">Forgot password?</a>
                </div>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/70 text-[20px] pointer-events-none">lock</span>
                    <input 
                        class="w-full h-11 pl-10 pr-4 bg-surface-container-lowest border rounded-md focus:outline-none focus:ring-2 transition-all font-body-md text-body-md placeholder:text-on-surface-variant/50 {{ $errors->has('password') ? 'border-error text-error focus:border-error focus:ring-error/20' : 'border-outline-variant text-on-surface focus:border-primary focus:ring-primary/20' }}" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required 
                        type="password"
                    />
                </div>
            </div>
            <!-- Remember Me checkbox -->
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="h-4 w-4 text-primary focus:ring-primary/20 border-outline-variant rounded"
                />
                <label for="remember" class="ml-2 font-label-md text-label-md text-on-surface-variant select-none">Remember me</label>
            </div>
            <!-- Submit Button -->
            <button class="w-full h-11 mt-2 flex items-center justify-center text-white rounded-[10px] font-label-md text-label-md hover:opacity-90" style="background-color:#1e3a8a; active:scale-[0.98] transition-all duration-150 shadow-sm cursor-pointer" type="submit">
                Login
            </button>
        </form>
    </div>
</body>
</html>
