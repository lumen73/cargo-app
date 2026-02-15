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

        <div class="min-h-screen w-full bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl w-4/5 mx-auto">
                <div class="flex px-4 py-4 justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-indigo-600">Liste des Cargaisons</h1>
                    <a href="{{ route('cargaisons.create') }}"
                        class="bg-indigo-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                        + Nouvelle cargaison
                    </a>
                </div>
                <div class=" flex  justify-center  items-center mb-6">
                    <div class="container ">
                        <div class=" flex justify-end">
                            <input type="text" id="searchInput" placeholder="Rechercher..." class="px-4 py-2 border rounded shadow w-2/3 focus:outline-none focus:ring focus:border-blue-300">
                        </div>

                    </div>
                    <div class="container">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-green-700  text-white font-bold py-2 px-4 rounded">
                            Rechercher
                        </button>
                    </div>

                </div>
                @if (session('success'))
                <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4 shadow-sm">
                    {{ session('success') }}
                </div>
                @endif

                <div class="overflow-x-auto w-full bg-white shadow rounded-2xl">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left" id="cargaisonsTable">
                        <thead class="bg-cyan-500 text-white text-center text-sm font-semibold">
                            <tr>
                                <th class="px-6 py-3">Nom</th>
                                <th class="px-6 py-3">Gestionnaire</th>
                                <th class="px-6 py-3">Nature</th>
                                <th class="px-6 py-3">Valeur</th>
                                <th class="px-6 py-3">État</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white text-center">
                            @foreach($cargaison as $cargaison)
                            <tr class="hover:bg-gray-200 transition">
                                <td class="px-6 py-4">{{ $cargaison->nomcargaison }}</td>
                                <td class="px-6 py-4">{{ $cargaison->gestionnaire->name ?? '—' }}</td>
                                <td class="px-6 py-4">{{ $cargaison->naturemarchandise }}</td>
                                <td class="px-6 py-4">{{ number_format($cargaison->valeurcargaison, 2, ',', ' ') }} FCFA</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                        @if($cargaison->etatcargaison == 'dechargement') bg-yellow-200 text-yellow-800
                                        @elseif($cargaison->etatcargaison == 'transit') bg-blue-200 text-blue-800
                                        @else bg-green-200 text-green-800
                                        @endif">
                                        {{ ucfirst($cargaison->etatcargaison) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2 justify-center whitespace-nowrap">
                                    <a href="{{ route('cargaisons.show', $cargaison) }}"
                                        class="bg-blue-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                        Voir
                                    </a>
                                    <a href="{{ route('cargaisons.edit', $cargaison) }}"
                                        class="bg-orange-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                        Modifier
                                    </a>
                                    <form action="{{ route('cargaisons.destroy', $cargaison) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded text-xs">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
            const table = document.getElementById('cargaisonsTable').getElementsByTagName('tbody')[0];

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