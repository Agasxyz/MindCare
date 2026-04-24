@extends('layouts.app')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                container: false
            }
        }
    </script>
    <style>
        .navbar a {
            text-decoration: none;
        }

        .social-icon {
            display: flex;
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-6 max-w-4xl">
            <a href="{{ route('article') }}"
                class="flex items-center text-[#377d61] font-bold mb-8 hover:gap-2 transition-all no-underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Artikel
            </a>

            <article class="space-y-8 bg-white p-8 rounded-3xl shadow-sm">
                <header class="space-y-4">
                    <h1 class="text-4xl md:text-5xl font-bold text-[#2C5F4B] leading-tight">
                        {{ $article->judul_artikel }}
                    </h1>
                    <div class="flex items-center gap-4 text-gray-500 font-medium">
                        <span>By {{ $article->user->username ?? 'Admin' }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                        <span>{{ $article->created_at ? $article->created_at->format('d M Y') : 'Baru saja' }}</span>
                    </div>
                </header>

                @if($article->gambar)
                    <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul_artikel }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $article->isi_artikel }}
                </div>
            </article>
        </div>
    </div>
@endsection