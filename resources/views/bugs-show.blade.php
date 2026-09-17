<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bug Detail - QATrack</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap" rel="stylesheet"/>
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
</head>
<body class="bg-background text-on-background font-body-md antialiased min-h-screen">
    @include('layouts.sidebar')
    @include('layouts.header')

    <!-- Main Content Canvas -->
    <main class="ml-sidebar-width mt-16 p-section-padding min-h-[calc(100vh-64px)] max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-start mb-container-gap">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 text-label-md font-label-md text-secondary">
                    <a class="hover:text-primary transition-colors" href="{{ route('bugs') }}">Bugs</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span>#{{ 4000 + $bug->id }}</span>
                </div>
                <h2 class="text-display-lg font-display-lg text-on-surface">{{ $bug->title }}</h2>
                <div class="flex items-center gap-4 mt-2">
                    @if ($bug->priority == 'p1')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-md text-label-md">
                            <span class="w-2 h-2 rounded-full bg-error"></span> High Priority
                        </span>
                    @elseif ($bug->priority == 'p2')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-container text-on-tertiary-container font-label-md text-label-md border border-tertiary/20">
                            <span class="w-2 h-2 rounded-full bg-tertiary"></span> Medium Priority
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-variant text-on-surface-variant font-label-md text-label-md border border-outline-variant">
                            <span class="w-2 h-2 rounded-full bg-secondary"></span> Low Priority
                        </span>
                    @endif

                    @if ($bug->status == 'open')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md border border-outline-variant">
                            <span class="material-symbols-outlined text-[14px]">info</span> Open
                        </span>
                    @elseif ($bug->status == 'in_progress')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-highest text-primary font-label-md text-label-md border border-outline-variant">
                            <span class="material-symbols-outlined text-[14px]">progress_activity</span> In Progress
                        </span>
                    @elseif ($bug->status == 'fixed' || $bug->status == 'resolved')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-tint text-on-primary font-label-md text-label-md">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Fixed
                        </span>
                    @elseif ($bug->status == 'retest')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-inverse-surface text-inverse-on-surface font-label-md text-label-md border border-outline-variant">
                            <span class="material-symbols-outlined text-[14px]">build</span> Retest
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">
                            <span class="material-symbols-outlined text-[14px]">lock</span> Closed
                        </span>
                    @endif

                    <span class="text-secondary font-body-md text-body-md flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        Created {{ $bug->created_at->format('M d, Y') }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @php
                    $role = auth()->user()->role;
                @endphp

                <!-- Developer Actions -->
                @if ($role === 'developer')
                    @if ($bug->status === 'open')
                        <form action="{{ route('bugs.status.update', $bug) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="in_progress">
                            <button type="submit" class="px-4 py-2 text-white rounded-lg hover:opacity-90" style="background-color:#1e3a8a; transition-all font-label-md text-label-md flex items-center gap-2 shadow-sm active:scale-95 duration-100 cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">play_arrow</span> Start Progress
                            </button>
                        </form>
                    @elseif ($bug->status === 'in_progress')
                        <form action="{{ route('bugs.status.update', $bug) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="fixed">
                            <button type="submit" class="px-4 py-2 text-white rounded-lg hover:opacity-90" style="background-color:#1e3a8a; transition-all font-label-md text-label-md flex items-center gap-2 shadow-sm active:scale-95 duration-100 cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span> Mark as Fixed
                            </button>
                        </form>
                    @endif
                @endif

                <!-- Support Dev / QA & Super Admin Actions -->
                @if ($role === 'super_admin' || $role === 'support_dev')
                    <form action="{{ route('bugs.status.update', $bug) }}" method="POST" class="flex items-center gap-2 bg-surface-container-lowest p-2 border border-outline-variant rounded-xl shadow-sm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="flex items-center gap-1.5 px-2">
                            <label for="status-select" class="text-label-md font-label-md text-secondary uppercase whitespace-nowrap">Status:</label>
                            <select id="status-select" name="status" class="bg-transparent border-0 font-body-md text-body-md text-on-surface focus:ring-0 focus:outline-none p-1 cursor-pointer">
                                <option value="open" {{ $bug->status === 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $bug->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="fixed" {{ $bug->status === 'fixed' || $bug->status === 'resolved' ? 'selected' : '' }}>Fixed</option>
                                <option value="retest" {{ $bug->status === 'retest' ? 'selected' : '' }}>Retest</option>
                                <option value="closed" {{ $bug->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        
                        <div class="h-6 w-[1px] bg-outline-variant/60"></div>
                        
                        <div class="flex items-center gap-1.5 px-2">
                            <label for="developer-select" class="text-label-md font-label-md text-secondary uppercase whitespace-nowrap">Assignee:</label>
                            <select id="developer-select" name="developer" class="bg-transparent border-0 font-body-md text-body-md text-on-surface focus:ring-0 focus:outline-none p-1 cursor-pointer">
                                <option value="" {{ empty($bug->developer) ? 'selected' : '' }}>Unassigned</option>
                                <option value="anakin" {{ $bug->developer === 'anakin' ? 'selected' : '' }}>anakin (Developer)</option>
                                <option value="obiwan" {{ $bug->developer === 'obiwan' ? 'selected' : '' }}>obiwan (Support Dev)</option>
                                <option value="masteryoda" {{ $bug->developer === 'masteryoda' ? 'selected' : '' }}>masteryoda (Super Admin)</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="px-3.5 py-1.5 text-white rounded-lg hover:opacity-90" style="background-color:#1e3a8a; transition-all font-label-md text-label-md flex items-center gap-1 cursor-pointer active:scale-[0.98]">
                            <span class="material-symbols-outlined text-[16px]">save</span> Apply
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-container-gap">
            <!-- Left Column: Details & Attachments -->
            <div class="lg:col-span-2 flex flex-col gap-container-gap">
                <!-- Description Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-6">
                    <h3 class="text-headline-sm font-headline-sm text-on-surface mb-4">Description</h3>
                    <div class="text-body-lg font-body-lg text-on-surface-variant space-y-4">
                        <p>{{ $bug->description }}</p>
                        
                        @if ($bug->id == 1)
                            <p><strong>Steps to Reproduce:</strong></p>
                            <ol class="list-decimal list-inside space-y-1 ml-2">
                                <li>Add item to cart.</li>
                                <li>Proceed to checkout and enter shipping details.</li>
                                <li>Select 'Credit Card' and enter valid test credentials.</li>
                                <li>Click 'Submit Payment'.</li>
                                <li>Observe the loading spinner hangs for &gt;30 seconds before failing.</li>
                            </ol>
                            <div class="bg-surface-bright border border-outline-variant rounded-lg p-4 mt-4">
                                <h4 class="text-label-md font-label-md text-secondary mb-2 uppercase tracking-wider">Error Log Extract</h4>
                                <pre class="text-mono-code font-mono-code text-on-surface-variant overflow-x-auto"><code>[Error] 2023-10-24 14:32:01 - GatewayTimeoutException: Connection to payment provider timed out after 30000ms.
  at PaymentService.processCharge (PaymentService.ts:145)
  at CheckoutController.submit (CheckoutController.ts:89)</code></pre>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Attachments Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-headline-sm font-headline-sm text-on-surface">Attachments</h3>
                        <button class="text-primary hover:text-primary-fixed-variant text-label-md font-label-md flex items-center gap-1 cursor-pointer">
                            <span class="material-symbols-outlined text-[16px]">add</span> Add File
                        </button>
                    </div>
                    @if ($bug->id == 1)
                        <div class="border border-outline-variant rounded-lg overflow-hidden bg-surface-bright group relative">
                            <div class="aspect-video w-full bg-surface-container-low flex items-center justify-center relative">
                                <img alt="Error Screenshot" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmmiUvOGEPDRDxasTA18lgOHL08IvJRspIc9oMwfs7_gCn2cR06Wc-j0PFiw7UdDxMnnaG02QJHCcE406IaKOuo7RS9-FO5F4sO5XmfeXAfjKcc3FljMYjSQiPjGgTaPtPPF-IR5HHaAnbVzTb2a8qXXE709qxEXU2_DRFCYtr5k-mtG4iUw36zWZat9h_M4GxNdQgSO5GUjv9Nok5wIj2lS37dVcLkzfvIHFTWnpURqcHp3xMS5dR"/>
                                <div class="absolute inset-0 bg-inverse-surface/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <button class="bg-surface-container-lowest text-on-surface px-4 py-2 rounded-lg font-label-md flex items-center gap-2 shadow-sm cursor-pointer">
                                        <span class="material-symbols-outlined text-[18px]">zoom_in</span> View Full
                                    </button>
                                </div>
                            </div>
                            <div class="p-3 border-t border-outline-variant flex items-center justify-between bg-surface-container-lowest">
                                <div class="flex items-center gap-2 text-body-md font-body-md text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[18px]">image</span>
                                    checkout-error-state.png
                                </div>
                                <span class="text-label-md font-label-md text-secondary">2.4 MB</span>
                            </div>
                        </div>
                    @else
                        <div class="border border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center bg-surface hover:bg-surface-container-low transition-colors cursor-pointer group">
                            <span class="material-symbols-outlined text-outline-variant text-[32px] mb-2">upload_file</span>
                            <p class="font-label-md text-label-md text-secondary text-center">No files attached to this bug.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Meta & Timeline -->
            <div class="flex flex-col gap-container-gap">
                <!-- Meta Info Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-6">
                    <h3 class="text-headline-sm font-headline-sm text-on-surface mb-4">Details</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Assignee</span>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full text-white flex items-center justify-center text-[10px] font-bold" style="background-color:#1e3a8a;">
                                    {{ strtoupper(substr($bug->developer ?? 'UA', 0, 2)) }}
                                </div>
                                <span class="text-body-md font-body-md text-on-surface font-medium">{{ $bug->developer ?? 'Unassigned' }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Reporter</span>
                            <span class="text-body-md font-body-md text-on-surface">{{ $bug->reporter->name ?? 'System Monitor' }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant/50">
                            <span class="text-label-md font-label-md text-secondary">Environment</span>
                            <span class="px-2 py-0.5 rounded bg-surface-container-high text-on-surface-variant text-label-md font-label-md">Production</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-label-md font-label-md text-secondary">Component</span>
                            <span class="text-body-md font-body-md text-on-surface">Payment Services</span>
                        </div>
                    </div>
                </div>

                <!-- History Timeline -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-6">
                    <h3 class="text-headline-sm font-headline-sm text-on-surface mb-6">Activity Timeline</h3>
                    <div class="relative pl-4 space-y-6 before:absolute before:inset-y-0 before:left-[11px] before:w-0.5 before:bg-outline-variant/50">
                        @if ($bug->status !== 'open')
                            <!-- Timeline Item: Status Change -->
                            <div class="relative">
                                <div class="absolute -left-[27px] bg-surface-container-lowest rounded-full p-1 border-2 border-primary">
                                    <span class="material-symbols-outlined text-[14px] text-primary" style="font-variation-settings: 'FILL' 1;">sync</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <p class="text-body-md font-body-md text-on-surface">
                                        <span class="font-medium">{{ $bug->developer ?? 'System' }}</span> changed status to <span class="text-primary font-medium">{{ ucfirst(str_replace('_', ' ', $bug->status)) }}</span>
                                    </p>
                                    <span class="text-label-md font-label-md text-secondary">2 hours ago</span>
                                </div>
                            </div>
                        @endif

                        @if ($bug->developer && $bug->developer !== 'Unassigned')
                            <!-- Timeline Item: Assignment -->
                            <div class="relative">
                                <div class="absolute -left-[27px] bg-surface-container-lowest rounded-full p-1 border-2 border-outline-variant">
                                    <span class="material-symbols-outlined text-[14px] text-secondary">person_add</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <p class="text-body-md font-body-md text-on-surface">
                                        <span class="font-medium">Admin User</span> assigned to <span class="font-medium">{{ $bug->developer }}</span>
                                    </p>
                                    <span class="text-label-md font-label-md text-secondary">4 hours ago</span>
                                </div>
                            </div>
                        @endif

                        <!-- Timeline Item: Created -->
                        <div class="relative">
                            <div class="absolute -left-[27px] bg-surface-container-lowest rounded-full p-1 border-2 border-outline-variant">
                                <span class="material-symbols-outlined text-[14px] text-secondary">bug_report</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-body-md font-body-md text-on-surface">
                                    <span class="font-medium">{{ $bug->id <= 5 ? 'System Monitor' : 'masteryoda' }}</span> created issue
                                </p>
                                <span class="text-label-md font-label-md text-secondary">{{ $bug->created_at->format('M d, Y - H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Comment input -->
                    <div class="mt-6 pt-4 border-t border-outline-variant">
                        <div class="relative flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-outline-variant bg-surface-container flex items-center justify-center">
                                <span class="material-symbols-outlined text-secondary text-[20px]">person</span>
                            </div>
                            <input class="w-full bg-surface-bright border border-outline-variant rounded-full py-2 px-4 text-body-md font-body-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Add a comment..." type="text"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
