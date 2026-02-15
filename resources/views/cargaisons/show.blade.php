<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class=" {{ request()->routeIs('cargaisons.show') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('cargaisons.index') }}">Cargaison</a>
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
            <div class="max-w-3xl w-full bg-white shadow-xl rounded-2xl p-8 space-y-6 animate-fadeIn">
                <h2 class="text-2xl font-bold text-indigo-600 text-center">Détails de la Cargaison</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <span class="font-semibold">Nom de la cargaison :</span>
                        <p class="text-black-900">{{ $cargaison->nomcargaison }}</p>
                    </div>

                    <div>
                        <span class="font-semibold">Gestionnaire :</span>
                        <p class="text-black-900">{{ $cargaison->gestionnaire->name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <span class="font-semibold">Nature de la marchandise :</span>
                        <p class="text-black-900">{{ $cargaison->naturemarchandise }}</p>
                    </div>

                    <div>
                        <span class="font-semibold">Volume :</span>
                        <p class="text-black-900">{{ $cargaison->volumemarchandise }} m³</p>
                    </div>

                    <div>
                        <span class="font-semibold">Poids :</span>
                        <p class="text-black-900">{{ $cargaison->poidscargaison }} kg</p>
                    </div>

                    <div>
                        <span class="font-semibold">Valeur :</span>
                        <p class="text-black-900">{{ $cargaison->valeurcargaison }} FCFA</p>
                    </div>

                    <div>
                        <span class="font-semibold">État :</span>
                        <p class="text-black-900 capitalize">{{ $cargaison->etatcargaison }}</p>
                    </div>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('cargaisons.index') }}" class="inline-block bg-indigo-700 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
</x-app-layout>