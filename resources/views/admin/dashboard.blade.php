@extends('layouts.admin')

@section('header', 'Home')

@section('content')
    <div class="space-y-8">

        <!-- User Welcome (Optional based on typical dashboards) -->
        <!-- <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-800">Welcome back, Admin!</h3>
            <p class="text-gray-500">Here's what's happening with your mental health platform today.</p>
        </div> -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Card 1: Artikel (Green) -->
            <a href="{{ route('admin.article') }}"
                class="group block relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-[#2d6a4f] h-48 p-8 relative z-10 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-5xl font-bold mb-2">{{ $artikelCount }}</h2>
                            <p class="text-xl font-medium opacity-90">Artikel Terunggah</p>
                        </div>
                        <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div
                    class="bg-[#1b4332] py-3 px-8 flex items-center justify-center text-white/90 text-sm font-medium group-hover:bg-[#153426] transition-colors">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>
            </a>

            <!-- Card 2: Meditasi (Red/Brown) -->
            <a href="{{ route('admin.meditation') }}"
                class="group block relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-[#6f2c2c] h-48 p-8 relative z-10 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-5xl font-bold mb-2">{{ $paketCount }}</h2>
                            <p class="text-xl font-medium opacity-90">Meditasi Tersedia</p>
                        </div>
                        <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div
                    class="bg-[#4a1d1d] py-3 px-8 flex items-center justify-center text-white/90 text-sm font-medium group-hover:bg-[#3d1818] transition-colors">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>
            </a>

            <!-- Card 3: Pertanyaan (Blue) -->
            <a href="{{ route('admin.question') }}"
                class="group block relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-[#2c5f7d] h-48 p-8 relative z-10 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-5xl font-bold mb-2">{{ $pertanyaanCount }}</h2>
                            <p class="text-xl font-medium opacity-90">Pertanyaan</p>
                        </div>
                        <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div
                    class="bg-[#1a3a4d] py-3 px-8 flex items-center justify-center text-white/90 text-sm font-medium group-hover:bg-[#142d3c] transition-colors">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>
            </a>

            <!-- Card 4: Komentar (Gold) -->
            <a href="{{ route('admin.comment') }}"
                class="group block relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-[#b59a3e] h-48 p-8 relative z-10 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-5xl font-bold mb-2">{{ $komentarCount }}</h2>
                            <p class="text-xl font-medium opacity-90">Komentar Terunggah</p>
                        </div>
                        <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div
                    class="bg-[#8a7229] py-3 px-8 flex items-center justify-center text-white/90 text-sm font-medium group-hover:bg-[#705c21] transition-colors">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>
            </a>

        </div>
    </div>
@endsection