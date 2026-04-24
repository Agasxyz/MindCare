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
    <div class="max-w-[1200px] mx-auto px-6 pt-12 pb-24 relative overflow-hidden">
        <!-- Background Accents -->
        <div
            class="absolute top-0 right-0 -z-10 w-[600px] h-[600px] bg-[#377d61]/5 rounded-full blur-[120px] -mr-40 -mt-40">
        </div>
        <div
            class="absolute bottom-0 left-0 -z-10 w-[400px] h-[400px] bg-[#ECF2F3]/50 rounded-full blur-[80px] -ml-20 -mb-20">
        </div>

        <div class="space-y-12">
            <!-- Header Section -->
            <div class="max-w-4xl space-y-6">
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight tracking-tight text-gray-900">
                    Welcome back,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#377d61] to-[#2c5f4b]">
                        {{ Auth::user()->username }}!
                    </span>
                </h1>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="grid lg:grid-cols-3 gap-8 items-stretch">
                <!-- Left: Progress Card -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <div
                        class="bg-white rounded-[32px] p-8 shadow-sm border border-gray-100 hover:shadow-md transition-all flex-1">
                        <div class="flex items-center justify-between mb-10">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Progres Kamu</h3>
                                <p class="text-sm text-gray-400 mt-1">Pantau perkembangan kesehatan mentalmu</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-[#ECF2F3] flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#377d61]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 divide-x divide-gray-100">
                            <div class="pr-8">
                                <p class="text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Target Aktif</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-5xl font-black text-gray-900 leading-none">{{ $activeGoals ?? 0 }}</p>
                                    <span class="text-sm text-[#377d61] font-bold">Terdaftar</span>
                                </div>
                            </div>
                            <div class="pl-8">
                                <p class="text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Mood Terakhir</p>
                                <div class="flex flex-col">
                                    <p class="text-2xl font-bold text-[#377d61] leading-tight">
                                        {{ $latestMood->mood_label ?? 'Belum Ada' }}
                                    </p>
                                    @if($latestMood)
                                        <p class="text-[10px] text-gray-400 mt-1 uppercase">
                                            {{ $latestMood->created_at->diffForHumans() }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-4">
                        <a href="{{ route('user.selftest') }}"
                            class="block w-full bg-[#377d61] text-white px-8 py-6 rounded-[24px] font-bold text-xl text-center hover:bg-[#2c5f4b] transition-all active:scale-[0.98] shadow-sm">
                            Mulai Cek Kesehatan
                        </a>
                    </div>
                </div>

                <!-- Right: Mood Picker Card -->
                <div class="flex flex-col gap-6">
                    <div
                        class="bg-white rounded-[32px] p-8 shadow-sm border border-gray-100 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Bagaimana perasaanmu?</h3>
                            <p class="text-sm text-gray-400 mb-8">Catat suasana hatimu hari ini</p>

                            @if(session('success'))
                                <div
                                    class="mb-6 bg-green-50 text-[#377d61] p-4 rounded-2xl text-xs font-bold flex items-center gap-3 animate-bounce">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-5 gap-3">
                                @php
                                    $moods = [
                                        ['value' => 1, 'label' => 'Sangat Buruk', 'emoji' => '😫', 'color' => 'bg-red-50'],
                                        ['value' => 2, 'label' => 'Buruk', 'emoji' => '☹️', 'color' => 'bg-orange-50'],
                                        ['value' => 3, 'label' => 'Biasa Saja', 'emoji' => '😐', 'color' => 'bg-yellow-50'],
                                        ['value' => 4, 'label' => 'Senang', 'emoji' => '🙂', 'color' => 'bg-blue-50'],
                                        ['value' => 5, 'label' => 'Sangat Senang', 'emoji' => '🤩', 'color' => 'bg-green-50'],
                                    ];
                                @endphp

                                @foreach($moods as $mood)
                                    <form action="{{ route('user.mood.store') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="mood_value" value="{{ $mood['value'] }}">
                                        <input type="hidden" name="mood_label" value="{{ $mood['label'] }}">
                                        <button type="submit"
                                            class="w-full flex flex-col items-center p-3 rounded-2xl {{ $mood['color'] }} border-2 border-transparent hover:border-[#377d61] hover:shadow-md transition-all group relative">
                                            <span
                                                class="text-3xl mb-1 group-hover:scale-125 transition-transform duration-300">{{ $mood['emoji'] }}</span>
                                            <span
                                                class="text-[7px] text-gray-400 font-black uppercase tracking-tighter opacity-70">{{ $mood['label'] }}</span>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-gray-50">
                            <div class="bg-[#ECF2F3] rounded-2xl p-5 relative overflow-hidden">
                                <div class="absolute top-0 right-0 -mr-4 -mt-4 w-12 h-12 bg-white/40 rounded-full"></div>
                                <p class="text-xs text-[#1A4D39] font-medium leading-relaxed relative z-10 italic">
                                    "Kesehatan mentalmu adalah prioritas. Jangan ragu untuk berbagi dan mencari
                                    pertolongan."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Tips Card (Horizontal/Full Width) -->
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-[#377d61]/20 to-[#ECF2F3] rounded-[32px] blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200">
                </div>
                <div class="relative bg-white rounded-[32px] p-10 border border-gray-50 overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        <div class="w-24 h-24 rounded-3xl bg-[#ECF2F3] flex items-center justify-center shrink-0">
                            <svg class="w-12 h-12 text-[#377d61]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="space-y-3 text-center md:text-left">
                            <h4 class="text-3xl font-extrabold text-gray-900">Tips Hari Ini</h4>
                            <p class="text-xl text-gray-500 leading-relaxed max-w-3xl">
                                "Sediakan waktu 5 menit hari ini hanya untuk bernapas lega dan mensyukuri hal-hal kecil di
                                sekitarmu. Kehadiranmu sangat berharga."
                            </p>
                        </div>
                        <div class="hidden md:block ml-auto">
                            <div class="w-32 h-32 rounded-full border-4 border-[#ECF2F3] flex items-center justify-center">
                                <span class="text-3xl">🌿</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection