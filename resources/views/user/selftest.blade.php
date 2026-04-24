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
    <div class="flex-grow w-full max-w-[1400px] mx-auto px-6 py-10 flex flex-col items-center">

        <div class="text-center mb-12 space-y-3">
            <h1 class="text-4xl md:text-5xl font-bold text-[#2C5F4B]">Self Test</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Ambil napas dalam-dalam dan jawab pertanyaan berikut dengan jujur.
                Hasil tes ini akan membantu kami memberikan rekomendasi yang tepat untuk ketenanganmu.
            </p>
        </div>

        <!-- Landing Section -->
        <div id="landingSection" class="w-full flex flex-col items-center">
            <div
                class="w-full bg-[#EFF5F6] rounded-[30px] p-8 md:p-12 flex flex-col md:flex-row items-center justify-between shadow-sm relative overflow-hidden mb-12">
                <div class="w-full md:w-1/2 space-y-8 relative z-10">
                    <h2 class="text-3xl font-bold text-[#377d61]">Paket Soal</h2>
                    <div class="space-y-5">
                        <div class="flex items-center gap-4 text-[#377d61]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-lg font-medium text-[#4a5f55]">10 Menit</span>
                        </div>
                        <div class="flex items-center gap-4 text-[#377d61]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span class="text-lg font-medium text-[#4a5f55]">10 Soal</span>
                        </div>
                        <div class="flex items-center gap-4 text-[#377d61]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <span class="text-lg font-medium text-[#4a5f55]">Evaluasi Kesehatan Mental</span>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-8 md:mt-0 relative z-10">
                    <svg class="w-64 h-64 md:w-80 md:h-80 drop-shadow-lg" viewBox="0 0 400 400" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="200" cy="200" r="180" fill="#E0F2F1" opacity="0.5" />
                        <path d="M130 350 L 270 350 L 250 250 L 150 250 Z" fill="#377d61" />
                        <path d="M150 250 L 250 250 L 250 150 L 150 150 Z" fill="#F5F5F5" />
                        <circle cx="200" cy="120" r="40" fill="#E0C09F" />
                    </svg>
                </div>
            </div>

            @auth
                <button onclick="startQuiz()"
                    class="bg-[#377d61] hover:bg-[#2c634d] text-white text-lg font-semibold py-3 px-16 rounded-lg shadow-md transition-all transform hover:-translate-y-1">
                    Mulai
                </button>
            @else
                <a href="{{ route('login') }}"
                    class="bg-[#377d61] hover:bg-[#2c634d] text-white text-lg font-semibold py-3 px-16 rounded-lg shadow-md transition-all transform hover:-translate-y-1">
                    Login untuk Mulai
                </a>
            @endauth
        </div>

        <!-- Quiz Section -->
        <div id="quizSection"
            class="hidden w-full max-w-3xl bg-white rounded-[30px] p-8 md:p-12 shadow-xl border border-gray-100">
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <span id="questionCounter" class="text-[#377d61] font-bold">Soal 1/10</span>
                    <div class="w-2/3 bg-gray-200 rounded-full h-2.5">
                        <div id="progressBar" class="bg-[#377d61] h-2.5 rounded-full transition-all duration-300"
                            style="width: 10%"></div>
                    </div>
                </div>
                <h2 id="questionText" class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">Loading
                    question...</h2>
            </div>

            <div id="optionsContainer" class="space-y-4">
                <!-- Options will be here -->
            </div>
        </div>

        <!-- Result Section -->
        <div id="resultSection"
            class="hidden w-full max-w-2xl bg-[#EFF5F6] rounded-[30px] p-8 md:p-12 text-center shadow-xl">
            <h2 class="text-3xl font-bold text-[#377d61] mb-6">Hasil Tes Anda</h2>
            <div id="scoreValue" class="text-64 font-bold text-[#377d61] mb-2">0</div>
            <div id="resultStatus" class="text-xl font-bold text-gray-800 mb-6 uppercase tracking-wider">Status:
                loading...</div>
            <p id="resultDesc" class="text-gray-600 mb-10 leading-relaxed"></p>

            <div id="recommendationContainer" class="hidden mt-8 text-left border-t border-gray-200 pt-8">
                <h3 class="text-xl font-bold text-[#377d61] mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Rekomendasi Untuk Anda
                </h3>
                <div id="recommendationGrid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Recommended Cards -->
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row gap-4 justify-center">
                <button onclick="restartQuiz()"
                    class="bg-[#377d61] hover:bg-[#2c634d] text-white font-bold py-3 px-10 rounded-xl transition-all shadow-md">
                    Tes Lagi
                </button>
                <a href="{{ route('user.meditation') }}" id="exploreMediationBtn"
                    class="hidden bg-white border-2 border-[#377d61] text-[#377d61] font-bold py-3 px-10 rounded-xl hover:bg-gray-50 transition-all">
                    Lihat Semua Meditasi
                </a>
            </div>
        </div>
    </div>

    <script>
        const questions = {!! json_encode($questions->pluck('pertanyaan')) !!};

        const options = [
            { text: "Tidak pernah", points: 4 },
            { text: "Jarang", points: 3 },
            { text: "Sering", points: 2 },
            { text: "Sangat Sering", points: 1 }
        ];

        let currentQuestion = 0;
        let totalScore = 0;

        function startQuiz() {
            document.getElementById('landingSection').classList.add('hidden');
            document.getElementById('quizSection').classList.remove('hidden');
            showQuestion();
        }

        function showQuestion() {
            if (questions.length === 0) {
                alert('No questions available.');
                return;
            }
            document.getElementById('questionCounter').innerText = `Soal ${currentQuestion + 1}/${questions.length}`;
            document.getElementById('progressBar').style.width = `${((currentQuestion + 1) / questions.length) * 100}%`;
            document.getElementById('questionText').innerText = questions[currentQuestion];

            const container = document.getElementById('optionsContainer');
            container.innerHTML = '';

            options.forEach(opt => {
                const button = document.createElement('button');
                button.className = "w-full text-left p-5 rounded-2xl border-2 border-gray-100 bg-gray-50 hover:bg-[#377d61] hover:text-white hover:border-[#377d61] transition-all font-medium text-lg flex justify-between items-center group";
                button.innerHTML = `
                        <span>${opt.text}</span>
                        <svg class="w-6 h-6 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    `;
                button.onclick = () => handleAnswer(opt.points);
                container.appendChild(button);
            });
        }

        function handleAnswer(points) {
            totalScore += points;
            currentQuestion++;

            if (currentQuestion < questions.length) {
                showQuestion();
            } else {
                showResult();
            }
        }

        function showResult() {
            document.getElementById('quizSection').classList.add('hidden');
            document.getElementById('resultSection').classList.remove('hidden');
            document.getElementById('scoreValue').innerText = totalScore;

            let status = "";
            let desc = "";

            if (totalScore >= 30) {
                status = "Rendah";
                desc = "Kesehatan mental Anda tampak stabil. Teruslah menjaga keseimbangan hidup dan pola pikir yang positif!";
            } else if (totalScore >= 20) {
                status = "Sedang";
                desc = "Anda mungkin sedang mengalami stres ringan atau kelelahan mental. Pertimbangkan untuk meluangkan waktu beristirahat dan melakukan aktivitas yang Anda senangi.";
            } else {
                status = "Tinggi";
                desc = "Skor Anda menunjukkan tingkat tekanan mental yang signifikan. Kami sangat menyarankan Anda untuk berkonsultasi dengan profesional atau bercerita kepada orang yang Anda percayai.";
            }

            document.getElementById('resultStatus').innerText = `Status: ${status}`;
            document.getElementById('resultDesc').innerText = desc;

            // Reset recommendations
            document.getElementById('recommendationContainer').classList.add('hidden');
            document.getElementById('exploreMediationBtn').classList.add('hidden');

            // Save Result to Database
            console.log('Saving result...', { total_score: totalScore, status: status });
            fetch('{{ route('user.selftest.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    total_score: totalScore,
                    status: status
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    console.log('Result saved successfully:', data);
                    if (data.recommendations && data.recommendations.length > 0) {
                        console.log('Rendering recommendations:', data.recommendations);
                        renderRecommendations(data.recommendations);
                    } else {
                        console.log('No recommendations found for status:', status);
                    }
                })
                .catch(error => {
                    console.error('Error saving result:', error);
                    alert('Gagal menyimpan hasil tes. Silakan coba lagi.');
                });
        }

        function renderRecommendations(recs) {
            const container = document.getElementById('recommendationContainer');
            const grid = document.getElementById('recommendationGrid');
            const exploreBtn = document.getElementById('exploreMediationBtn');

            grid.innerHTML = '';
            recs.forEach(rec => {
                const card = document.createElement('div');
                card.className = "bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-all group";
                card.innerHTML = `
                        <div class="h-32 w-full bg-gray-200 overflow-hidden relative">
                            <img src="${rec.gambar ? '/storage/' + rec.gambar : 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80'}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/10"></div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-[#2C5F4B] mb-1 line-clamp-1">${rec.judul_meditasi}</h4>
                            <p class="text-xs text-gray-500 mb-4 line-clamp-2">${rec.deskripsi}</p>
                            <a href="/user/meditation/${rec.id_meditasi}/play" class="inline-flex items-center gap-2 text-sm font-bold text-[#377d61] hover:text-[#2c634d] transition-colors">
                                Mulai Meditasi
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    `;
                grid.appendChild(card);
            });

            container.classList.remove('hidden');
            exploreBtn.classList.remove('hidden');
        }

        function restartQuiz() {
            currentQuestion = 0;
            totalScore = 0;
            document.getElementById('resultSection').classList.add('hidden');
            document.getElementById('landingSection').classList.remove('hidden');
        }
    </script>
@endsection