<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 font-inter">
    <!-- Primary Navigation Menu -->
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo VISAwork -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-semibold tracking-tight text-gray-900 transition hover:opacity-80">
                        <img src="{{ asset('img/visaworklogo.png') }}" alt="Logo VISAwork" class="h-8 w-auto">
                        <span>VISA<span class="text-emerald-600 font-normal">work</span></span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex h-full">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="focus:border-emerald-500 hover:border-emerald-300">
                        <span data-i18n="nav-dashboard">{{ __('Dashboard') }}</span>
                    </x-nav-link>

                    <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" class="focus:border-emerald-500 hover:border-emerald-300">
                        <span data-i18n="nav-transactions">Transaksi</span>
                    </x-nav-link>

                    <x-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.*')" class="focus:border-emerald-500 hover:border-emerald-300">
                        <span data-i18n="nav-inventory">Inventaris</span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown & Bahasa -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">

                <!-- MENU BAHASA (ID/EN) -->
                <div class="relative group cursor-pointer z-50">
                    <button class="flex items-center gap-1 px-2 py-2 text-sm font-medium text-gray-600 hover:text-emerald-600 transition">
                        <span id="current-lang">ID</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Bahasa -->
                    <div class="absolute right-0 mt-2 w-36 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-1">
                            <button onclick="changeLanguage('id')" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-emerald-600 transition">
                                <span>🇮🇩</span> Indonesia
                            </button>
                            <button onclick="changeLanguage('en')" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-emerald-600 transition">
                                <span>🇺🇸</span> English (US)
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-px h-5 bg-gray-300"></div>

                <!-- Profile Dropdown (Bawaan Breeze) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-emerald-600 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-emerald-50 hover:text-emerald-600">
                            <span data-i18n="nav-profile">{{ __('Profile') }}</span>
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-red-50 hover:text-red-600">
                                <span data-i18n="nav-logout">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile View) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200 bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span data-i18n="nav-dashboard">{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
                <span data-i18n="nav-transactions">Transaksi</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.*')">
                <span data-i18n="nav-inventory">Inventaris</span>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center justify-between">
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <!-- Choice Language Mobile -->
                <div class="flex gap-2 text-sm font-medium">
                    <button onclick="changeLanguage('id')" class="px-2 py-1 bg-gray-100 rounded hover:bg-emerald-100 hover:text-emerald-600 transition">ID</button>
                    <button onclick="changeLanguage('en')" class="px-2 py-1 bg-gray-100 rounded hover:bg-emerald-100 hover:text-emerald-600 transition">EN</button>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <span data-i18n="nav-profile">{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span data-i18n="nav-logout">{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>