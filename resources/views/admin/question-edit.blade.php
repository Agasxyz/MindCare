@extends('layouts.admin')

@section('header', $question ? 'Edit Pertanyaan' : 'Tambah Pertanyaan')

@section('content')
<div class="flex justify-center items-center min-h-[calc(100vh-140px)]">
    <!-- Main Card -->
    <div class="bg-[#2c5f7d] rounded-[30px] p-8 w-full max-w-4xl shadow-xl relative overflow-hidden flex flex-col max-h-[80vh]">
        
        <!-- Header Badge -->
        <div class="flex-shrink-0 mb-6">
            <div class="bg-[#1a3a4d] text-white px-8 py-2 rounded-full font-bold text-lg inline-flex items-center shadow-sm">
                {{ $question ? 'Edit Pertanyaan' : 'Tambah Pertanyaan' }}
            </div>
        </div>

        <!-- Scrollable Form Container -->
        <div class="overflow-y-auto pr-4 custom-scrollbar flex-1">
            <form id="questionForm" action="{{ $question ? route('admin.question.update', $question->id_pertanyaan) : route('admin.question.store') }}" method="POST" class="space-y-6">
                @csrf
                @if($question)
                    @method('PUT')
                @endif

                <!-- Content Input -->
                <div class="space-y-2">
                    <label class="text-white font-bold text-lg pl-1">Isi Pertanyaan</label>
                    <textarea 
                        name="pertanyaan"
                        rows="6"
                        required
                        class="w-full bg-[#1a3a4d] text-white text-base px-6 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-[#7dbae3] placeholder-blue-200/50 transition-all border border-transparent leading-relaxed custom-scrollbar-textarea"
                    >{{ old('pertanyaan', $question->pertanyaan ?? '') }}</textarea>
                </div>

                <div class="pb-4"></div>
            </form>
        </div>

        <!-- Footer Buttons -->
        <div class="flex-shrink-0 pt-6 mt-2 border-t border-[#1a3a4d]/30 flex gap-4">
            <button type="submit" form="questionForm" class="bg-[#5f9bc1] text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#4a85a8] transition-colors shadow-lg shadow-[#142d3c]/20">
                {{ $question ? 'Simpan perubahan' : 'Tambah Pertanyaan' }}
            </button>
            <a href="{{ route('admin.question') }}" class="bg-[#bfdceb] text-[#142d3c] px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#a6cee3] transition-colors shadow-lg">
                Batal
            </a>
        </div>

    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); border-radius: 4px; margin: 10px 0; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.5); }
</style>
@endsection
