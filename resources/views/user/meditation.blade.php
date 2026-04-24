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
    </style>
@endpush

@section('content')
    <div class="flex-grow w-full max-w-[1400px] mx-auto px-6 py-10">

        <div class="text-center mb-16 space-y-3">
            <h1 class="text-4xl md:text-5xl font-bold text-[#2C5F4B]">Meditation</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Temukan ketenangan diri dengan sesi meditasi yang kami kurasi khusus untukmu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 md:px-0">
            @forelse($meditations as $meditation)
                <!-- Card -->
                <a href="{{ route('user.meditation.play', $meditation->id_meditasi) }}" class="block group relative">
                    <div
                        class="bg-gradient-to-b from-[#5DB893] to-[#2F785C] rounded-[24px] p-8 text-center text-white shadow-xl group-hover:-translate-y-2 transition-transform duration-300 flex flex-col items-center relative overflow-hidden h-full">
                        <h3 class="text-xl font-bold tracking-wide">{{ $meditation->judul_meditasi }}</h3>
                        <p class="text-xs font-medium opacity-90 mt-1 mb-2">Category: {{ $meditation->kategori }}</p>

                        <div
                            class="h-40 w-full flex items-center justify-center mb-6 relative z-10 group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/20 rounded-full w-20 h-20 mx-auto my-auto backdrop-blur-sm">
                                <svg class="w-10 h-10 text-white fill-current" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                            <!-- Assuming images are stored in public storage -->
                            <img src="{{ asset('storage/' . $meditation->gambar) }}"
                                onerror="this.src='https://via.placeholder.com/150'" alt="{{ $meditation->judul_meditasi }}"
                                class="w-32 h-32 rounded-full object-cover shadow-lg border-4 border-white/20">
                        </div>

                        <p class="text-sm font-medium leading-relaxed opacity-95">
                            {{ $meditation->deskripsi }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    <p>No meditation sessions available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection