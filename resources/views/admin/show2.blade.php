<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">

            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>

            <nav class="flex flex-col gap-4 px-4">

                <a href="{{ route('admin.dashboard') }}"
                    class="text-xl text-white text-center px-4 py-2 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-400 font-bold' : 'hover:bg-yellow-400' }}">
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
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-transition.opacity>
        </div>
        <div class="flex-1 flex flex-col w-full ml-0 md:ml-64">

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

            <main class="p-6">
                <div class="flex justify-center mb-6">
                    <h1 class="text-3xl font-bold text-center w-full"> Enregistrer un Gestionnaire</h1>
                </div>

                @if ($message = Session::get('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ $message }}
                </div>
                @endif

                <div class="overflow-x-auto flex justify-center">
                    <table class="w-2/3 table-auto border-collapse border border-green-500">
                        <thead class="bg-blue-600">
                            <tr>
                                <th class="border text-white px-4 py-4">No</th>
                                <th class="border text-white px-4 py-4">Nom</th>
                                <th class="border text-white px-4 py-4">Email</th>
                                <th class="border text-white px-4 py-4">Rôle</th>
                                <th class="border text-white px-4 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            @if ($user->id !== auth()->user()->id)
                            <tr class="text-center">
                                <td class="border px-4 py-4">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-4">{{ $user->name }}</td>
                                <td class="border px-4 py-4">{{ $user->email }}</td>
                                <td class="border px-4 py-4">
                                    @php
                                    $roleColors = [
                                    'admin' => 'bg-red-400 text-black-800',
                                    'gestionnaire' => 'bg-yellow-400 text-black-800',
                                    'utilisateur' => 'bg-green-400 text-black-800',
                                    ];
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $roleColors[$user->role] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>


                                <td class="flex py-3">
                                    @if (!in_array($user->id, $gestionnaireIds))
                                    <a style="margin-left: 10px" href="{{ route('admin.show', $user->id) }}"
                                        class="bg-green-600 hover:bg-gray-600 text-white px-4 py-2 rounded-lg border border-green-500 hover:border-green-600">
                                        enregistrer
                                    </a>
                                    @else
                                    <span class="text-gray-500 ml-4 italic">Déjà enregistré</span>
                                    @endif
                                </td>


                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


</x-app-layout>