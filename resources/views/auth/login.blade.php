<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - BugStream</title>
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
                    "on-primary-container": "#90a8ff",
                    "tertiary-fixed-dim": "#ffb691",
                    "inverse-on-surface": "#eaf1ff",
                    "surface-container-lowest": "#ffffff",
                    "secondary": "#5c5e62",
                    "surface-bright": "#f8f9ff",
                    "on-error-container": "#93000a",
                    "primary-container": "#1e3a8a",
                    "on-secondary-fixed-variant": "#44474a",
                    "on-tertiary-fixed": "#341100",
                    "surface": "#f8f9ff",
                    "primary-fixed-dim": "#b6c4ff",
                    "on-secondary-fixed": "#191c1f",
                    "outline-variant": "#c5c5d3",
                    "secondary-fixed": "#e1e2e6",
                    "tertiary": "#4b1c00",
                    "surface-container-highest": "#d3e4fe",
                    "error": "#ba1a1a",
                    "on-tertiary-container": "#f39461",
                    "tertiary-container": "#6e2c00",
                    "inverse-primary": "#b6c4ff",
                    "on-surface": "#0b1c30",
                    "surface-tint": "#4059aa",
                    "background": "#f8f9ff",
                    "surface-dim": "#cbdbf5",
                    "secondary-fixed-dim": "#c5c6ca",
                    "on-secondary-container": "#606366",
                    "surface-container": "#e5eeff",
                    "primary": "#00236f",
                    "surface-variant": "#d3e4fe",
                    "on-background": "#0b1c30",
                    "tertiary-fixed": "#ffdbcb",
                    "on-surface-variant": "#444651",
                    "primary-fixed": "#dce1ff",
                    "secondary-container": "#dedfe3",
                    "on-primary": "#ffffff",
                    "error-container": "#ffdad6",
                    "on-secondary": "#ffffff",
                    "inverse-surface": "#213145",
                    "outline": "#757682",
                    "on-tertiary": "#ffffff",
                    "on-primary-fixed-variant": "#264191",
                    "surface-container-high": "#dce9ff",
                    "surface-container-low": "#eff4ff",
                    "on-error": "#ffffff",
                    "on-primary-fixed": "#00164e",
                    "on-tertiary-fixed-variant": "#773205"
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
            <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">bug_report</span>
            </div>
            <h1 class="font-headline-md text-headline-md text-on-surface">BugStream</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1 text-center">Sign in to manage your enterprise workflows.</p>
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
            <button class="w-full h-11 mt-2 flex items-center justify-center bg-primary text-on-primary rounded-[10px] font-label-md text-label-md hover:bg-on-primary-fixed active:scale-[0.98] transition-all duration-150 shadow-sm cursor-pointer" type="submit">
                Login
            </button>
        </form>
    </div>
</body>
</html>
