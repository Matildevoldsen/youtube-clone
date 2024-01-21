<div>
    <nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a wire:navigate class="font-mono text-2xl" href="{{ route('dashboard') }}">
                            {{ config('app.name') }}
                        </a>
                    </div>

                </div>

                @guest
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @endguest

                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        @auth
                            <x-button label="Upload Video" @click="$wire.dispatch('toggleModal')" class="btn-primary"/>
                        @endguest
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown>
                                <x-slot:trigger>
                                    <div class="flex items-center ml-5">
                                        <span class="mr-2">{{ auth()->user()->name }}</span>
                                        <img src="{{ auth()->user()->profile_photo_url }}" class="rounded-full w-12"/>
                                    </div>
                                </x-slot:trigger>

                                <x-menu-item icon="fas.cog" title="Account Settings"
                                             link="{{ route('profile.show') }}"/>


                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-menu-item icon="fas.arrow-right-to-bracket" link="{{ route('logout') }}"
                                                 title="Logout"
                                                 @click.prevent="$root.submit();">
                                    </x-menu-item>
                                </form>
                            </x-dropdown>
                        </div>
                    </div>
                @endauth

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <aside aria-label="Sidebar"
           class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('home') }}"
                       wire:navigate
                       {{ request()->routeIs('home') ? 'aria-current="page"' : '' }}
                       class="{{ request()->routeIs('home') ? 'bg-gray-900 text-white hover:bg-gray-700' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <x-icon name="fas.home"/>
                        <span class="flex-1 ms-3 whitespace-nowrap">
                            Home
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <livewire:upload-video wire:key="upload-video" />
</div>
