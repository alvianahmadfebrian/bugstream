<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>BugStream - Report Bug</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=JetBrains+Mono:wght@400&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "full": "9999px",
                        "button": "10px"
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
                        "mono-code": ["JetBrains Mono"],
                        "headline-md": ["Inter"],
                        "label-md": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-sm": ["18px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "display-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "mono-code": ["13px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
    <style>
        .custom-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased flex overflow-hidden">
    @include('layouts.sidebar')
    @include('layouts.header')

    <!-- Main Content -->
    <main class="ml-sidebar-width mt-16 w-full h-[calc(100vh-64px)] overflow-y-auto bg-background p-section-padding">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h2 class="text-display-lg font-display-lg text-on-surface">Report New Bug</h2>
                <p class="text-body-md font-body-md text-secondary mt-1">Provide detailed information to help the team reproduce and fix the issue.</p>
            </div>

            <!-- Validation Errors Block -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-[#ffdad6] border border-[#ba1a1a]/20 text-[#93000a] text-xs flex items-start gap-2">
                    <span class="material-symbols-outlined text-[18px] shrink-0">error</span>
                    <div class="flex flex-col gap-0.5">
                        @foreach ($errors->all() as $error)
                            <p class="font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form class="bg-surface-container-lowest rounded-xl custom-shadow border border-outline-variant/40 p-container-gap" action="{{ route('bugs.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2" for="bugTitle">Bug Title <span class="text-error">*</span></label>
                        <input 
                            class="w-full bg-surface-container-lowest border rounded-lg px-4 py-2.5 text-body-md focus:outline-none focus:ring-1 transition-shadow placeholder-outline {{ $errors->has('title') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}" 
                            id="bugTitle" 
                            name="title" 
                            value="{{ old('title') }}"
                            placeholder="e.g., Cannot save user profile settings on Safari" 
                            required 
                            type="text"
                        />
                    </div>

                    <!-- Dropdowns -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Priority -->
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="priority">Priority</label>
                            <div class="relative">
                                <select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" id="priority" name="priority">
                                    <option value="p3" {{ old('priority') == 'p3' ? 'selected' : '' }}>P3 - Low</option>
                                    <option value="p2" {{ old('priority') == 'p2' ? 'selected' : '' }}>P2 - Medium</option>
                                    <option value="p1" {{ old('priority') == 'p1' ? 'selected' : '' }}>P1 - High (Critical)</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="status">Status</label>
                            <div class="relative">
                                <select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" id="status" name="status">
                                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Assignee -->
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2" for="assignee">Assign Developer</label>
                            <div class="relative">
                                <select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-shadow" id="assignee" name="developer">
                                    <option value="" {{ old('developer') == '' ? 'selected' : '' }}>Unassigned</option>
                                    <option value="Alex Mercer" {{ old('developer') == 'Alex Mercer' ? 'selected' : '' }}>Alex Mercer (Frontend)</option>
                                    <option value="Sarah Chen" {{ old('developer') == 'Sarah Chen' ? 'selected' : '' }}>Sarah Chen (Backend)</option>
                                    <option value="Marcus Johnson" {{ old('developer') == 'Marcus Johnson' ? 'selected' : '' }}>Marcus Johnson (QA)</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2" for="description">Description &amp; Steps to Reproduce <span class="text-error">*</span></label>
                        <textarea 
                            class="w-full bg-surface-container-lowest border rounded-lg px-4 py-3 text-body-md font-mono-code focus:outline-none focus:ring-1 transition-shadow placeholder-outline resize-y {{ $errors->has('description') ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary' }}" 
                            id="description" 
                            name="description" 
                            placeholder="1. Go to...\n2. Click on...\n3. Expected result...\n4. Actual result..." 
                            required 
                            rows="5"
                        >{{ old('description') }}</textarea>
                    </div>

                    <!-- Attachments -->
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2">Attachments</label>
                        <div class="border-2 border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center bg-surface hover:bg-surface-container-low transition-colors cursor-pointer group">
                            <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
                                <span class="material-symbols-outlined text-primary text-[24px]">cloud_upload</span>
                            </div>
                            <p class="font-label-md text-label-md text-on-surface text-center mb-1">Drag and drop screenshots here</p>
                            <p class="font-body-md text-body-md text-secondary text-center mb-4">or click to browse files (Max 5MB)</p>
                            <div class="flex gap-4 w-full overflow-x-auto pb-2 px-2 hidden" id="preview-area">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="mt-8 pt-6 border-t border-outline-variant/30 flex justify-end gap-4">
                    <a href="{{ route('bugs') }}" class="px-6 py-2.5 rounded-button font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors flex items-center justify-center" type="button">
                        Cancel
                    </a>
                    <button class="px-6 py-2.5 rounded-button font-label-md text-label-md bg-primary text-on-primary shadow-sm hover:scale-[0.98] transition-transform cursor-pointer" type="submit">
                        Submit Bug
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
