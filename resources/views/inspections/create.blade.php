<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class="{{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('cargaisons.index') }}">Cargaison</a>
                <a class="{{ request()->routeIs('receptions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('receptions.index') }}">Reception</a>
                <a class="{{ request()->routeIs('containers.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('containers.index') }}">Container</a>
                <a class="{{ request()->routeIs('inspections.create') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('inspections.index') }}">Inspection</a>
                <a class="{{ request()->routeIs('zones.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('zones.index') }}">Zone</a>
                <a class="{{ request()->routeIs('moyens.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('moyens.index') }}">Moyen</a>
                <a class="{{ request()->routeIs('expeditions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('expeditions.index') }}">Expeditions</a>
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
                    {{ isset($inspection) ? 'Modifier l\'inspection' : 'Ajouter une inspection' }}
                </h2>

                <form action="{{ isset($inspection) ? route('inspections.update', $inspection->idinspection) : route('inspections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @if(isset($inspection)) @method('PUT') @endif

                    @php
                    $data = isset($inspection) ? $inspection : (object) old();
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Cargaison --}}
                        <div>
                            <label for="idcargaison" class="block text-sm font-medium text-gray-700">Cargaison</label>
                            <select name="idcargaison" id="idcargaison" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">-- Sélectionnez une cargaison --</option>
                                @foreach($cargaison as $c)
                                <option value="{{ $c->idcargaison }}" @selected(old('idcargaison', $data->idcargaison ?? '') == $c->idcargaison)>
                                    {{ $c->nomcargaison }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Container --}}
                        <div>
                            <label for="idcontainer" class="block text-sm font-medium text-gray-700">Container</label>
                            <select name="idcontainer" id="idcontainer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">-- Sélectionnez un container --</option>
                                @foreach($container as $ct)
                                <option value="{{ $ct->idcontainer }}" @selected(old('idcontainer', $data->idcontainer ?? '') == $ct->idcontainer)>
                                    {{ $ct->numerocontainer }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- État inspection --}}
                        <div class="sm:col-span-2">
                            <label for="etatinspection" class="block text-sm font-medium text-gray-700">État Inspection</label>
                            <select name="etatinspection" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('etatinspection') border-red-500 @enderror">
                                <option value="">-- Sélectionnez un état --</option>
                                @foreach(['conforme', 'non conforme', "en attente d'inspection"] as $etat)
                                <option value="{{ $etat }}" {{ old('etatinspection') == $etat ? 'selected' : '' }}>
                                    {{ ucfirst($etat) }}
                                </option>
                                @endforeach
                            </select>
                            @error('etatinspection')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Rapport --}}
                        <div class="sm:col-span-2">
                            <label for="rapport" class="block text-sm font-medium text-gray-700">Rapport</label>
                            <textarea name="rapport" id="rapport" rows="3" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('rapport', $data->rapport ?? '') }}</textarea>
                        </div>

                        {{-- Date --}}
                        <div>
                            <label for="dateinspection" class="block text-sm font-medium text-gray-700">Date Inspection</label>
                            <input type="date" name="dateinspection" id="dateinspection"
                                value="{{ old('dateinspection', $data->dateinspection ?? '') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        {{-- Photo --}}
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                            <input type="file" name="photo" id="photo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-white hover:bg-indigo-700 transition">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>