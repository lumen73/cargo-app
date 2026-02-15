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
                <a class=" {{ request()->routeIs('inspections.edit') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('inspections.index') }}">inspection</a>
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
        <div class="min-h-screen w-full bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-8 space-y-6 animate-fadeIn">
                <h2 class="text-2xl font-bold text-indigo-600 text-center">
                    {{ isset($inspection) ? 'Modifier l\'inspection' : 'Ajouter une inspection' }}
                </h2>
                <form action="{{ isset($inspection) ? route('inspections.update', $inspection->idinspection) : route('inspections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if(isset($inspection))
                    @method('PUT')
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Cargaison -->
                        <div>
                            <label for="idcargaison" class="block text-sm font-medium text-gray-700">Cargaison</label>
                            <select name="idcargaison" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Sélectionnez une cargaison --</option>
                                @foreach($cargaison as $c)
                                <option value="{{ $c->idcargaison }}" @selected(old('idcargaison', $inspection->idcargaison ?? '') == $c->idcargaison)>{{ $c->nomcargaison }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Container -->
                        <div>
                            <label for="idcontainer" class="block text-sm font-medium text-gray-700">Container</label>
                            <select name="idcontainer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Sélectionnez un container --</option>
                                @foreach($container as $ct)
                                <option value="{{ $ct->idcontainer }}" @selected(old('idcontainer', $inspection->idcontainer ?? '') == $ct->idcontainer)>{{ $ct->numerocontainer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- État Inspection -->
                        <div class="sm:col-span-2">
                            <label for="etatinspection" class="block text-sm font-medium text-gray-700">État Inspection</label>
                            <select name="etatinspection" id="etatinspection" class="w-full border px-3 py-2 rounded" required>
                                <option value="">-- Choisir l'état --</option>
                                @foreach([' en attente inspection', 'stocké dans la zone A', 'prêt pour expédition'] as $etat)
                                <option value="{{ $etat }}" {{ old('etatinspection', $inspection->etatinspection ?? '') == $etat ? 'selected' : '' }}>
                                    {{ ucfirst($etat) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Rapport -->
                        <div class="sm:col-span-2">
                            <label for="rapport" class="block text-sm font-medium text-gray-700">Rapport</label>
                            <textarea name="rapport" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('rapport', $inspection->rapport ?? '') }}</textarea>
                        </div>
                        <!-- Date Inspection -->
                        <div>
                            <label for="dateinspection" class="block text-sm font-medium text-gray-700">Date Inspection</label>
                            <input type="date" name="dateinspection" value="{{ old('dateinspection', $inspection->dateinspection ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <!-- Photo -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                            <input type="file" name="photo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-white hover:bg-blue-700 transition">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>