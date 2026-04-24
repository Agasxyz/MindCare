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

        .completed {
            text-decoration: line-through;
            color: #9CA3AF;
        }
    </style>
@endpush

@section('content')
    <div class="flex-grow w-full max-w-[1400px] mx-auto px-6 py-10">

        <div class="text-center mb-12 space-y-3">
            <h1 class="text-4xl md:text-5xl font-bold text-[#2C5F4B]">My Goals</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Tentukan targetmu untuk kesehatan mental yang lebih baik dan pantau perkembanganmu setiap hari.
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add Goal Form -->
        <div class="bg-white rounded-[24px] shadow-lg p-8 mb-10 border border-gray-100">
            <h2 class="text-xl font-bold text-[#1a4d39] mb-6">Tambah Target Baru</h2>
            <form action="{{ route('user.goals.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                @csrf
                <div class="flex-grow">
                    <label for="judul_goals" class="block text-sm font-medium text-gray-700 mb-1">Goal Activity</label>
                    <input type="text" name="judul_goals"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-[#377d61] focus:ring-[#377d61] py-3 px-4 bg-gray-50 bg-opacity-50"
                        placeholder="e.g. Meditate for 10 mins" required>
                </div>
                <div class="hidden">
                    <!-- Hidden field for isi_goals default value if needed or integrate into form -->
                    <input type="hidden" name="isi_goals" value="Target harian">
                    <!-- Default start date today -->
                    <input type="hidden" name="tanggal_start" value="{{ date('Y-m-d') }}">
                </div>
                <div class="md:w-1/4">
                    <label for="tanggal_target" class="block text-sm font-medium text-gray-700 mb-1">Target Date</label>
                    <input type="date" name="tanggal_target"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-[#377d61] focus:ring-[#377d61] py-3 px-4 bg-gray-50 bg-opacity-50"
                        required>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full md:w-auto bg-[#377d61] hover:bg-[#2c634d] text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        Add
                    </button>
                </div>
            </form>
        </div>

        <!-- Goals List -->
        <!-- Active Goals List -->
        <h3 class="text-xl font-bold text-[#1a4d39] mb-4">Your Goals</h3>
        <div class="space-y-4 mb-10">
            @forelse($activeGoals as $goal)
                <div class="bg-[#ECF2F3] rounded-2xl p-5 flex items-center justify-between transition-all hover:shadow-md">
                    <div class="flex items-center gap-4 flex-grow">
                        <div>
                            <h3 class="font-bold text-[#1A4D39] text-lg">{{ $goal->judul_goals }}</h3>
                            <span
                                class="text-xs font-semibold text-[#377d61] bg-white px-2 py-0.5 rounded-full shadow-sm inline-block mt-1">Target:
                                {{ $goal->tanggal_target->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <form action="{{ route('user.goals.update', $goal->id_goals) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-white text-[#377d61] hover:bg-[#377d61] hover:text-white border border-[#377d61] transition-all p-2 rounded-lg"
                                title="Mark as Completed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('user.goals.destroy', $goal->id_goals) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-400 hover:text-red-600 transition-colors p-2 hover:bg-red-50 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-400">
                    <p>No active goals.</p>
                </div>
            @endforelse
        </div>

        <!-- Completed Goals List -->
        @if($completedGoals->count() > 0)
            <h3 class="text-xl font-bold text-gray-500 mb-4">Completed Goals</h3>
            <div class="space-y-4 mb-10 opacity-75">
                @foreach($completedGoals as $goal)
                    <div class="bg-gray-100 rounded-2xl p-5 flex items-center justify-between transition-all">
                        <div class="flex items-center gap-4 flex-grow">
                            <div>
                                <h3 class="font-bold text-gray-500 text-lg line-through">{{ $goal->judul_goals }}</h3>
                                <span
                                    class="text-xs font-semibold text-gray-400 bg-white px-2 py-0.5 rounded-full shadow-sm inline-block mt-1">Completed</span>
                            </div>
                        </div>
                        <form action="{{ route('user.goals.destroy', $goal->id_goals) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-gray-400 hover:text-red-600 transition-colors p-2 hover:bg-red-50 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection