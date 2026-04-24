@extends('layouts.admin')

@section('header', isset($meditation) ? 'Edit Meditasi' : 'Tambah Meditasi')

@section('content')
    <div class="flex justify-center items-center min-h-[calc(100vh-140px)]">
        <!-- Main Card -->
        <div
            class="bg-[#6f2c2c] rounded-[30px] p-8 w-full max-w-4xl shadow-xl relative overflow-hidden flex flex-col max-h-[80vh]">

            <!-- Header Badge -->
            <div class="flex-shrink-0 mb-6">
                <div
                    class="bg-[#4a1d1d] text-white px-8 py-2 rounded-full font-bold text-lg inline-flex items-center shadow-sm">
                    {{ isset($meditation) ? 'Edit Meditasi' : 'Tambah Meditasi' }}
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Scrollable Form Container -->
            <div class="overflow-y-auto pr-4 custom-scrollbar flex-1">
                <form
                    action="{{ isset($meditation) ? route('admin.meditation.update', $meditation->id_meditasi) : route('admin.meditation.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if(isset($meditation))
                        @method('PUT')
                    @endif

                    <!-- Title Input -->
                    <div class="space-y-2">
                        <label class="text-white font-bold text-lg pl-1">Judul Meditasi</label>
                        <input type="text" name="judul_meditasi"
                            value="{{ old('judul_meditasi', $meditation->judul_meditasi ?? '') }}"
                            class="w-full bg-[#4a1d1d] text-white font-bold text-xl px-6 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-[#8c3838] placeholder-red-200/50 transition-all border border-transparent"
                            placeholder="Nama Meditasi">
                    </div>

                    <!-- Category/Type Input -->
                    <div class="space-y-2">
                        <label class="text-white font-bold text-lg pl-1">Kategori / Durasi</label>
                        <input type="text" name="kategori" value="{{ old('kategori', $meditation->kategori ?? '') }}"
                            class="w-full bg-[#4a1d1d] text-white font-bold text-xl px-6 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-[#8c3838] placeholder-red-200/50 transition-all border border-transparent"
                            placeholder="Contoh: Menenangkan - 10 Menit">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Image Input -->
                        <div class="space-y-2">
                            <label class="text-white font-bold text-lg pl-1">Gambar</label>
                            <input type="file" name="gambar" class="w-full text-white bg-[#4a1d1d] rounded-2xl p-4">
                            @if(isset($meditation) && $meditation->gambar)
                                <p class="text-xs text-red-200 mt-1">File saat ini: {{ basename($meditation->gambar) }}</p>
                            @endif
                        </div>

                        <!-- Audio Input -->
                        <div class="space-y-2">
                            <label class="text-white font-bold text-lg pl-1">File Musik (Audio)</label>
                            <input type="file" name="audio" accept="audio/*"
                                class="w-full text-white bg-[#4a1d1d] rounded-2xl p-4">
                            @if(isset($meditation) && $meditation->audio)
                                <p class="text-xs text-red-200 mt-1">File saat ini: {{ basename($meditation->audio) }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Content Input -->
                    <div class="space-y-2">
                        <label class="text-white font-bold text-lg pl-1">Deskripsi & Panduan</label>
                        <textarea name="deskripsi" rows="8"
                            class="w-full bg-[#4a1d1d] text-white text-base px-6 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-[#8c3838] placeholder-red-200/50 transition-all border border-transparent leading-relaxed custom-scrollbar-textarea"
                            placeholder="Jelaskan detail meditasi...">{{ old('deskripsi', $meditation->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="pb-4"></div>

                    <!-- Footer Buttons -->
                    <div class="flex-shrink-0 pt-6 mt-2 border-t border-[#4a1d1d]/30 flex gap-4">
                        <button type="submit"
                            class="bg-[#b85c5c] text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#964b4b] transition-colors shadow-lg shadow-[#3d1818]/20">
                            Simpan perubahan
                        </button>
                        <a href="{{ route('admin.meditation') }}"
                            class="bg-[#dcaaaa] text-[#3d1818] px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#c98888] transition-colors shadow-lg">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Custom Scrollbar Styling (Red Theme) */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            margin: 10px 0;
        }

        .custom-scrollbar::-webkit-scrollbar {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .custom-scrollbar-textarea::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar-textarea::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .custom-scrollbar-textarea::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }
    </style>
@endsection