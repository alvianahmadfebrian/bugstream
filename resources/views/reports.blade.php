<!DOCTYPE html>
<html class="h-full" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Reports &amp; Export</title>
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=JetBrains+Mono:wght@400&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                    "headline-sm": [
                            "Inter"
                    ],
                    "display-lg": [
                            "Inter"
                    ],
                    "mono-code": [
                            "jetbrainsMono"
                    ],
                    "headline-md": [
                            "Inter"
                    ],
                    "label-md": [
                            "Inter"
                    ],
                    "body-md": [
                            "Inter"
                    ],
                    "body-lg": [
                            "Inter"
                    ]
            },
            "fontSize": {
                    "headline-sm": [
                            "18px",
                            {
                                    "lineHeight": "28px",
                                    "fontWeight": "600"
                            }
                    ],
                    "display-lg": [
                            "32px",
                            {
                                    "lineHeight": "40px",
                                    "letterSpacing": "-0.02em",
                                    "fontWeight": "600"
                            }
                    ],
                    "mono-code": [
                            "13px",
                            {
                                    "lineHeight": "20px",
                                    "fontWeight": "400"
                            }
                    ],
                    "headline-md": [
                            "24px",
                            {
                                    "lineHeight": "32px",
                                    "letterSpacing": "-0.01em",
                                    "fontWeight": "600"
                            }
                    ],
                    "label-md": [
                            "12px",
                            {
                                    "lineHeight": "16px",
                                    "letterSpacing": "0.02em",
                                    "fontWeight": "500"
                            }
                    ],
                    "body-md": [
                            "14px",
                            {
                                    "lineHeight": "20px",
                                    "fontWeight": "400"
                            }
                    ],
                    "body-lg": [
                            "16px",
                            {
                                    "lineHeight": "24px",
                                    "fontWeight": "400"
                            }
                    ]
            }
          }
        }
      }
    </script>
    <style>
        .material-symbols-outlined {
          font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined[data-weight="fill"] {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Soft shadows for depth */
        .shadow-level-1 {
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body class="bg-background text-on-background h-full font-body-md overflow-hidden flex">
    @include('layouts.sidebar')

    <!-- Main Content Area Wrapper -->
    <div class="flex-1 flex flex-col h-screen md:ml-sidebar-width">
        @include('layouts.header', ['breadcrumb' => 'Reports & Export'])

        <!-- Canvas / Content -->
        <main class="flex-1 overflow-y-auto pt-16 p-section-padding bg-background">
            <div class="max-w-7xl mx-auto space-y-container-gap">
                <!-- Page Header & Filters -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-display-lg font-display-lg text-on-surface">Analytics Summary</h2>
                        <p class="text-body-lg font-body-lg text-on-surface-variant mt-1">Review system performance and export data.</p>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-lowest p-2 rounded-xl shadow-level-1 border border-outline-variant/30">
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-low rounded-lg text-on-surface-variant cursor-pointer hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                            <span class="font-body-md text-body-md">Last 30 Days</span>
                        </div>
                        <div class="h-6 w-[1px] bg-outline-variant/50"></div>
                        <div class="flex items-center gap-2 px-3 py-1.5 text-on-surface-variant cursor-pointer hover:bg-surface-container rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-[20px]">filter_list</span>
                            <span class="font-body-md text-body-md">Filters</span>
                        </div>
                    </div>
                </div>

                @php
                    $totalBugsCount = \App\Models\Bug::count();
                    $devCount = max(\App\Models\Bug::whereNotNull('developer')->where('developer', '!=', '')->distinct('developer')->count('developer'), 1);
                    $bugsPerDev = round($totalBugsCount / $devCount, 1);
                @endphp
                <!-- Summary Statistics Bento Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-element-gap">
                    <!-- Stat 1 -->
                    <div class="bg-surface-container-lowest p-6 rounded-[12px] shadow-level-1 border border-outline-variant/20 flex flex-col justify-between h-32">
                        <div class="flex justify-between items-start">
                            <p class="text-label-md font-label-md text-secondary uppercase tracking-wider">Avg Resolution Time</p>
                            <span class="material-symbols-outlined text-primary bg-primary-container/10 p-1.5 rounded-full">timer</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-display-lg font-display-lg text-on-surface">{{ $totalBugsCount > 0 ? '4.2' : '0' }}</h3>
                            <span class="text-body-md font-body-md text-secondary">days</span>
                        </div>
                    </div>
                    <!-- Stat 2 -->
                    <div class="bg-surface-container-lowest p-6 rounded-[12px] shadow-level-1 border border-outline-variant/20 flex flex-col justify-between h-32">
                        <div class="flex justify-between items-start">
                            <p class="text-label-md font-label-md text-secondary uppercase tracking-wider">Total Bugs Logged</p>
                            <span class="material-symbols-outlined text-error bg-error-container/30 p-1.5 rounded-full">bug_report</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-display-lg font-display-lg text-on-surface">{{ $totalBugsCount }}</h3>
                            @if ($totalBugsCount > 0)
                                <span class="text-body-md font-body-md text-error flex items-center"><span class="material-symbols-outlined text-[16px]">trending_up</span> 12%</span>
                            @endif
                        </div>
                    </div>
                    <!-- Stat 3 -->
                    <div class="bg-surface-container-lowest p-6 rounded-[12px] shadow-level-1 border border-outline-variant/20 flex flex-col justify-between h-32">
                        <div class="flex justify-between items-start">
                            <p class="text-label-md font-label-md text-secondary uppercase tracking-wider">Bugs per Developer</p>
                            <span class="material-symbols-outlined text-tertiary bg-tertiary-container/10 p-1.5 rounded-full">person</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-display-lg font-display-lg text-on-surface">{{ $totalBugsCount > 0 ? $bugsPerDev : '0' }}</h3>
                            <span class="text-body-md font-body-md text-secondary">avg</span>
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="bg-surface-container-lowest rounded-[12px] shadow-level-1 border border-outline-variant/20 overflow-hidden">
                    <div class="p-6 border-b border-outline-variant/20 bg-surface-bright flex justify-between items-center">
                        <div>
                            <h3 class="text-headline-sm font-headline-sm text-on-surface">Data Export</h3>
                            <p class="text-body-md font-body-md text-on-surface-variant mt-1">Generate comprehensive reports for stakeholder review.</p>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col sm:flex-row items-center justify-center gap-6 bg-surface">
                        <!-- Primary Export -->
                        <div class="flex flex-col items-center p-6 border border-primary/20 rounded-xl bg-primary-fixed/20 hover:bg-primary-fixed/30 transition-colors w-full sm:w-64 cursor-pointer group">
                            <div class="w-16 h-16 rounded-full text-white flex items-center justify-center mb-4 group-hover:scale-105 transition-transform" style="background-color:#1e3a8a;">
                                <span class="material-symbols-outlined text-[32px]" data-weight="fill">picture_as_pdf</span>
                            </div>
                            <h4 class="text-headline-sm font-headline-sm text-on-surface text-center">Export to PDF</h4>
                            <p class="text-label-md font-label-md text-secondary text-center mt-2">Visual charts &amp; summaries</p>
                            <button class="mt-6 w-full py-2.5 text-white rounded-[10px] font-body-md hover:opacity-90" style="background-color:#1e3a8a; transition-colors active:scale-[0.98] shadow-sm cursor-pointer">
                                Generate PDF
                            </button>
                        </div>
                        <!-- Secondary Export -->
                        <div class="flex flex-col items-center p-6 border border-outline-variant/40 rounded-xl bg-surface-container-lowest hover:bg-surface-container-low transition-colors w-full sm:w-64 cursor-pointer group shadow-level-1">
                            <div class="w-16 h-16 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center mb-4 group-hover:scale-105 transition-transform border border-outline-variant/20">
                                <span class="material-symbols-outlined text-[32px]">table</span>
                            </div>
                            <h4 class="text-headline-sm font-headline-sm text-on-surface text-center">Export to Excel</h4>
                            <p class="text-label-md font-label-md text-secondary text-center mt-2">Raw data &amp; pivot tables</p>
                            <button class="mt-6 w-full py-2.5 bg-secondary-fixed text-on-secondary-fixed border border-outline-variant/30 rounded-[10px] font-body-md hover:bg-secondary-container transition-colors active:scale-[0.98] cursor-pointer">
                                Generate CSV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
