<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex
            justify-between
            h-16
            dark:bg-gray-800
            border-b
        ">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/theater.png') }}" class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('show.index')" :active="request()->routeIs('show.index')">
                        {{ __('Spectacle') }}
                    </x-nav-link>
                    {{-- Guest Links --}}
                    {{-- Auth Links --}}
                    @auth
                        {{-- ajout d'artist dans la navigation --}}
                        <x-nav-link :href="route('artist.index')" :active="request()->routeIs('artist.index')">
                            {{ __('Artist') }}
                        </x-nav-link>
                        {{-- ajout de type dans la navigation --}}
                        <x-nav-link :href="route('type.index')" :active="request()->routeIs('type.index')">
                            {{ __('Type') }}
                        </x-nav-link>
                        <x-nav-link :href="route('locality.index')" :active="request()->routeIs('locality.index')">
                            {{ __('Locality') }}
                        </x-nav-link>
                        <x-nav-link :href="route('representation.index')" :active="request()->routeIs('representation.index')">
                            {{ __('Representation') }}
                        </x-nav-link>
                        <x-nav-link :href="route('show.index')" :active="request()->routeIs('show.index')">
                            {{ __('Spectacle') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>
            <!-- Feed -->
            <a href="/feed" class="inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none pointer-cursor">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 19.5v-.75a7.5 7.5 0 0 0-7.5-7.5H4.5m0-6.75h.75c7.87 0 14.25 6.38 14.25 14.25v.75M6 18.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </a>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    @if (Route::has('register'))
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endif
                @endguest

                <!-- Langue Dropdown -->
                <x-dropdown align="right" width="40">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->langue ?? 'fr' }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @foreach(['fr', 'en', 'nl'] as $lang)
                            @unless($lang === optional(Auth::user())->langue)
                                <x-dropdown-link :href="route('locale.set', ['lang' => $lang])">
                                    {{ __($lang) }}
                                </x-dropdown-link>
                            @endunless
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <!-- Authentication -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->login }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @if (Auth::user())
                                <x-dropdown-link :href="route('admin.index')">
                                    {{ __('Admin') }}
                                </x-dropdown-link>
                            @endif
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('show.index')" :active="request()->routeIs('show.index')">
                {{ __('Spectacle') }}
            </x-responsive-nav-link>
            @guest
                <x-responsive-nav-link :

href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            @endguest
            @auth
                <x-responsive-nav-link :href="route('artist.index')" :active="request()->routeIs('artist.index')">
                    {{ __('Artist') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('type.index')" :active="request()->routeIs('type.index')">
                    {{ __('Type') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('locality.index')" :active="request()->routeIs('locality.index')">
                    {{ __('Locality') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('representation.index')" :active="request()->routeIs('representation.index')">
                    {{ __('Representation') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('show.index')" :active="request()->routeIs('show.index')">
                    {{ __('Spectacle') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

            @endauth
        </div>
    </div>
</nav>

