<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>BugStream - Add New User</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet"/>
    <!-- Tailwind Theme Configuration -->
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
                    "headline-sm": ["Inter"],
                    "display-lg": ["Inter"],
                    "mono-code": ["jetbrainsMono"],
                    "headline-md": ["Inter"],
                    "label-md": ["Inter"],
                    "body-md": ["Inter"],
                    "body-lg": ["Inter"]
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
        body { background-color: #f8f9ff; margin: 0; padding: 0; overflow-x: hidden; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="flex bg-background text-on-background font-body-md antialiased h-screen overflow-hidden">
    @include('layouts.sidebar')
    <div class="flex-1 ml-sidebar-width flex flex-col h-screen relative">
        @include('layouts.header')

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto mt-16 p-section-padding bg-background">
            <div class="max-w-3xl mx-auto space-y-container-gap">
                <!-- Page Breadcrumbs & Header -->
                <div>
                    <div class="flex items-center gap-3 text-label-md font-label-md text-secondary mb-2">
                        <a class="hover:text-primary transition-colors font-medium" href="{{ route('users.index') }}">User Management</a>
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        <span>Add New User</span>
                    </div>
                    <h2 class="text-display-lg font-display-lg text-on-surface">Add New User</h2>
                    <p class="text-body-md font-body-md text-on-surface-variant mt-1">Create a new team member account with designated system permissions.</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg font-body-md text-body-md flex flex-col gap-1">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-red-600 text-[18px]">error</span>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- User Creation Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-8">
                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Name Input -->
                        <div class="flex flex-col gap-2">
                            <label for="name" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Full Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none placeholder:text-outline-variant" placeholder="e.g. Luke Skywalker"/>
                        </div>

                        <!-- Email Input -->
                        <div class="flex flex-col gap-2">
                            <label for="email" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Email Address</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none placeholder:text-outline-variant" placeholder="e.g. luke@jedi.com"/>
                        </div>

                        <!-- Password Input -->
                        <div class="flex flex-col gap-2">
                            <label for="password" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Password</label>
                            <input id="password" name="password" type="password" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none placeholder:text-outline-variant" placeholder="Minimum 6 characters"/>
                        </div>

                        <!-- Role Select -->
                        <div class="flex flex-col gap-2">
                            <label for="role" class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Role</label>
                            <select id="role" name="role" required class="w-full bg-surface border border-outline-variant rounded-lg py-2.5 px-4 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none">
                                <option value="developer" {{ old('role') === 'developer' ? 'selected' : '' }}>Developer (Assigned Bugs view only)</option>
                                <option value="support_dev" {{ old('role') === 'support_dev' ? 'selected' : '' }}>Support / QA (Report Bugs and Retest)</option>
                                <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin (Full Access & CRUD)</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/50">
                            <a href="{{ route('users.index') }}" class="px-5 py-2.5 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md">
                                Cancel
                            </a>
                            <button type="submit" class="px-5 py-2.5 bg-primary text-on-primary rounded-lg hover:bg-surface-tint active:scale-[0.98] transition-all font-label-md text-label-md flex items-center gap-2 cursor-pointer shadow-sm">
                                <span class="material-symbols-outlined text-[18px]">person_add</span> Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
