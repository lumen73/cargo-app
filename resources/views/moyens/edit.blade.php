<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4 px-4">
                <a href="{{ route('cargaisons.index') }}" class="{{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Cargaison
                </a>
                <a href="{{ route('receptions.index') }}" class="{{ request()->routeIs('receptions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Réception
                </a>
                <a href="{{ route('containers.index') }}" class="{{ request()->routeIs('containers.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Container
                </a>
                <a href="{{ route('inspections.index') }}" class="{{ request()->routeIs('inspections.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Inspection
                </a>
                <a href="{{ route('zones.index') }}" class="{{ request()->routeIs('zones.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Zone
                </a>
                <a href="{{ route('moyens.index') }}" class="{{ request()->routeIs('moyens.edit') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Moyen
                </a>
                <a href="{{ route('expeditions.index') }}" class="{{ request()->routeIs('expeditions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Expéditions
                </a>
            </nav>
        </aside>

        <!-- Overlay for mobile -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-transition.opacity>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-2xl mx-auto py-10">
                <h1 class="text-2xl font-bold mb-6 text-center">Modifier un Moyen</h1>

                <form id="updateForm" action="{{ route('moyens.update', $moyen) }}" method="POST" class="space-y-6 bg-white shadow p-6 rounded-lg">
                    @csrf
                    @method('PUT')

                    @include('moyens.form')

                    <div class="flex justify-center gap-4">
                        <button type="button" onclick="confirmerModification()" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                            Mettre à jour
                        </button>

                        <button type="button" onclick="confirmerAnnulation()" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 transition">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function confirmerModification() {
            if (confirm("Voulez-vous vraiment enregistrer les modifications ?")) {
                document.getElementById('updateForm').submit();
            }
        }

        function confirmerAnnulation() {
            if (confirm('Êtes-vous sûr de vouloir annuler les modifications ?')) {
                window.location.href = "{{ route('moyens.index') }}";
            }
        }
    </script>
</x-app-layout>