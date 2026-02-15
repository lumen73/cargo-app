<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class=" {{ request()->routeIs('cargaisons.create') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('cargaisons.index') }}">Cargaison</a>
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
            <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-8 space-y-6 animate-fadeIn">
                <h2 class="text-2xl font-bold text-indigo-600 text-center">Ajouter une nouvelle cargaison</h2>

                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('cargaisons.store') }}" method="POST" class="space-y-4" onsubmit="return confirmCreate()">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nomcargaison" class="block text-sm font-medium text-gray-700">Nom Cargaison</label>
                            <input type="text" name="nomcargaison" id="nomcargaison" value="{{ old('nomcargaison') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="idgestionnaire" class="block text-sm font-medium text-gray-700">Gestionnaire</label>
                            <select name="idgestionnaire" id="idgestionnaire" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Choisir --</option>
                                @foreach($gestionnaire as $gestion)
                                <option value="{{ $gestion->idgestionnaire }}" {{ old('idgestionnaire') == $gestion->idgestionnaire ? 'selected' : '' }}>
                                    {{ $gestion->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="naturemarchandise" class="block text-sm font-medium text-gray-700">Nature de la marchandise</label>
                            <input type="text" name="naturemarchandise" id="naturemarchandise" value="{{ old('naturemarchandise') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="volumemarchandise" class="block text-sm font-medium text-gray-700">Volume (m³)</label>
                            <input type="number" step="0.01" name="volumemarchandise" id="volumemarchandise" value="{{ old('volumemarchandise') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="poidscargaison" class="block text-sm font-medium text-gray-700">Poids (kg)</label>
                            <input type="number" step="0.01" name="poidscargaison" id="poidscargaison" value="{{ old('poidscargaison') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="valeurcargaison" class="block text-sm font-medium text-gray-700">Valeur (FCFA)</label>
                            <input type="number" step="0.001" name="valeurcargaison" id="valeurcargaison" value="{{ old('valeurcargaison') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="etatcargaison" class="block text-sm font-medium text-gray-700">État</label>
                            <select name="etatcargaison" id="etatcargaison" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Choisir l'état --</option>
                                @foreach(['dechargement', 'transit', 'charge'] as $etat)
                                <option value="{{ $etat }}" {{ old('etatcargaison') == $etat ? 'selected' : '' }}>
                                    {{ ucfirst($etat) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition duration-200 shadow">
                            Enregistrer
                        </button>
                        <a href="{{ route('cargaisons.index') }}" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition duration-200 shadow ml-4">
                            Annuler
                        </a>
                    </div>
                </form>
                <script>
                    function confirmCreate() {
                        return confirm("Êtes-vous sûr de vouloir ajouter cette cargaison ?");
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>