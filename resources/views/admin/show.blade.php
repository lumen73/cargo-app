<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">

            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>

            <nav class="flex flex-col gap-4 px-4">

                <a href="{{ route('admin.dashboard') }}"
                    class="text-xl text-white text-center px-4 py-2 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    Liste Utilisateurs
                </a>


                <a href="{{ route('admin.gestionnaire.index') }}"
                    class="text-xl text-white text-center px-4 py-2 rounded-lg transition duration-200 {{ request()->routeIs('admin.gestionnaire.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    Liste Gestionnaires
                </a>


                <a href="{{ route('landing') }}"
                    class="text-xl text-white text-center px-4 py-2 rounded-lg transition duration-200 {{ request()->routeIs('landing') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    Espace Utilisateur
                </a>


                <a href="{{ route('cargaisons.index') }}"
                    class="text-xl text-white text-center px-4 py-2 rounded-lg transition duration-200 {{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    Espace Gestionnaire
                </a>

                <a href="{{ route('admin.show2') }}"
                    class="text-xl text-white text-center px-4 py-2 rounded-lg transition duration-200 {{ request()->routeIs('admin.show2') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }}">
                    Enregistrer Gestionnaire
                </a>

            </nav>
        </aside>

        <!-- Overlay mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden" x-transition.opacity></div>

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col w-full ml-0 md:ml-64">

            <!-- Header mobile -->
            <header class="flex items-center justify-between p-4 bg-blue-600 border-b shadow md:hidden">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-xl font-bold text-white">Dashboard</span>
            </header>

            <!-- Main content avec ancien style -->
            <main class="p-6 flex flex-col items-center justify-start">
                <div class="w-full max-w-xl ">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h1 style="text-align: center; font-size:xx-large">Enregistrer</h1>
                            </div>
                            <div class="pull-right text-lg">
                                <a style="text-align: center; color: blue" class="" href="{{ route('admin.dashboard') }}">retour</a>
                            </div>
                        </div>
                    </div>


                    <form class="flex justify-center ;  bg-gray-300 p-8" action="{{ route('gestionnaire.store') }}" method="POST">
                        @csrf

                        <div class="">
                            <div>
                                <strong class="block mt-1 hidden w-full">Id</strong>
                                <x-text-input name="idusers" class=" hidden block mt-1 w-full" value="{{ $user->id }}" />
                            </div>

                            <div>
                                <strong class="block text-2xl mt-1">Nom</strong>
                                <x-text-input name="name" class="block text-xl mt-1 w-full text-center" value="{{ $user->name }}" />
                            </div>

                            <div>
                                <strong class="block text-2xl mt-1 w-full">Email</strong>
                                <x-text-input name="email" class="block text-xl mt-1 w-full text-center" value="{{ $user->email }}" />
                            </div>

                            <div>
                                <strong class="block text-2xl mt-1 w-full">Rôle</strong>
                                <x-text-input name="role" class="block text-xl mt-1 w-full text-center" value="{{ $user->role }}" />
                            </div>

                            <div class="mt-4">
                                <x-primary-button class="ml-4 hover:bg-green-600">
                                    {{ __('Enregistrer') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-app-layout>