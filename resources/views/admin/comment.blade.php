@extends('layouts.admin')

@section('header', 'Community')

@section('content')
    <div class="bg-[#b59a3e] rounded-[30px] p-8 min-h-[600px] flex flex-col relative overflow-hidden shadow-lg">
        <!-- Header Badge -->
        <div class="inline-block mb-8">
            <div
                class="bg-[#8a7229] text-white px-8 py-2 rounded-full font-bold text-lg inline-flex items-center shadow-sm">
                Community / Comments
            </div>
        </div>

        <!-- Post Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse ($posts as $post)
                <div
                    class="bg-[#8a7229]/40 backdrop-blur-sm rounded-[20px] p-6 text-white flex flex-col border border-[#ffe066]/20 hover:bg-[#8a7229]/50 transition-colors duration-300">
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <h3 class="font-bold text-xl mb-1 tracking-wide">{{ $post->judul_post }}</h3>
                        <p class="text-[#ffe066] text-xs font-medium">By {{ $post->user->username ?? 'Anonymous' }}</p>
                    </div>

                    <!-- Content -->
                    <div class="space-y-4 text-sm font-medium leading-relaxed opacity-90 flex-1">
                        <p>
                            "{{ Str::limit($post->isi_post, 150) }}"
                        </p>
                        <p class="text-xs opacity-70 italic">
                            Posted
                            {{ $post->created_at instanceof \Carbon\Carbon ? $post->created_at->diffForHumans() : 'Recently' }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-center gap-4 mt-8">
                        <!-- Delete Button -->
                        <button onclick="openDeleteModal({{ $post->id_post }})"
                            class="w-10 h-10 rounded-full bg-[#e0c066] hover:bg-[#c9aa55] flex items-center justify-center text-white transition-transform hover:scale-110 shadow-md group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-white/70 py-10">
                    Belum ada postingan di forum.
                </div>
            @endforelse
        </div>

        <!-- Hidden Delete Form -->
        <form id="deleteForm" method="POST" action="" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 opacity-0 invisible transition-all duration-300 backdrop-blur-sm">
            <div class="bg-white rounded-[30px] p-8 w-[400px] text-center shadow-2xl transform scale-90 transition-all duration-300 relative"
                id="modalContent">
                <!-- Red Icon Circle -->
                <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#d32f2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-8">Hapus Komentar Ini?</h3>

                <div class="flex gap-4 justify-center">
                    <button onclick="submitDelete()"
                        class="bg-[#d32f2f] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#b71c1c] transition-colors shadow-lg shadow-red-200">Ya,
                        Hapus</button>
                    <button onclick="closeDeleteModal()"
                        class="bg-transparent border-2 border-gray-300 text-gray-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-50 transition-colors">Batal</button>
                </div>
            </div>
        </div>

        <script>
            let deleteId = null;
            function openDeleteModal(id) {
                deleteId = id;
                const modal = document.getElementById('deleteModal');
                const content = document.getElementById('modalContent');
                modal.classList.remove('opacity-0', 'invisible');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }

            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                const content = document.getElementById('modalContent');
                modal.classList.add('opacity-0', 'invisible');
                content.classList.remove('scale-100');
                content.classList.add('scale-90');
                deleteId = null;
            }

            function submitDelete() {
                if (deleteId) {
                    const form = document.getElementById('deleteForm');
                    form.action = "{{ url('admin/comment') }}/" + deleteId;
                    form.submit();
                }
            }

            // Close on backdrop click
            document.getElementById('deleteModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeDeleteModal();
                }
            });
        </script>
    </div>
@endsection