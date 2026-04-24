<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up - MindCare</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* Sliding Animation */
        .container-box {
            position: relative;
            overflow: hidden;
            width: 1000px;
            max-width: 100%;
            min-height: 600px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container-box.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .container-box.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container-box.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #2d6a4f;
            background: -webkit-linear-gradient(to right, #2d6a4f, #1b4332);
            background: linear-gradient(to right, #2d6a4f, #1b4332);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container-box.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container-box.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container-box.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
    </style>
</head>

<body class="bg-[#1a1a1a] flex justify-center items-center h-screen" id="mainBody">

    <!-- Auth Container -->
    <div class="bg-white rounded-[30px] shadow-2xl container-box {{ request()->routeIs('register') ? 'right-panel-active' : '' }}"
        id="container">

        <!-- Sign Up Form (Creates Account) -->
        <div class="form-container sign-up-container">
            <form action="{{ route('login.post') }}" method="POST"
                class="bg-white flex flex-col items-center justify-center h-full px-12 text-center">
                @csrf
                <!-- Logo Mobile/Top (Optional) -->

                <h1 class="font-bold text-3xl text-[#2d6a4f] mb-4">Create Account</h1>

                <!-- Social Icons -->
                <div class="flex gap-4 mb-6">
                    <a href="#"
                        class="border border-black rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="border border-black rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307c-1.813-1.813-4.387-3.24-8.213-3.24-6.613 0-12 5.387-12 12s5.387 12 12 12c3.467 0 6.373-1.12 8.48-3.293 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053h-12.48z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="border border-black rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                        </svg>
                    </a>
                </div>

                <span class="text-sm text-gray-400 mb-4">or use your email for registration</span>

                <input type="text" placeholder="Name"
                    class="bg-gray-200 border-none px-4 py-3 mb-3 w-full rounded-lg outline-none focus:ring-2 focus:ring-[#2d6a4f]" />
                <input type="email" placeholder="Email"
                    class="bg-gray-200 border-none px-4 py-3 mb-3 w-full rounded-lg outline-none focus:ring-2 focus:ring-[#2d6a4f]" />
                <input type="password" placeholder="Password"
                    class="bg-gray-200 border-none px-4 py-3 mb-6 w-full rounded-lg outline-none focus:ring-2 focus:ring-[#2d6a4f]" />
                <input type="hidden" name="type" value="register"> <!-- Mock Type -->

                <button
                    class="bg-[#2d6a4f] text-white font-bold py-3 px-12 rounded-full uppercase tracking-wider hover:bg-[#1b4332] transition transform hover:scale-105">Sign
                    Up</button>
            </form>
        </div>

        <!-- Sign In Form (Logs In) -->
        <div class="form-container sign-in-container">
            <form action="{{ route('login.post') }}" method="POST"
                class="bg-white flex flex-col items-center justify-center h-full px-12 text-center">
                @csrf
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6 text-[#E0C09F]">
                    <div class="h-8 w-auto">
                        <img src="{{ asset('img/logo.png') }}" class="h-full object-contain">
                    </div>
                </a>

                <h1 class="font-bold text-3xl text-[#2d6a4f] mb-4">Sign in</h1>

                <!-- Social Icons -->
                <div class="flex gap-4 mb-6">
                    <a href="#"
                        class="border border-black rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="border border-black rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307c-1.813-1.813-4.387-3.24-8.213-3.24-6.613 0-12 5.387-12 12s5.387 12 12 12c3.467 0 6.373-1.12 8.48-3.293 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053h-12.48z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="border border-black rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                        </svg>
                    </a>
                </div>

                <span class="text-sm text-gray-400 mb-4">or use your account</span>

                @if($errors->has('email'))
                    <div
                        class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg relative mb-4 text-sm">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <input type="email" placeholder="Email" name="email"
                    class="bg-gray-200 border-none px-4 py-3 mb-3 w-full rounded-lg outline-none focus:ring-2 focus:ring-[#2d6a4f]" />
                <input type="password" placeholder="Password" name="password"
                    class="bg-gray-200 border-none px-4 py-3 mb-4 w-full rounded-lg outline-none focus:ring-2 focus:ring-[#2d6a4f]" />

                <a href="#"
                    class="text-sm text-gray-500 hover:text-black mb-6 border-b border-transparent hover:border-black transition-all">Forgot
                    your password?</a>

                <button
                    class="bg-[#2d6a4f] text-white font-bold py-3 px-12 rounded-full uppercase tracking-wider hover:bg-[#1b4332] transition transform hover:scale-105">Sign
                    In</button>
            </form>
        </div>

        <!-- Overlay Container (Green Panel) -->
        <div class="overlay-container">
            <div class="overlay">
                <!-- Left Overlay (Shown when in Sign Up Mode, asks to Sign In) -->
                <div class="overlay-panel overlay-left">
                    <a href="{{ route('home') }}" class="h-16 mb-4 block">
                        <img src="{{ asset('img/logo.png') }}" class="h-full object-contain filter brightness-0 invert">
                    </a>
                    <h1 class="font-bold text-3xl mb-4">Welcome Back!</h1>
                    <p class="text-sm font-light leading-relaxed mb-8 text-green-100">
                        To keep connected with us please login with your personal info
                    </p>
                    <button
                        class="bg-transparent border border-white text-white font-bold py-3 px-12 rounded-full uppercase tracking-wider hover:bg-white/20 transition"
                        id="signIn">Sign In</button>
                </div>

                <!-- Right Overlay (Shown when in Sign In Mode, asks to Sign Up) -->
                <div class="overlay-panel overlay-right">
                    <a href="{{ route('home') }}" class="h-16 mb-4 block">
                        <img src="{{ asset('img/logo.png') }}" class="h-full object-contain filter brightness-0 invert">
                    </a>
                    <h1 class="font-bold text-3xl mb-4">Hello, Friend!</h1>
                    <p class="text-sm font-light leading-relaxed mb-8 text-green-100">
                        Enter your personal details and start journey with us
                    </p>
                    <button
                        class="bg-transparent border border-white text-white font-bold py-3 px-12 rounded-full uppercase tracking-wider hover:bg-white/20 transition"
                        id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        const body = document.getElementById('mainBody');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>

</html>