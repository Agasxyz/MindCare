@extends('layouts.admin')

@section('header', isset($article) ? 'Edit Article' : 'Create Article')

@section('content')
<div class="flex justify-center items-center min-h-[calc(100vh-140px)]">
    <!-- Main Card -->
    <div class="bg-[#2d6a4f] rounded-[30px] p-8 w-full max-w-4xl shadow-xl relative overflow-hidden flex flex-col max-h-[80vh]">
        
        <!-- Header Badge -->
        <div class="flex-shrink-0 mb-6">
            <div class="bg-[#40916c] text-white px-8 py-2 rounded-full font-bold text-lg inline-flex items-center shadow-sm">
                {{ isset($article) ? 'Edit Article' : 'Create Article' }}
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
            <form action="{{ isset($article) ? route('admin.article.update', $article->id_artikel) : route('admin.article.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if(isset($article))
                    @method('PUT')
                @endif
                
                <!-- Title Input -->
                <div class="space-y-2">
                    <label class="text-white font-bold text-lg pl-1">Judul</label>
                    <input type="text" name="judul_artikel"
                        value="{{ old('judul_artikel', $article->judul_artikel ?? '') }}" 
                        class="w-full bg-[#40916c] text-white font-bold text-xl px-6 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-[#74c69d] placeholder-green-200/50 transition-all border border-transparent"
                        placeholder="Masukkan judul artikel"
                    >
                </div>

                <!-- Image Input -->
                <div class="space-y-2">
                    <label class="text-white font-bold text-lg pl-1">Gambar</label>
                    <input type="file" name="gambar" class="w-full text-white bg-[#40916c] rounded-2xl p-4">
                </div>

                <!-- Content Input -->
                <div class="space-y-2">
                    <label class="text-white font-bold text-lg pl-1">Isi Artikel</label>
                    <textarea name="isi_artikel"
                        rows="12"
                        class="w-full bg-[#40916c] text-white text-base px-6 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-[#74c69d] placeholder-green-200/50 transition-all border border-transparent leading-relaxed custom-scrollbar-textarea"
                        placeholder="Tulis isi artikel disini..."
                    >{{ old('isi_artikel', $article->isi_artikel ?? '') }}</textarea>
                </div>

                 <div class="pb-4"></div>
                 
                 <!-- Footer Buttons (Inside Form for valid submit) -->
                <div class="flex-shrink-0 pt-6 mt-2 border-t border-[#40916c]/30 flex gap-4">
                    <button type="submit" class="bg-[#52b788] text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#40916c] transition-colors shadow-lg shadow-[#1b4332]/20">
                        Simpan
                    </button>
                    <a href="{{ route('admin.article') }}" class="bg-[#95d5b2] text-[#1b4332] px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#74c69d] transition-colors shadow-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Preserving styles -->
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); border-radius: 4px; margin: 10px 0; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.5); }
    .custom-scrollbar-textarea::-webkit-scrollbar { width: 8px; }
    .custom-scrollbar-textarea::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.1); border-radius: 4px; }
    .custom-scrollbar-textarea::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 4px; }
</style>
@endsection
