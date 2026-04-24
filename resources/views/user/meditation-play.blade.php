<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Playing - {{ $meditation->judul_meditasi }} - MindCare</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        input[type=range] {
            -webkit-appearance: none;
            width: 100%;
            background: transparent;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #2F785C;
            cursor: pointer;
            margin-top: -6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 4px;
            cursor: pointer;
            background: #d1d5db;
            border-radius: 2px;
        }

        input[type=range]:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 3px rgba(47, 120, 92, 0.3);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-[#e8f5e9] to-[#c8e6c9] min-h-screen flex flex-col items-center justify-center p-6 text-[#1a1a1a]">

    <!-- Back Button -->
    <a href="{{ route('user.meditation') }}"
        class="absolute top-6 left-6 flex items-center gap-2 text-[#2F785C] font-medium hover:text-[#1b4332] transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Back to Meditation
    </a>

    <!-- Player Card -->
    <div class="bg-white rounded-[32px] shadow-2xl p-6 w-full max-w-sm relative overflow-hidden">

        <!-- Decoration Background -->
        <div class="absolute top-0 right-0 w-24 h-24 bg-[#5DB893]/10 rounded-bl-[80px] -z-0"></div>

        <!-- Thumbnail Image -->
        <div class="w-full aspect-square rounded-[20px] overflow-hidden mb-5 shadow-lg relative mx-auto max-h-[300px]">
            <img src="{{ asset('storage/' . $meditation->gambar) }}"
                onerror="this.src='https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'"
                alt="{{ $meditation->judul_meditasi }}" class="w-full h-full object-cover">
        </div>

        <!-- Title & Info -->
        <div class="text-center mb-5">
            <h1 class="text-xl font-bold text-[#1a1a1a] mb-1 line-clamp-1">{{ $meditation->judul_meditasi }}</h1>
            <p class="text-[#2F785C] text-sm font-medium opacity-80">{{ $meditation->kategori }}</p>
        </div>

        <!-- Audio Element -->
        <audio id="audioPlayer" src="{{ asset('storage/' . $meditation->audio) }}"></audio>

        <!-- Progress Slider -->
        <div class="mb-1">
            <input type="range" id="progressBar" value="0" max="100" step="0.1" class="w-full h-1">
        </div>
        <div class="flex justify-between text-[10px] font-bold text-gray-400 mb-5">
            <span id="currentTime">0:00</span>
            <span id="totalTime">0:00</span>
        </div>

        <!-- Controls -->
        <div class="flex items-center justify-center gap-8">
            <!-- Play/Pause -->
            <button id="playBtn"
                class="w-14 h-14 rounded-full bg-[#2F785C] text-white flex items-center justify-center shadow-lg hover:bg-[#1b4332] hover:scale-105 transition-all transform active:scale-95">
                <!-- Play Icon -->
                <svg id="playIcon" class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                </svg>
                <!-- Pause Icon (Hidden by default) -->
                <svg id="pauseIcon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                </svg>
            </button>
        </div>

    </div>

    <!-- Script for Audio Functionality -->
    <script>
        const audio = document.getElementById('audioPlayer');
        const playBtn = document.getElementById('playBtn');
        const playIcon = document.getElementById('playIcon');
        const pauseIcon = document.getElementById('pauseIcon');
        const progressBar = document.getElementById('progressBar');
        const currentTimeEl = document.getElementById('currentTime');
        const totalTimeEl = document.getElementById('totalTime');

        let isDragging = false;
        let wasPlaying = false;

        // Force browser to load the whole file if possible
        audio.preload = "auto";

        // 1. Duration
        const updateDuration = () => {
            if (audio.duration && !isNaN(audio.duration) && isFinite(audio.duration)) {
                progressBar.max = audio.duration;
                totalTimeEl.innerText = formatTime(audio.duration);
            }
        };
        audio.addEventListener('loadedmetadata', updateDuration);
        audio.addEventListener('durationchange', updateDuration);
        audio.addEventListener('canplay', updateDuration);
        if (audio.readyState >= 1) updateDuration();

        // 2. Play/Pause
        playBtn.addEventListener('click', () => {
            if (audio.paused) audio.play();
            else audio.pause();
        });

        const updatePlayIcon = () => {
            if (audio.paused) {
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
            } else {
                playIcon.classList.add('hidden');
                pauseIcon.classList.remove('hidden');
            }
        };
        audio.addEventListener('play', updatePlayIcon);
        audio.addEventListener('pause', updatePlayIcon);

        // 3. Simple Pause-Seek-Play
        // When user touches slider, we PAUSE.
        // When user releases, we SEEK and PLAY.

        const startDrag = () => {
            isDragging = true;
            if (!audio.paused) {
                wasPlaying = true;
                audio.pause();
            } else {
                wasPlaying = false;
            }
        };

        const onInput = () => {
            // Visual only
            currentTimeEl.innerText = formatTime(progressBar.value);
        };

        const onChange = () => {
            // Commit seek
            const time = parseFloat(progressBar.value);
            if (isFinite(time) && audio.duration) {
                audio.currentTime = time;
            }

            // Resume if needed
            if (wasPlaying) {
                // Use a small timeout to let the seek register
                setTimeout(() => {
                    audio.play().catch(e => console.error(e));
                }, 50);
            }
            isDragging = false;
        };

        progressBar.addEventListener('mousedown', startDrag);
        progressBar.addEventListener('touchstart', startDrag);

        progressBar.addEventListener('input', onInput);

        progressBar.addEventListener('change', onChange);

        // 4. Time Update
        audio.addEventListener('timeupdate', () => {
            if (!isDragging && !audio.seeking) {
                progressBar.value = audio.currentTime;
                currentTimeEl.innerText = formatTime(audio.currentTime);
            }
        });

        // 5. Helpers
        window.skip = (seconds) => {
            audio.currentTime += seconds;
        };

        function formatTime(seconds) {
            if (isNaN(seconds)) return "0:00";
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
        }

        audio.addEventListener('ended', () => {
            playIcon.classList.remove('hidden');
            pauseIcon.classList.add('hidden');
            progressBar.value = 0;
            currentTimeEl.innerText = "0:00";
            isDragging = false;
        });
    </script>
</body>

</html>