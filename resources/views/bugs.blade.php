<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>QATrack - Bugs List</title>
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
                        <h2 class="text-display-lg font-display-lg" style="color:#1e3a8a">Bugs</h2>
                        <p class="text-body-md font-body-md text-on-surface-variant mt-1">Manage, track, and resolve system issues.</p>
                    </div>
                    @if(auth()->user()->role !== 'developer')
                        <a href="{{ route('bugs.create') }}" class="text-white font-label-md text-label-md py-2.5 px-5 rounded-lg flex items-center gap-2 active:scale-95 duration-150 shadow-[0_2px_4px_rgba(0,0,0,0.04)] cursor-pointer hover:opacity-90 transition-opacity" style="background-color:#1e3a8a;">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Add New Bug
                        </a>
                    @endif
                </div>

                <!-- Alert Notifications -->
                @if (session('success'))
                    <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg font-body-md text-body-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif
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

                <!-- Filters & Controls Bar -->
                <form method="GET" action="{{ route('bugs') }}" class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 border-r border-outline-variant pr-4">
                        <span class="material-symbols-outlined text-outline">filter_list</span>
                        <span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Filters</span>
                    </div>
                    <select name="status" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="fixed" {{ request('status') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="retest" {{ request('status') == 'retest' ? 'selected' : '' }}>Retest</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <select name="priority" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                        <option value="">All Priorities</option>
                        <option value="p1" {{ request('priority') == 'p1' ? 'selected' : '' }}>P1 - Critical</option>
                        <option value="p2" {{ request('priority') == 'p2' ? 'selected' : '' }}>P2 - High</option>
                        <option value="p3" {{ request('priority') == 'p3' ? 'selected' : '' }}>P3 - Medium</option>
                    </select>
                    @if (auth()->user()->role !== 'developer')
                        <select name="developer" onchange="this.form.submit()" class="bg-surface border border-outline-variant rounded-md py-1.5 pl-3.5 pr-9 text-body-md font-body-md text-on-surface focus:ring-2 focus:ring-primary focus:outline-none min-w-[140px]">
                            <option value="">All Developers</option>
                            @foreach ($developers as $dev)
                                <option value="{{ $dev->name }}" {{ request('developer') == $dev->name ? 'selected' : '' }}>{{ $dev->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if (request()->hasAny(['status', 'priority', 'developer']))
                        <a href="{{ route('bugs') }}" class="text-xs text-primary hover:underline ml-auto font-medium">Reset Filters</a>
                    @endif
                </form>
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
                                        <td class="py-4 px-4">
                                            <div class="font-body-md text-body-md text-on-surface font-medium">{{ $bug->title }}</div>
                                            @if ($bug->project)
                                                <div class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-[11px] font-medium border border-blue-100">
                                                    <span class="material-symbols-outlined text-[13px]">folder</span>
                                                    <span>{{ $bug->project }}</span>
                                                </div>
                                            @endif
                                        </td>
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
                                        <td class="py-4 px-4 text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('bugs.show', $bug) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-primary hover:bg-blue-50 border border-outline-variant/60 transition-colors text-xs font-semibold cursor-pointer" title="Lihat Detail">
                                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                                    <span>Detail</span>
                                                </a>
                                                @if(auth()->user()->role === 'super_admin' || auth()->user()->id === $bug->reporter_id)
                                                    <form action="{{ route('bugs.destroy', $bug) }}" method="POST" class="inline" onsubmit="return confirmModal(event, 'Apakah Anda yakin ingin menghapus bug ini? Tindakan ini tidak dapat dibatalkan.', 'Hapus Bug', 'danger', 'Ya, Hapus');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-1.5 text-secondary hover:text-error hover:bg-error-container/20 rounded-lg transition-colors cursor-pointer" title="Hapus Bug">
                                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                                        </button>
                                                    </form>
                                                @endif
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
