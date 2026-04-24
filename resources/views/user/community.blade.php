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
    <script>
        function toggleComments(postId) {
            const commentSection = document.getElementById('comments-' + postId);
            if (commentSection.classList.contains('hidden')) {
                commentSection.classList.remove('hidden');
            } else {
                commentSection.classList.add('hidden');
            }
        }
    </script>
@endpush

@section('content')
    <div class="flex-grow w-full max-w-[1400px] mx-auto px-6 py-10">

        @if(session('success'))
            <div class="max-w-5xl mx-auto mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-5xl mx-auto mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative"
                role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="text-center mb-16 space-y-3">
            <h1 class="text-4xl md:text-5xl font-bold text-[#2C5F4B]">Komunitas</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Temukan ketenangan diri dengan sesi meditasi yang kami kurasi khusus untukmu.
            </p>
        </div>

        <div class="flex justify-end max-w-5xl mx-auto mb-6">
            <button onclick="document.getElementById('postModal').classList.remove('hidden')"
                class="bg-[#377d61] text-white px-6 py-2 rounded-lg font-medium hover:bg-[#2c634d] transition flex items-center gap-2">
                Buat Postingan
            </button>
        </div>

        <div class="space-y-8 max-w-5xl mx-auto">
            @forelse($posts as $post)
                <div
                    class="bg-[#ECF2F3] rounded-[20px] p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-12 shadow-sm transition-all hover:shadow-md">
                    <div
                        class="w-full md:w-1/5 flex flex-row md:flex-col items-center md:items-start justify-between md:justify-start pt-4 gap-4 border-b md:border-b-0 md:border-r border-gray-200 pb-4 md:pb-0 md:pr-4">
                        <h3 class="text-[#1A4D39] font-bold text-lg">@ {{ $post->user->username ?? 'User' }}</h3>

                        <div class="flex items-center gap-5 text-[#1A4D39]">
                            <form action="{{ route('user.community.like', $post->id_post) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-1.5 cursor-pointer hover:opacity-70 group transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                    <span class="text-xs font-bold">{{ $post->likes }}</span>
                                </button>
                            </form>
                            <button onclick="toggleComments('{{ $post->id_post }}')"
                                class="flex items-center gap-1.5 hover:text-[#377d61] transition-colors cursor-pointer">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                <span class="text-xs font-bold">{{ $post->komentar->count() }}</span>
                            </button>
                        </div>
                    </div>

                    <div class="w-full md:w-4/5 flex flex-col justify-center">
                        <h3 class="text-[#1A4D39] font-bold text-lg mb-2">{{ $post->judul_post }}</h3>
                        <div class="bg-white rounded-xl p-6 w-full shadow-sm min-h-[80px] flex items-center mb-4">
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $post->isi_post }}</p>
                        </div>

                        <!-- Comments Section (Hidden by Default) -->
                        <div id="comments-{{ $post->id_post }}" class="{{ $errors->has('isi_komentar') && old('post_id') == $post->id_post ? '' : 'hidden' }} mt-4 space-y-4">
                            <div class="flex justify-between items-center">
                                <h4 class="text-[#1A4D39] font-bold text-sm">Komentar ({{ $post->komentar->count() }})</h4>
                                <button onclick="toggleComments('{{ $post->id_post }}')" class="text-xs text-gray-400 hover:text-gray-600">tutup</button>
                            </div>

                            <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                                @foreach($post->komentar as $komentar)
                                    <div class="bg-white/50 rounded-lg p-3 border border-gray-100">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="text-xs font-bold text-[#377d61]">@
                                                {{ $komentar->user->username ?? 'User' }}</span>
                                            <span
                                                class="text-[10px] text-gray-400">{{ $komentar->created_at ? $komentar->created_at->diffForHumans() : '' }}</span>
                                        </div>
                                        <p class="text-xs text-gray-600 leading-relaxed">{{ $komentar->isi_komentar }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Comment Form -->
                            <form action="{{ route('user.community.comment', $post->id_post) }}" method="POST"
                                class="mt-4 flex flex-col gap-2">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id_post }}">
                                <div class="flex gap-2">
                                    <input type="text" name="isi_komentar" placeholder="Tulis komentar..."
                                        class="flex-grow rounded-lg border-gray-200 text-sm py-2 px-3 focus:ring-[#377d61] focus:border-[#377d61] @error('isi_komentar') border-red-500 @enderror"
                                        required>
                                    <button type="submit"
                                        class="bg-[#377d61] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#2c634d] transition shrink-0">
                                        Kirim
                                    </button>
                                </div>
                                @error('isi_komentar') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    <p>No posts visible.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Post Creation Modal -->
    <div id="postModal"
        class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-6 backdrop-blur-sm">
        <div class="bg-white rounded-[30px] w-full max-w-xl p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-[#1A4D39] mb-6">Buat Postingan Baru</h2>
            <form action="{{ route('user.community.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Postingan</label>
                    <input type="text" name="judul_post"
                        class="w-full rounded-xl border-gray-300 py-3 px-4 @error('judul_post') border-red-500 @enderror"
                        value="{{ old('judul_post') }}" required>
                    @error('judul_post') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Postingan</label>
                    <textarea name="isi_post" rows="4"
                        class="w-full rounded-xl border-gray-300 py-3 px-4 @error('isi_post') border-red-500 @enderror"
                        required>{{ old('isi_post') }}</textarea>
                    @error('isi_post') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('postModal').classList.add('hidden')"
                        class="flex-1 px-6 py-3 rounded-xl border border-gray-300">Batal</button>
                    <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-[#377d61] text-white">Posting</button>
                </div>
            </form>
        </div>
    </div>
@endsection