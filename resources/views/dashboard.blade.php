<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard - QATrack Management System</title>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
    <!-- JetBrains Mono -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                            "headline-sm": ["Inter"],
                            "display-lg": ["Inter"],
                            "mono-code": ["JetBrains Mono"],
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
</head>
<body class="bg-background text-on-background font-body-md min-h-screen overflow-x-hidden">
    @include('layouts.header')
    @include('layouts.sidebar')

    <!-- Main Content Canvas -->
    <main class="ml-sidebar-width pt-16 min-h-screen bg-background">
        <div class="p-section-padding max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="mb-container-gap">
                <h2 class="font-display-lg text-display-lg mb-1 font-semibold" style="color:#1e3a8a">Dashboard Overview</h2>
                <p class="font-body-md text-body-md text-secondary">Welcome back, {{ auth()->user()->name }}! Real-time bug metrics and recent activity tracking.</p>
            </div>
            @php
                $user = auth()->user();
                $baseQuery = \App\Models\Bug::query();
                if ($user->role === 'support_dev') {
                    $baseQuery->where('reporter_id', $user->id);
                } elseif ($user->role === 'developer') {
                    $baseQuery->where('developer', $user->name);
                }

                $totalBugs = (clone $baseQuery)->count();
                $openCount = (clone $baseQuery)->where('status', 'open')->count();
                $inProgressCount = (clone $baseQuery)->where('status', 'in_progress')->count();
                $resolvedCount = (clone $baseQuery)->whereIn('status', ['resolved', 'fixed'])->count();

                $p1Count = (clone $baseQuery)->where('priority', 'p1')->count();
                $p2Count = (clone $baseQuery)->where('priority', 'p2')->count();
                $p3Count = (clone $baseQuery)->where('priority', 'p3')->count();
                $totalPriority = max($p1Count + $p2Count + $p3Count, 1);
                $p1Percent = min(100, round(($p1Count / $totalPriority) * 100));
                $p2Percent = min(100, round(($p2Count / $totalPriority) * 100));
                $p3Percent = min(100, round(($p3Count / $totalPriority) * 100));
            @endphp
            <!-- Bento Grid - Top Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-container-gap mb-container-gap">
                <!-- Summary Card 1: Total -->
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-[20px]">bug_report</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-secondary mb-1">Total Bugs</p>
                        <h3 class="font-display-lg text-display-lg text-on-background">{{ $totalBugs }}</h3>
                    </div>
                </div>
                <!-- Summary Card 2: Open -->
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-full bg-error-container/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-error text-[20px]">error</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-secondary mb-1">Open Issues</p>
                        <h3 class="font-display-lg text-display-lg text-on-background">{{ $openCount }}</h3>
                    </div>
                </div>
                <!-- Summary Card 3: In Progress -->
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-full bg-tertiary-container/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-tertiary-container text-[20px]">sync</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-secondary mb-1">In Progress</p>
                        <h3 class="font-display-lg text-display-lg text-on-background">{{ $inProgressCount }}</h3>
                    </div>
                </div>
                <!-- Summary Card 4: Fixed -->
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-[20px]">check_circle</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-body-md text-body-md text-secondary mb-1">Fixed</p>
                        <h3 class="font-display-lg text-display-lg text-on-background">{{ $resolvedCount }}</h3>
                    </div>
                </div>
            </div>
            <!-- Complex Layout Grid - Bottom Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-container-gap">
                <!-- Chart Area -->
                <div class="lg:col-span-1 bg-surface-container-lowest rounded-xl p-6 shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30">
                    <h3 class="font-headline-sm text-headline-sm text-on-background mb-6">Distribution by Priority</h3>
                    <!-- Faux Bar Chart -->
                    <div class="flex flex-col gap-6">
                        <!-- P1 Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-label-md text-label-md text-on-background flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-error"></span> P1 Critical
                                </span>
                                <span class="font-mono-code text-mono-code text-secondary">{{ $p1Count }}</span>
                            </div>
                            <div class="w-full bg-surface-container h-3 rounded-full overflow-hidden">
                                <div class="bg-error h-full rounded-full" style="width: {{ $p1Percent }}%"></div>
                            </div>
                        </div>
                        <!-- P2 Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-label-md text-label-md text-on-background flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-tertiary-container"></span> P2 High
                                </span>
                                <span class="font-mono-code text-mono-code text-secondary">{{ $p2Count }}</span>
                            </div>
                            <div class="w-full bg-surface-container h-3 rounded-full overflow-hidden">
                                <div class="bg-tertiary-container h-full rounded-full" style="width: {{ $p2Percent }}%"></div>
                            </div>
                        </div>
                        <!-- P3 Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-label-md text-label-md text-on-background flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-primary-fixed-dim"></span> P3 Medium
                                </span>
                                <span class="font-mono-code text-mono-code text-secondary">{{ $p3Count }}</span>
                            </div>
                            <div class="w-full bg-surface-container h-3 rounded-full overflow-hidden">
                                <div class="bg-primary-fixed-dim h-full rounded-full" style="width: {{ $p3Percent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recent Activity Table -->
                <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.04)] border border-outline-variant/30 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-outline-variant/50 flex justify-between items-center">
                        <h3 class="font-headline-sm text-headline-sm text-on-background">Recent Activity</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-bright border-b border-outline-variant/50">
                                    <th class="p-4 font-label-md text-label-md text-secondary uppercase tracking-wider">ID</th>
                                    <th class="p-4 font-label-md text-label-md text-secondary uppercase tracking-wider">Title</th>
                                    <th class="p-4 font-label-md text-label-md text-secondary uppercase tracking-wider">Priority</th>
                                    <th class="p-4 font-label-md text-label-md text-secondary uppercase tracking-wider">Status</th>
                                    <th class="p-4 font-label-md text-label-md text-secondary uppercase tracking-wider">Developer</th>
                                    <th class="p-4 font-label-md text-label-md text-secondary uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-body-md">
                                @forelse ($recentBugs as $bug)
                                    <tr class="border-b border-outline-variant/30 hover:bg-surface-container-low transition-colors">
                                        <td class="p-4 font-mono-code text-mono-code text-secondary">#BUG-{{ 4000 + $bug->id }}</td>
                                        <td class="p-4 text-on-background font-medium truncate max-w-[200px]">
                                            <a href="{{ route('bugs.show', $bug) }}" class="hover:text-primary hover:underline font-semibold block truncate">{{ $bug->title }}</a>
                                            @if ($bug->project)
                                                <span class="inline-flex items-center gap-1 text-[11px] text-blue-600 font-medium mt-0.5">
                                                    <span class="material-symbols-outlined text-[12px]">folder</span>
                                                    {{ $bug->project }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            @if ($bug->priority == 'p1')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-bold bg-error-container text-error tracking-wide">P1</span>
                                            @elseif ($bug->priority == 'p2')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-bold bg-tertiary-container/20 text-tertiary-container">P2</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-bold bg-surface-container-highest text-on-background tracking-wide">P3</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            @if ($bug->status == 'open')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-medium bg-surface-container text-secondary">Open</span>
                                            @elseif ($bug->status == 'in_progress')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-medium bg-tertiary-container/20 text-tertiary-container">In Progress</span>
                                            @elseif ($bug->status == 'fixed' || $bug->status == 'resolved')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-medium bg-primary-container/20 text-primary-container">Fixed</span>
                                            @elseif ($bug->status == 'retest')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-medium bg-inverse-surface text-inverse-on-surface">Retest</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-medium bg-secondary-fixed text-on-secondary-fixed">Closed</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-secondary">{{ $bug->developer ?? 'Unassigned' }}</td>
                                        <td class="p-4 text-secondary text-sm">{{ $bug->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center text-secondary">No recent activity.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
