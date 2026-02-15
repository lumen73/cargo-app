<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class=" {{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('cargaisons.index') }}">Cargaison</a>
                <a class=" {{ request()->routeIs('receptions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('receptions.index') }}">reception</a>
                <a class=" {{ request()->routeIs('containers.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('containers.index') }}">Container</a>
                <a class=" {{ request()->routeIs('inspections.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('inspections.index') }}">inspection</a>
                <a class=" {{ request()->routeIs('zones.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('zones.index') }}">Zone</a>
                <a class=" {{ request()->routeIs('moyens.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('moyens.index') }}">Moyen</a>
                <a class=" {{ request()->routeIs('expeditions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('expeditions.index') }}">expeditions</a>
            </nav>
        </aside>
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-transition.opacity>
        </div>

        <!-- CONTENU PRINCIPAL -->
        <div class="flex-1 overflow-y-auto p-4 ml-0 md:ml-64 bg-gray-100">
            <!-- BOUTON MOBILE -->
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden mb-4 p-2 text-white bg-blue-600 rounded">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="min-h-screen w-full bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl w-4/5 mx-auto">
                    <!-- TITRE -->
                    <h1 class="text-2xl font-bold text-indigo-600 mb-6">Liste des Expéditions</h1>



                    <!-- TITRE + BOUTON AJOUT -->
                    <div class=" flex justify-between items-center mb-6">
                        <!-- FORMULAIRE DE RECHERCHE -->
                        <div class=" flex  justify-center  items-center mb-6">
                            <div class="container ">
                                <div class=" flex justify-end">
                                    <input type="text" id="searchInput" placeholder="Rechercher..." class="px-4 py-2 border rounded shadow w-full focus:outline-none focus:ring focus:border-blue-300">
                                </div>

                            </div>
                            <div class="container">
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-green-700  text-white font-bold py-2 px-4 rounded">
                                    Rechercher
                                </button>
                            </div>

                        </div>

                        <a href="{{ route('expeditions.create') }}"
                            class="bg-indigo-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                            + Nouvelle Expédition
                        </a>
                    </div>

                    <!-- TABLEAU -->
                    <div class="overflow-x-auto bg-white shadow rounded-2xl">
                        <table class="min-w-full divide-y divide-gray-200 text-sm text-left" id="expeditionsTable">
                            <thead class="bg-cyan-500 text-white text-center text-sm font-semibold">
                                <tr>
                                    <th class="px-4 py-2">N°</th>
                                    <th class="px-4 py-2">Moyen</th>
                                    <th class="px-4 py-2">Gestionnaire</th>
                                    <th class="px-4 py-2">Container</th>
                                    <th class="px-4 py-2">Date Départ</th>
                                    <th class="px-4 py-2">Destination</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @forelse ($expeditions as $index => $expedition)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-blue-50' }} hover:bg-gray-200 transition">
                                    <td class="px-4 py-2">{{ $expedition->idexpeditions }}</td>
                                    <td class="px-4 py-2">{{ $expedition->moyen->prenomschauffeur ?? '' }}</td>
                                    <td class="px-4 py-2">{{ $expedition->gestionnaire->name ?? '' }}</td>
                                    <td class="px-4 py-2">{{ $expedition->container->numerocontainer ?? '' }}</td>
                                    <td class="px-4 py-2">{{ $expedition->datedepart }}</td>
                                    <td class="px-4 py-2">{{ $expedition->destination }}</td>
                                    <td class="px-4 py-2 flex gap-2 justify-center">
                                        <a href="{{ route('expeditions.edit', $expedition) }}"
                                            class="bg-orange-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                            Modifier
                                        </a>
                                        <form action="{{ route('expeditions.destroy', $expedition) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded text-xs">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 py-4">Aucune expédition trouvée.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="mt-6">
                        {{ $expeditions->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- SWEETALERT DELETE -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Êtes-vous sûr ?',
                        text: "Cette action est irréversible !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Oui, supprimer !',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('expeditionsTable').getElementsByTagName('tbody')[0];

            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                const rows = table.getElementsByTagName('tr');
                Array.from(rows).forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });
            });
        </script>
    </div>
</x-app-layout>