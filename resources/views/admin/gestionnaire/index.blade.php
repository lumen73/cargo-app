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


        <!-- Overlay -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-transition.opacity>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col w-full ml-0 md:ml-64 ">


            <!-- Header mobile -->
            <header class="flex items-center justify-between p-4 bg-blue-600 border-b shadow md:hidden">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <span class="text-xl font-bold">Dashboard</span>
            </header>

            <!-- Main content -->
            <main class="p-6 flex flex-col items-center justify-start">
                <div class="w-full mx-auto">
                    <div class="flex justify-center mb-6">
                        <h1 class="text-3xl font-bold text-center w-full">Liste des gestionnaires</h1>
                    </div>

                    @if($gestionnaire->isEmpty())
                    <p class="text-gray-600 text-center mt-4">Aucun gestionnaire trouvé.</p>
                    @else
                    <div class="overflow-x-auto flex justify-center">
                        <table class="w-2/3 table-auto border-collapse border border-green-500">
                            <thead class="bg-green-600">
                                <tr>
                                    <th class="border  text-white border-gray-600 px-4 py-2">Nom</th>
                                    <th class="border  text-white border-gray-600 px-4 py-2">Email</th>
                                    <th class="border  text-white border-gray-600 px-4 py-2">Date de création</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gestionnaire as $user)
                                <tr class="text-center {{ $loop->iteration % 2 == 0 ? 'bg-gray-200' : 'bg-blue-200' }}">
                                    <td class="border border-gray-600 px-4 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-600 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-600 px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </main>

        </div>
    </div>
</x-app-layout>