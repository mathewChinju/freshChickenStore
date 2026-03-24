<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Kitchen & Meat Store')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Admin Panel Styles -->
    <link href="{{ asset('css/admin-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
    
    <!-- Quick Sidebar State Check to prevent flicker -->
    <script>
        (function() {
            const sidebarState = localStorage.getItem('sidebarCollapsed');
            if (sidebarState === 'true' || (window.innerWidth < 768 && sidebarState !== 'false')) {
                document.documentElement.classList.add('sidebar-is-collapsed');
            }
        })();
    </script>
    

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"> </h3>
                <button class="sidebar-toggle-btn" id="sidebarCollapseBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="sidebar-menu" id="sidebarMenu">
            <div class="menu-section">
                <div class="menu-title">
                    <h3 class="m-0"> </h3>
                </div>
                <div class="menu-items">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                    {{-- <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a> --}}
                    @if(auth()->user()->hasPermissionTo('role-list'))
                        <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                            <i class="fas fa-user-shield"></i>
                            <span>Roles</span>
                        </a>
                    @endif
                    @if(auth()->user()->hasPermissionTo('permission-list'))
                        <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                            <i class="fas fa-key"></i>
                            <span>Permissions</span>
                        </a>
                    @endif
                </div>
            </div>
            
            <div class="menu-section">
                <div class="menu-title">
                    <!-- <i class="fas fa-external-link-alt me-2"></i>Quick Links -->
                </div>
                <div class="menu-items">
                    <a href="/" class="nav-link" target="_blank">
                        <i class="fas fa-store"></i>
                        <span>View Store</span>
                    </a>
                    
                    <div class="user-profile-section" id="profileSection">
                        <div class="user-profile-dropdown" onclick="toggleProfileMenu()">
                            <div class="user-avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08s5.97 1.09 6 3.08c-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                             </div>
                             <span class="sidebar-tooltip">Profile</span>
                           
                            <div class="user-info">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-role">{{ Auth::user()->is_admin ? 'Administrator' : 'Staff' }}</span>
                            </div>
                           
                            <i class="fas fa-chevron-right ms-auto small user-info chevron-icon"></i>
                        </div>
                        <div class="profile-submenu">
                            <a  href="{{ route('profile.edit') }}" class="profile-submenu-item">
                                <i class="fas fa-user-edit"></i>
                                <span>Edit Profile</span>
                            </a>
                              
                            <div style="border-top: 1px solid rgba(255,255,255,0.05); margin: 4px 8px;"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="profile-submenu-item text-danger border-0 bg-transparent w-100">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Title -->
        <div class="page-header mb-4">
            <h1 class="page-title">@yield('page-title', 'Admin Panel')</h1>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    
    <script>
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarMenu = document.getElementById('sidebarMenu');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mainContent = document.querySelector('.main-content');
            
            // Load saved state from localStorage
            const sidebarState = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarState || (window.innerWidth < 768 && localStorage.getItem('sidebarCollapsed') !== 'false')) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
                document.documentElement.classList.add('sidebar-is-collapsed');
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
                document.documentElement.classList.remove('sidebar-is-collapsed');
            }
            
            // Toggle sidebar function
            function toggleSidebar() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
                // Save state to localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
                
                // Update HTML class for flicker fix synchronization
                if (isCollapsed) {
                    document.documentElement.classList.add('sidebar-is-collapsed');
                } else {
                    document.documentElement.classList.remove('sidebar-is-collapsed');
                }
                
                console.log('Sidebar toggled. New state:', isCollapsed ? 'collapsed' : 'expanded');
            }
            
            // Toggle profile submenu
            window.toggleProfileMenu = function() {
                const profileSection = document.getElementById('profileSection');
                const profileDropdown = profileSection.querySelector('.user-profile-dropdown');
                
                profileSection.classList.toggle('active');
                profileDropdown.classList.toggle('active');
            };
            
            // Attach event listeners with better error handling
            try {
                if (sidebarCollapseBtn) {
                    sidebarCollapseBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Collapse button clicked');
                        toggleSidebar();
                    });
                }
                
                if (sidebarToggle) {
                    sidebarToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Toggle button clicked');
                        toggleSidebar();
                    });
                }
                
                // Prevent menu clicks from toggling sidebar when collapsed
                const menuLinks = document.querySelectorAll('.sidebar-menu .nav-link');
                menuLinks.forEach(function(link, index) {
                    link.addEventListener('click', function(e) {
                        const isCollapsed = sidebar.classList.contains('collapsed');
                        console.log(`Menu link ${index + 1} clicked. Sidebar collapsed:`, isCollapsed);
                        
                        // Allow normal navigation even when sidebar is collapsed
                        // Don't prevent default behavior - let the link work normally
                        if (isCollapsed) {
                            console.log('Menu link clicked - sidebar is collapsed, allowing navigation');
                            // Don't prevent default - let the link navigate normally
                        } else {
                            console.log('Menu link clicked normally - sidebar is expanded');
                        }
                    });
                });
            } catch (error) {
                console.error('Error setting up sidebar functionality:', error);
            }
            
            // Responsive auto-collapse on mobile
            function handleResize() {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else if (window.innerWidth >= 768 && !sidebar.classList.contains('collapsed')) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            }
            
            // Debounced resize handler
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(handleResize, 250);
            });
            
            // Initial resize check
            handleResize();
        });
    </script>
    @stack('scripts')
</body>
</html>
