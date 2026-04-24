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
    /* Prevent Tailwind from resetting global styles especially for the Navbar */
    .navbar a { text-decoration: none; }
    
    /* Ensure footer social icons display correctly if there are conflicts */
    .social-icon { display: flex; }
</style>
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12 space-y-3">
            <h1 class="text-4xl md:text-5xl font-bold text-[#2C5F4B]">Article</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Eksplorasi kumpulan artikel menarik seputar kesehatan mental, meditasi, 
                dan tips praktis untuk menjaga keseimbangan emosimu setiap hari.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @forelse($articles as $article)
            <div class="bg-[#B6D7B9] rounded-xl p-8 flex flex-col items-center text-center h-full shadow-sm hover:shadow-md transition-shadow">
                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul_artikel }}" class="w-full h-48 object-cover rounded-md mb-4 bg-gray-200">
                <h3 class="text-[#1A4D39] font-bold text-xl mb-1">{{ $article->judul_artikel }}</h3>
                <span class="text-[#2E7D5E] text-xs font-semibold mb-6">By {{ $article->user->username ?? 'Admin' }}</span>
                
                <p class="text-[#1A4D39] font-bold text-[15px] leading-snug mb-4 line-clamp-2">
                    {{ Str::limit($article->isi_artikel, 60) }}
                </p>
                
                <a href="{{ route('article.show', $article->id_artikel) }}" class="mt-auto text-[#377d61] font-bold text-sm hover:underline">Read More</a>
            </div>
            @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                <p>No articles found.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection