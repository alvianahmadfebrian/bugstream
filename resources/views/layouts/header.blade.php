<header class="h-16 fixed top-0 right-0 z-10 bg-surface border-b border-outline-variant flex justify-between items-center w-[calc(100%-260px)] px-grid-margin">
    <!-- Left Side: Search or Breadcrumb -->
    <div class="flex-1 flex items-center">
        <button id="sidebar-toggle-btn" class="text-on-surface-variant hover:text-primary transition-all p-1.5 rounded-lg hover:bg-surface-container-low mr-3 flex items-center justify-center cursor-pointer active:scale-95 duration-100" title="Toggle Sidebar">
            <span class="material-symbols-outlined text-[22px]">menu</span>
        </button>
        @if (isset($breadcrumb))
            <div class="flex items-center gap-2 text-on-surface-variant font-body-md">
                <span class="font-bold text-on-surface">{{ $breadcrumb }}</span>
            </div>
        @else
            <div class="relative w-96 focus-within:ring-2 focus-within:ring-primary rounded-md transition-all">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input class="w-full bg-surface-container-low border border-outline-variant rounded-md py-2 pl-10 pr-4 text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:border-primary" placeholder="Search across Bug Stream Console..." type="text"/>
            </div>
        @endif
    </div>
    <!-- Right Side: Trailing Actions -->
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4">
            <button class="text-on-surface-variant hover:text-primary transition-all relative">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-0 right-0 w-2 h-2 bg-error rounded-full"></span>
            </button>
            <button class="text-on-surface-variant hover:text-primary transition-all">
                <span class="material-symbols-outlined">help_outline</span>
            </button>
        </div>
        <div class="w-px h-6 bg-outline-variant"></div>
        <span class="text-on-surface font-semibold text-xs hidden sm:inline-block mr-2">{{ auth()->user()->name }}</span>
        <button class="flex items-center gap-2 hover:opacity-80 transition-opacity" title="{{ auth()->user()->name }}">
            <img alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_ZdyN8nOgyk3nZ0D-4sHzGFv-UJnC8uMmw-ycEHHEoM4oBXA1Ej4N4hx6hJKXrE6-5idg0BkpnTHrQ9IhQVyOxP4fWuITLi1QZCZX9kC5A2YB8eiAP4y76VTqGOO9Oi-92CqaCQEidqahExgSWo0HIllpKfLII64dHGVCPM7Sd_VuibjOm5QGW8gJSAaTtMPngycBP_EwzmxyJhMIrTvyWx4MiWfsY_9mlzQ8vNU3xqIU7DXOG7o8"/>
        </button>
    </div>
</header>
