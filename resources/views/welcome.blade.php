@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Prioritize Your<br>Mental Health</h1>
                <p>Get mental health support today.<br>Reclaim your well-being.</p>
                <a href="{{ route('login') }}" class="btn-primary large">Get Started</a>
            </div>
            <div class="hero-images">
                <!-- Using the images you provided for a personalized feel -->
                <div class="image-block block-1"
                    style="background-image: url('{{ asset('img/1-dashboard.webp') }}'); background-size: cover; background-position: center;">
                </div>
                <div class="image-grid-right">
                    <div class="image-block block-2"
                        style="background-image: url('{{ asset('img/2-dashboard.webp') }}'); background-size: cover; background-position: center;">
                    </div>
                    <div class="image-block block-3"
                        style="background-image: url('{{ asset('img/3-dashboard.webp') }}'); background-size: cover; background-position: center;">
                    </div>
                </div>
                <!-- Decorative wave at bottom left -->
                <div class="wave-decoration"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container about-content">
            <div class="star-decoration">✦</div>
            <h2>Yuk, kenalan sama MindCare!</h2>
            <p>MindCare adalah aplikasi self-care yang bikin kamu lebih mindful, tenang, dan nyaman. Dengan fitur meditasi,
                audio relaksasi, dan journaling, MindCare siap jadi teman setia buat kesehatan mentalmu.</p>
            <div class="dot-pattern"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-header">
                <h2>MindCare punya apa aja sih?</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card green">
                    <div class="icon">
                        <!-- Icon placeholder: Psychology/Hands -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a5 5 0 0 0-5 5v2a5 5 0 0 0 10 0V7a5 5 0 0 0-5-5z"></path>
                            <path d="M19 13v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6"></path>
                            <path d="M7 10h10"></path>
                        </svg>
                    </div>
                    <h3>Self Test</h3>
                    <p>Ukur tingkat stres dan kesehatan mentalmu dengan tes sederhana yang dirancang oleh para ahli untuk
                        membantu kamu memahami diri sendiri lebih baik.</p>
                </div>
                <div class="feature-card white">
                    <div class="icon">
                        <!-- Icon placeholder: Headset -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path
                                d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z">
                            </path>
                        </svg>
                    </div>
                    <h3>Article</h3>
                    <p>Temukan artikel-artikel edukatif pilihan tentang kesehatan mental, tips meditasi, dan cara mengelola
                        emosi untuk keseharian yang lebih sehat.</p>
                </div>
                <div class="feature-card white">
                    <div class="icon">
                        <!-- Icon placeholder: Chat Head -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3>Community</h3>
                    <p>Bergabunglah dengan komunitas yang suportif untuk berbagi cerita, pengalaman, dan saling memberikan
                        semangat dalam perjalanan menjaga kesehatan mental.</p>
                </div>
                <div class="feature-card green">
                    <div class="icon">
                        <!-- Icon placeholder: Person Meditating -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="5" r="3"></circle>
                            <path d="M12 22v-6"></path>
                            <path d="M20.2 20.2 16 16l-4-4-4 4-4.2 4.2"></path>
                        </svg>
                    </div>
                    <h3>Meditation</h3>
                    <p>Nikmati berbagai panduan meditasi dan audio relaksasi yang dirancang khusus untuk membantu kamu tidur
                        lebih nyenyak dan mengurangi kecemasan.</p>
                </div>
            </div>
        </div>
    </section>


@endsection