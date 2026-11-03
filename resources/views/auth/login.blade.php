<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="title">Masuk | VISAwork</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-700 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0 px-6">
        
        <!-- Bagian Logo & Header -->
        <div class="mb-8 text-center">
            <a href="/" class="flex items-center justify-center gap-2 text-2xl font-semibold tracking-tight text-gray-900 transition hover:opacity-80">
                <img src="{{ asset('img/visaworklogo.png') }}" alt="Logo VISAwork" class="h-10 w-auto">
                <span>VISA<span class="text-emerald-600 font-normal">work</span></span>
            </a>
            <p data-i18n="subtitle" class="mt-3 text-sm text-gray-500 font-medium">Selamat datang kembali, silakan masuk ke akun Anda.</p>
        </div>

        <!-- Card Form Login -->
        <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden sm:rounded-2xl">
            
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" data-i18n="lbl-email" class="block font-medium text-sm text-gray-700">Alamat Email</label>
                    <input id="email" class="block mt-1.5 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm transition" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <label for="password" data-i18n="lbl-password" class="block font-medium text-sm text-gray-700">Kata Sandi</label>
                    <input id="password" class="block mt-1.5 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm transition" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-5">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 cursor-pointer transition" name="remember">
                        <span data-i18n="lbl-remember" class="ms-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Aksi Form -->
                <div class="flex items-center justify-between mt-8">
                    @if (Route::has('password.request'))
                        <a data-i18n="link-forgot" class="underline text-sm text-gray-500 hover:text-emerald-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors" href="{{ route('password.request') }}">
                            Lupa kata sandi?
                        </a>
                    @endif

                    <button data-i18n="btn-login" type="submit" class="inline-flex items-center px-8 py-2.5 bg-emerald-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        Masuk
                    </button>
                </div>
            </form>
            
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm text-gray-500">
                <span data-i18n="txt-no-account">Belum punya akun?</span> 
                <a data-i18n="link-register" href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-700 transition">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- SCRIPT TRANSLATE LOGIN -->
    <script>
        const translations = {
            id: {
                "title": "Masuk | VISAwork",
                "subtitle": "Selamat datang kembali, silakan masuk ke akun Anda.",
                "lbl-email": "Alamat Email",
                "lbl-password": "Kata Sandi",
                "lbl-remember": "Ingat saya",
                "link-forgot": "Lupa kata sandi?",
                "btn-login": "Masuk",
                "txt-no-account": "Belum punya akun?",
                "link-register": "Daftar Sekarang"
            },
            en: {
                "title": "Sign In | VISAwork",
                "subtitle": "Welcome back, please sign in to your account.",
                "lbl-email": "Email Address",
                "lbl-password": "Password",
                "lbl-remember": "Remember me",
                "link-forgot": "Forgot your password?",
                "btn-login": "Sign In",
                "txt-no-account": "Don't have an account?",
                "link-register": "Register Now"
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            // Ambil memori bahasa dari landing page (default: id)
            const savedLang = localStorage.getItem('visawork_lang') || 'id';
            
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if(translations[savedLang][key]) {
                    // Update isi teks dan title document
                    if(element.tagName === 'TITLE') document.title = translations[savedLang][key];
                    else element.innerHTML = translations[savedLang][key];
                }
            });
            document.documentElement.lang = savedLang;
        });
    </script>
</body>
</html>