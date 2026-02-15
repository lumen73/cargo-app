<nav x-data="{ open: false }" class="bg-blue-600 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center ">
                    <x-nav-link
                        :href="route('landing')"
                        :active="request()->routeIs('landing')"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150  ">
                        {{ __('Accueil') }}
                    </x-nav-link>
                </div>


                @if(request()->routeIs('landing'))
                <!-- Ces liens ne s'affichent que sur la page landing -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center {{ request()->routeIs('landing') }}#service ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    <x-nav-link
                        href="{{ route('landing') }}#service"
                        class="  inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Nos Services') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center {{ request()->routeIs('landing') }}#about ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    <x-nav-link
                        href="{{ route('landing') }}#about"
                        class="   inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('A propos') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center {{ request()->routeIs('landing') }}#contact ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} ">
                    <x-nav-link
                        href="{{ route('landing') }}#contact"
                        class="  inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Contactez-nous') }}
                    </x-nav-link>
                </div>
                @auth
                @if (in_array(Auth::user()->role, ['admin']))
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center {{ request()->routeIs('cargaisons.index') }} ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} ">
                    <x-nav-link
                        href="{{ route('cargaisons.index') }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Gestionnaire') }}
                    </x-nav-link>
                </div>
                <div class=" {{ request()->routeIs('admin.dashboard') }} ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center ">
                    <x-nav-link
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Admin') }}
                    </x-nav-link>
                </div>

                @elseif (in_array(Auth::user()->role, ['gestionnaire']))
                <div class=" {{ request()->routeIs('cargaisons.index') }} ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link
                        href="{{ route('cargaisons.index') }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Gestionnaire') }}
                    </x-nav-link>
                </div>
                @endif

                @endauth
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <!-- Votre bouton déclencheur ici -->
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                @auth
                                {{ Auth::user()->name }}
                                @else
                                Invité
                                @endauth
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Votre contenu de dropdown ici -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>