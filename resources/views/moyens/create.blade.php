<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class="{{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('cargaisons.index') }}">Cargaison</a>
                <a class="{{ request()->routeIs('receptions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('receptions.index') }}">Réception</a>
                <a class="{{ request()->routeIs('containers.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('containers.index') }}">Container</a>
                <a class="{{ request()->routeIs('inspections.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('inspections.index') }}">Inspection</a>
                <a class="{{ request()->routeIs('zones.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('zones.index') }}">Zone</a>
                <a class="{{ request()->routeIs('moyens.create') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('moyens.index') }}">Moyen</a>
                <a class="{{ request()->routeIs('expeditions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('expeditions.index') }}">Expéditions</a>
            </nav>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden" x-transition.opacity></div>

        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fadeIn {
                animation: fadeIn 0.75s ease-out forwards;
            }
        </style>

        <div class="min-h-screen w-full bg-gray-100 flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-8 space-y-6 animate-fadeIn">
                <h2 class="text-2xl font-bold text-indigo-600 text-center">
                    Ajouter un Moyen
                </h2>

                <form id="createForm" action="{{ route('moyens.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @include('moyens.form')

                    <div class="text-center mt-6">
                        <button type="button"
                            class="bg-indigo-700 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                            onclick="confirmerEnregistrement()">Enregistrer</button>

                        <a href="{{ route('moyens.index') }}"
                            class="font-semibold py-2 px-6 rounded-lg transition bg-red-700 text-white hover:bg-gray-600"
                            id="cancelBtn">Annuler</a>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function confirmerEnregistrement() {
                if (confirm("Voulez-vous enregistrer ce moyen ?")) {
                    document.getElementById('createForm').submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const cancelBtn = document.getElementById('cancelBtn');
                cancelBtn.addEventListener('click', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir annuler ?')) {
                        e.preventDefault();
                    }
                });
            });
        </script>
</x-app-layout>