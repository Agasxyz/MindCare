<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare - Prioritize Your Mental Health</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body>
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="{{ Auth::check() ? route('user.dashboard') : route('home') }}" class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="MindCare Logo"
                    style="height: 60px; width: auto; object-fit: contain;">
                <span style="font-size: 1.5rem; font-weight: bold; margin-left: -10px;">MINDCARE</span>
            </a>
            <div class="nav-links">
                <a href="{{ Auth::check() ? route('user.dashboard') : route('home') }}"
                    class="{{ request()->routeIs('home') || request()->routeIs('user.dashboard') ? 'active' : '' }}">{{ Auth::check() ? 'Dashboard' : 'Beranda' }}</a>
                @auth
                    <div class="dropdown">
                        <button class="dropbtn">
                            Fitur
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="dropdown-content">
                            <a href="{{ route('user.selftest') }}">Self Test</a>
                            <a href="{{ route('user.community') }}">Community</a>
                            <a href="{{ route('user.meditation') }}">Meditation</a>
                            <a href="{{ route('user.goals') }}">Goals</a>
                        </div>
                    </div>
                @endauth
                @guest
                    <a href="{{ route('article') }}" class="{{ request()->routeIs('article') ? 'active' : '' }}">Article</a>
                @endguest
            </div>
            @auth
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->username ?? 'U', 0, 1) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->username ?? 'User' }}</span>
                        <a href="{{ route('logout') }}" class="user-logout">Logout</a>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-primary">Get Started</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <a href="{{ Auth::check() ? route('user.dashboard') : route('home') }}" class="footer-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="MindCare Logo"
                            style="height: 50px; width: auto; object-fit: contain; filter: brightness(0) invert(1);">
                        <span style="font-size: 1.25rem; font-weight: bold; margin-left: -5px;">MINDCARE</span>
                    </a>
                    <p>Teman setia buat kesehatan mentalmu. MindCare siap bantu kamu lebih mindful dan tenang.</p>
                </div>
                <div class="footer-links">
                    <h4>Menu</h4>
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('article') }}">Article</a>
                </div>
                <div class="footer-links">
                    <h4>Support</h4>
                    <a href="#">FAQ</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                </div>
                <div class="footer-social">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon">IG</a>
                        <a href="#" class="social-icon">TW</a>
                        <a href="#" class="social-icon">FB</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MindCare. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>