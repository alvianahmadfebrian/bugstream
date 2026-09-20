<aside id="main-sidebar" class="w-sidebar-width h-screen fixed left-0 top-0 bg-white shadow-sm z-20 flex flex-col py-section-padding px-element-gap border-r border-outline-variant">
    <!-- Brand Header -->
    <div class="mb-10 px-2 flex flex-col items-center">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-full" title="QATrack">
            <img src="{{ asset('images/logo.png') }}" alt="QATrack" class="h-14 max-h-14 w-auto object-contain">
        </a>
    </div>
    <!-- CTA -->
    @if(auth()->user()->role !== 'developer')
        <div class="mb-6 px-2 sidebar-cta-container">
            <a href="{{ route('bugs.create') }}" class="w-full font-label-md text-label-md py-3 px-4 rounded-lg flex items-center justify-center gap-2 active:scale-95 duration-150 transition-all shadow-sm cursor-pointer shrink-0" style="background-color:#1e3a8a;color:#ffffff;" onmouseover="this.style.backgroundColor='#1e40af'" onmouseout="this.style.backgroundColor='#1e3a8a'" title="Report Bug">
                <span class="material-symbols-outlined text-[18px] shrink-0">add</span>
                <span class="sidebar-text">Report Bug</span>
            </a>
        </div>
    @endif
    <!-- Navigation Tabs -->
    <nav class="flex flex-col gap-1 flex-1">
        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'support_dev')
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('dashboard') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('dashboard') }}" title="Dashboard">
                <span class="material-symbols-outlined shrink-0">dashboard</span>
                <span class="sidebar-text">Dashboard</span>
            </a>
        @endif
        @if(auth()->user()->role === 'super_admin')
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('users*') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('users.index') }}" title="User Management">
                <span class="material-symbols-outlined shrink-0">group</span>
                <span class="sidebar-text">User Management</span>
            </a>
        @endif
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('projects*') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('projects.index') }}" title="Projects">
            <span class="material-symbols-outlined shrink-0" style="font-variation-settings: 'FILL' {{ request()->routeIs('projects*') ? 1 : 0 }};">folder</span>
            <span class="sidebar-text">Projects</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('bugs*') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('bugs') }}" title="Bugs">
            <span class="material-symbols-outlined shrink-0" style="font-variation-settings: 'FILL' {{ request()->routeIs('bugs*') ? 1 : 0 }};">bug_report</span>
            <span class="sidebar-text">Bugs</span>
        </a>
        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'support_dev')
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors active:scale-95 duration-150 font-body-md text-body-md {{ request()->routeIs('reports') ? 'font-bold bg-blue-50' : 'hover:bg-blue-50' }}" style="color:#1e3a8a;" href="{{ route('reports') }}" title="Reports">
                <span class="material-symbols-outlined shrink-0">assessment</span>
                <span class="sidebar-text">Reports</span>
            </a>
        @endif
    </nav>
</aside>

<style>
    /* Smooth Transitions for sidebar elements */
    #main-sidebar, .ml-sidebar-width, header {
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1), 
                    margin-left 0.25s cubic-bezier(0.4, 0, 0.2, 1), 
                    left 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Collapsed Sidebar overrides */
    .sidebar-collapsed #main-sidebar {
        width: 72px !important;
    }
    
    /* Hide text labels in collapsed state */
    .sidebar-collapsed .sidebar-text,
    .sidebar-collapsed .sidebar-brand-text {
        opacity: 0;
        display: none !important;
    }
    
    /* Center navigation icons when collapsed */
    .sidebar-collapsed #main-sidebar nav a,
    .sidebar-collapsed #main-sidebar .mt-auto a {
        justify-content: center !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    /* Center brand logo when collapsed */
    .sidebar-collapsed #main-sidebar .mb-10 {
        justify-content: center !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .sidebar-collapsed #main-sidebar img {
        max-width: 40px !important;
        height: auto !important;
    }
    
    /* Collapse Report Bug CTA button to FAB with plus icon */
    .sidebar-collapsed #main-sidebar .sidebar-cta-container {
        padding-left: 0 !important;
        padding-right: 0 !important;
        display: flex;
        justify-content: center;
    }
    
    .sidebar-collapsed #main-sidebar .sidebar-cta-container a {
        width: 40px !important;
        height: 40px !important;
        padding: 0 !important;
        border-radius: 9999px !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Collapsed main content margin & header position */
    .sidebar-collapsed .ml-sidebar-width {
        margin-left: 72px !important;
    }
    
    .sidebar-collapsed header {
        width: calc(100% - 72px) !important;
        left: 72px !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        
        // Immediately load state to prevent layout shift
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', document.body.classList.contains('sidebar-collapsed'));
            });
        }
    });
</script>
