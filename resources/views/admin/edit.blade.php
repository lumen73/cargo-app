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

            <!-- Main content -->
            <main class="p-6 flex flex-col items-center justify-start">
                <div class="w-full max-w-xl">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="text-center mb-6">
                        <h1 class="text-2xl font-bold mb-2">Modifier les utilisateurs</h1>
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 text-lg underline">← Retour</a>
                    </div>

                    <!-- Affichage des erreurs -->
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <strong>Erreur !</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Formulaire de modification -->
                    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-6 bg-gray-300 p-6 rounded shadow-md">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-medium">Nom :</label>
                            <x-text-input type="text" name="name" value="{{ old('name', $user->name) }}" class="block mt-1 w-full text-center text-lg" />
                        </div>

                        <div>
                            <label class="block font-medium">Email :</label>
                            <x-text-input type="email" name="email" value="{{ old('email', $user->email) }}" class="block mt-1 w-full text-center text-lg" />
                        </div>

                        <div>
                            <label class="block font-medium">Rôle :</label>
                            <select name="role" class="form-control w-full text-center text-lg mt-1"
                                {{ auth()->user()->role === 'admin' && auth()->user()->id === $user->id ? 'disabled' : '' }}>
                                @foreach (App\Models\User::getRoles() as $role)
                                <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                                @endforeach
                            </select>
                            @if(auth()->user()->role === 'admin' && auth()->user()->id === $user->id)
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 text-lg">
                                Valider
                            </button>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>

    <script>
        function confirmUpdate() {
            return confirm('Confirmer la modification de cet utilisateur ?');
        }
    </script>
</x-app-layout>