<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>BugStream - Bugs List</title>
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
        /* Base styles to ensure clean layout */
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
            <div class="max-w-7xl mx-auto space-y-container-gap">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-display-lg font-display-lg text-on-surface">Bugs</h2>
                        <p class="text-body-md font-body-md text-on-surface-variant mt-1">Manage, track, and resolve system issues.</p>
                    </div>
                    <a href="{{ route('bugs.create') }}" class="bg-primary text-on-primary font-label-md text-label-md py-2.5 px-5 rounded-lg flex items-center gap-2 hover:bg-surface-tint active:scale-95 duration-150 shadow-[0_2px_4px_rgba(0,0,0,0.04)] cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Add New Bug
                    </a>
                </div>
                <!-- Filters & Controls Bar -->
                <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 border-r border-outline-variant pr-4">
                        <span class="material-symbols-outlined text-outline">filter_list</span>
                        <span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Filters</span>
                    </div>
                    <select class="bg-surface border border-outline-variant rounded-md py-1.5 px-3 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Statuses</option>
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="fixed">Fixed</option>
                    </select>
                    <select class="bg-surface border border-outline-variant rounded-md py-1.5 px-3 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Priorities</option>
                        <option value="p1">P1 - Critical</option>
                        <option value="p2">P2 - High</option>
                        <option value="p3">P3 - Medium</option>
                    </select>
                    <select class="bg-surface border border-outline-variant rounded-md py-1.5 px-3 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Developers</option>
                        <option value="dev1">Sarah Jenkins</option>
                        <option value="dev2">Marcus Reed</option>
                    </select>
                </div>
                <!-- Data Table Container -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-outline-variant">
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Bug ID</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Title</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Priority</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Status</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Developer</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium">Created Date</th>
                                    <th class="py-3 px-4 font-label-md text-label-md text-secondary uppercase tracking-wider font-medium text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse ($bugs as $bug)
                                    <tr class="hover:bg-surface-container-high transition-colors group">
                                        <td class="py-4 px-4 font-mono-code text-mono-code text-on-surface-variant">BUG-{{ 4000 + $bug->id }}</td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface font-medium">{{ $bug->title }}</td>
                                        <td class="py-4 px-4">
                                            @if ($bug->priority == 'p1')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-error-container text-on-error-container font-label-md text-label-md border border-error/20">
                                                    <span class="w-2 h-2 rounded-full bg-error"></span> P1
                                                </span>
                                            @elseif ($bug->priority == 'p2')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-tertiary-container text-on-tertiary-container font-label-md text-label-md border border-tertiary/20">
                                                    <span class="w-2 h-2 rounded-full bg-tertiary"></span> P2
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface-variant text-on-surface-variant font-label-md text-label-md border border-outline-variant">
                                                    <span class="w-2 h-2 rounded-full bg-secondary"></span> P3
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            @if ($bug->status == 'open')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md">Open</span>
                                            @elseif ($bug->status == 'in_progress')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-md text-label-md">In Progress</span>
                                            @elseif ($bug->status == 'fixed' || $bug->status == 'resolved')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-surface-tint text-on-primary font-label-md text-label-md">Fixed</span>
                                            @elseif ($bug->status == 'retest')
                                                <span class="inline-flex px-3 py-1 rounded-full bg-inverse-surface text-inverse-on-surface font-label-md text-label-md">Retest</span>
                                            @else
                                                <span class="inline-flex px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">Closed</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface-variant flex items-center gap-2">
                                            @if ($bug->developer && $bug->developer !== 'Unassigned')
                                                <div class="w-6 h-6 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-[10px] font-bold">
                                                    {{ strtoupper(substr($bug->developer, 0, 2)) }}
                                                </div>
                                                {{ $bug->developer }}
                                            @else
                                                <img alt="Developer Avatar" class="w-6 h-6 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCAkGgOFvM_POS7k9PufLA2VsGOSEOviuXRdDzdh3gXxSN2TAuit4NTZEX21Oh_QniQR7D1oVeyfZ2008UhtvAou92PPHk116bMVQgZfH5Q69eJVysjHqj2FcnzlrO86iglufmXVKdFZHZhuYMPjeiVIu65HfoZNBgSe7VLvfdgjDhDHMK0uixq-m7dFxiVPhUz795iowGJlvLpyiAADq5ycV8if-jIagn6tBwN8Lk3JbYvEtsZyZCF"/>
                                                Unassigned
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 font-body-md text-body-md text-on-surface-variant">{{ $bug->created_at->format('M d, Y') }}</td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('bugs.show', $bug) }}" class="p-1.5 text-secondary hover:text-primary rounded hover:bg-surface transition-colors cursor-pointer flex items-center justify-center" title="View">
                                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                </a>
                                                <button class="p-1.5 text-secondary hover:text-primary rounded hover:bg-surface transition-colors cursor-pointer" title="Edit">
                                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-on-surface-variant font-medium">No bugs found matching current filters.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Footer / Pagination Placeholder -->
                    <div class="bg-surface-container-low border-t border-outline-variant p-4 flex items-center justify-between">
                        <p class="text-body-md font-body-md text-on-surface-variant">Showing 1 to {{ $bugs->count() }} of {{ $bugs->count() }} entries</p>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 rounded border border-outline-variant text-secondary hover:bg-surface-container-highest transition-colors disabled:opacity-50 cursor-pointer" disabled="">Previous</button>
                            <button class="px-3 py-1 rounded border border-outline-variant text-secondary hover:bg-surface-container-highest transition-colors cursor-pointer">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
