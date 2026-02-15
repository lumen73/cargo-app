<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class=" {{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('cargaisons.index') }}">Cargaison</a>
                <a class=" {{ request()->routeIs('receptions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('receptions.index') }}">reception</a>
                <a class=" {{ request()->routeIs('containers.create') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('containers.index') }}">Container</a>
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
                <h2 class="text-2xl font-bold text-indigo-600 text-center">
                    {{ isset($container) ? 'Modifier le Container' : 'Ajouter un Container' }}
                </h2>

                <form action="{{ isset($container) ? route('containers.update', $container->idcontainer) : route('containers.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @if(isset($container))
                    @method('PUT')
                    @endif

                    @php
                    $data = isset($container) ? $container : (object) old();
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Numéro --}}
                        <div>
                            <label for="numerocontainer" class="block text-sm font-medium text-gray-700">Numéro</label>
                            <input type="text" name="numerocontainer" id="numerocontainer"
                                value="{{ old('numerocontainer', $data->numerocontainer ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        {{-- Taille --}}
                        <div>
                            <label for="taillecontainer" class="block text-sm font-medium text-gray-700">Taille</label>
                            <input type="text" name="taillecontainer" id="taillecontainer"
                                value="{{ old('taillecontainer', $data->taillecontainer ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        {{-- Type de cargaison --}}
                        <div>
                            <label for="typecargaison" class="block text-sm font-medium text-gray-700">Type de cargaison</label>
                            <select name="typecargaison" id="typecargaison" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('typecargaison') border-red-500 @enderror">
                                <option value="">-- Sélectionnez un type de container --</option>
                                @foreach(['uniforme', 'mixte', 'liquide','dangereux','réfrigerer'] as $type)
                                <option value="{{ $type }}" {{ old('typecargaison') == $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                                @endforeach
                            </select>
                            @error('typecargaison')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>




                        {{-- Pays origine --}}
                        <div>
                            <label for="paysorigine" class="block text-sm font-medium text-gray-700">Pays d'origine</label>
                            <input type="text" name="paysorigine" id="paysorigine"
                                value="{{ old('paysorigine', $data->paysorigine ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        {{-- Destination --}}
                        <div>
                            <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                            <input type="text" name="destination" id="destination"
                                value="{{ old('destination', $data->destination ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        {{-- Poids --}}
                        <div>
                            <label for="poidscontainer" class="block text-sm font-medium text-gray-700">Poids (kg)</label>
                            <input type="number" step="0.1" name="poidscontainer" id="poidscontainer"
                                value="{{ old('poidscontainer', $data->poidscontainer ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        {{-- Date d'arrivée --}}
                        <div>
                            <label for="datearrivee" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                            <input type="date" name="datearrivee" id="datearrivee"
                                value="{{ old('datearrivee', $data->datearrivee ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        {{-- État inspection --}}


                        <div>
                            <label for="etatinspection" class="block">État</label>
                            <select name="etatinspection" id="etatinspection" class="w-full border px-3 py-2 rounded" required>
                                <option value="">-- Choisir l'état --</option>
                                @foreach([' en attente inspection', 'stocké dans la zone A', 'prêt pour expédition'] as $etat)
                                <option value="{{ $etat }}" {{ old('etatinspection') == $etat ? 'selected' : '' }}>
                                    {{ ucfirst($etat) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sélection de cargaison --}}
                        <div>
                            <label for="idcargaison" class="block text-sm font-medium text-gray-700">Cargaison</label>
                            <select name="idcargaison" id="idcargaison" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">-- Sélectionnez une cargaison --</option>
                                @foreach($cargaison as $cargaison)
                                <option value="{{ $cargaison->idcargaison }}"
                                    {{ (old('idcargaison', $data->idcargaison ?? '') == $cargaison->idcargaison) ? 'selected' : '' }}>
                                    {{ $cargaison->nomcargaison }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Boutons --}}
                        <div class="text-center mt-6">
                            <button type="submit"
                                class="bg-indigo-700 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition" id="updateButton">
                                {{ isset($container) ? 'Mettre à jour' : 'Enregistrer' }}
                            </button>
                            <a href="{{ route('containers.index') }}"
                                class="font-semibold py-2 px-6 rounded-lg transition bg-red-700 text-white hover:bg-gray-600" id="cancelBtn">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cancelButton = document.getElementById('cancelBtn');
                const updateButton = document.getElementById('updateButton');

                // Confirmation for Annuler button
                cancelButton.addEventListener('click', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir annuler ?')) {
                        e.preventDefault();
                    }
                });

                // Confirmation for Update button
                updateButton.addEventListener('click', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir enregistrer ce container ?')) {
                        e.preventDefault();
                    }
                });
            });
        </script>
</x-app-layout>