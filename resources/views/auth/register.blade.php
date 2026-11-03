<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="title">Daftar Akun | VISAwork</title>
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
            <p data-i18n="subtitle" class="mt-3 text-sm text-gray-500 font-medium">Mulai kelola keuangan Anda dengan mudah.</p>
        </div>

        <!-- Card Form Registrasi -->
        <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden sm:rounded-2xl">
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" data-i18n="lbl-name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                    <input id="name" class="block mt-1.5 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm transition" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-5">
                    <label for="email" data-i18n="lbl-email" class="block font-medium text-sm text-gray-700">Alamat Email</label>
                    <input id="email" class="block mt-1.5 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm transition" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <label for="password" data-i18n="lbl-password" class="block font-medium text-sm text-gray-700">Kata Sandi</label>
                    <input id="password" class="block mt-1.5 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm transition" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-5">
                    <label for="password_confirmation" data-i18n="lbl-confirm" class="block font-medium text-sm text-gray-700">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" class="block mt-1.5 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm transition" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Aksi Form -->
                <div class="flex items-center justify-between mt-8">
                    <a data-i18n="link-login" class="underline text-sm text-gray-500 hover:text-emerald-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <button data-i18n="btn-register" type="submit" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        Daftar Akun
                    </button>
                </div>
            </form>
            
        </div>
    </div>

    <!-- SCRIPT TRANSLATE REGISTER -->
    <script>
        const translations = {
            id: {
                "title": "Daftar Akun | VISAwork",
                "subtitle": "Mulai kelola keuangan Anda dengan mudah.",
                "lbl-name": "Nama Lengkap",
                "lbl-email": "Alamat Email",
                "lbl-password": "Kata Sandi",
                "lbl-confirm": "Konfirmasi Kata Sandi",
                "link-login": "Sudah punya akun?",
                "btn-register": "Daftar Akun"
            },
            en: {
                "title": "Create Account | VISAwork",
                "subtitle": "Start managing your finances effortlessly.",
                "lbl-name": "Full Name",
                "lbl-email": "Email Address",
                "lbl-password": "Password",
                "lbl-confirm": "Confirm Password",
                "link-login": "Already have an account?",
                "btn-register": "Create Account"
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('visawork_lang') || 'id';
            
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if(translations[savedLang][key]) {
                    if(element.tagName === 'TITLE') document.title = translations[savedLang][key];
                    else element.innerHTML = translations[savedLang][key];
                }
            });
            document.documentElement.lang = savedLang;
        });
    </script>
</body>
</html>