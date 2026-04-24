<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MindCare Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* Sidebar transition */
        #sidebar {
            transition: width 0.3s ease;
        }

        .sidebar-text {
            transition: opacity 0.2s ease, width 0.2s ease;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Collapsed State Styles */
        .sidebar-collapsed {
            width: 80px;
        }

        .sidebar-collapsed .sidebar-text {
            opacity: 0;
            width: 0;
            display: none;
        }

        .sidebar-collapsed .logo-text {
            display: none;
        }

        /* Center items when collapsed */
        .sidebar-collapsed .nav-item {
            justify-content: center;
        }

        .sidebar-collapsed .profile-section {
            padding: 10px;
        }

        .sidebar-collapsed .profile-card {
            background: transparent;
            padding: 0;
            justify-content: center;
        }

        .sidebar-expanded {
            width: 280px;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-[#2d6a4f] text-white flex flex-col sidebar-expanded shadow-xl z-20">
            <!-- Logo -->
            <div class="h-20 flex items-center justify-center border-b border-[#40916c]">
                <div class="flex items-center justify-center w-full">
                    <div class="h-16 flex items-center justify-center rounded-lg">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-full w-auto object-contain">
                    </div>
                </div>
            </div>

            <!-- Profile Tiny -->
            <div class="p-4 border-b border-[#40916c] profile-section">
                <div class="flex items-center gap-3 bg-[#1b4332]/50 p-2 rounded-lg profile-card">
                    <div
                        class="w-10 h-10 rounded-full bg-gray-100 flex-shrink-0 flex items-center justify-center text-[#2d6a4f] font-bold">
                        {{ substr(Auth::user()->username ?? 'A', 0, 1) }}
                    </div>
                    <div class="sidebar-text overflow-hidden">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->username ?? 'Admin' }}</p>
                        <p class="text-xs text-green-200">{{ Auth::user()->role ?? 'Administrator' }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 py-6 px-3 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-[#40916c] transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#40916c]' : '' }} group nav-item">
                    <div class="min-w-[40px] flex justify-center">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </div>
                    <span class="sidebar-text font-medium ml-2">Dashboard</span>
                </a>

                <a href="{{ route('admin.article') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-[#40916c] transition-colors {{ request()->routeIs('admin.article') ? 'bg-[#40916c]' : '' }} group nav-item">
                    <div class="min-w-[40px] flex justify-center">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <span class="sidebar-text font-medium ml-2">Article</span>
                </a>

                <a href="{{ route('admin.meditation') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-[#40916c] transition-colors {{ request()->routeIs('admin.meditation') ? 'bg-[#40916c]' : '' }} group nav-item">
                    <div class="min-w-[40px] flex justify-center">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                            </path>
                        </svg>
                    </div>
                    <span class="sidebar-text font-medium ml-2">Meditasi</span>
                </a>

                <a href="{{ route('admin.question') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-[#40916c] transition-colors {{ request()->routeIs('admin.question') ? 'bg-[#40916c]' : '' }} group nav-item">
                    <div class="min-w-[40px] flex justify-center">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="sidebar-text font-medium ml-2">Self Test</span>
                </a>

                <a href="{{ route('admin.comment') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-[#40916c] transition-colors {{ request()->routeIs('admin.comment') ? 'bg-[#40916c]' : '' }} group nav-item">
                    <div class="min-w-[40px] flex justify-center">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                            </path>
                        </svg>
                    </div>
                    <span class="sidebar-text font-medium ml-2">Community</span>
                </a>

            </nav>

            <div class="p-4 border-t border-[#40916c]">
                <a href="{{ route('logout') }}"
                    class="flex items-center p-3 rounded-lg hover:bg-red-500/20 text-red-200 transition-colors group">
                    <div class="min-w-[40px] flex justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    <span class="sidebar-text font-medium ml-2">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#f3f4f6]">
            <!-- Topbar -->
            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <div class="flex items-center gap-4">
                    <button id="toggleSidebar"
                        class="p-2 rounded-full hover:bg-gray-100 text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </button>
                    <h2 class="text-xl font-bold text-gray-800">
                        @yield('header', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-5">
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col items-end">
                            <span class="text-sm font-bold text-gray-800">{{ Auth::user()->username ?? 'Admin' }}</span>
                            <a href="{{ route('logout') }}" class="text-xs text-red-500 hover:underline">Logout</a>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-[#2d6a4f] text-white flex items-center justify-center font-bold shadow-md border-2 border-white">
                            {{ substr(Auth::user()->username ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-8 relative">
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 pointer-events-none">
                </div>
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        let isExpanded = true;

        toggleBtn.addEventListener('click', () => {
            isExpanded = !isExpanded;
            if (isExpanded) {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
            } else {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
            }
        });
    </script>
</body>

</html>