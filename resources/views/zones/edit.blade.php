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
                <a class="{{ request()->routeIs('zones.edit') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('zones.index') }}">Zone</a>
                <a class="{{ request()->routeIs('moyens.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center" href="{{ route('moyens.index') }}">Moyen</a>
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

            .swal-popup {
                background-color: #f9fafb;
                border-radius: 10px;
                padding: 2em;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            }

            .swal-title {
                font-size: 1.5rem;
                font-weight: 600;
                color: #4b5563;
            }

            .swal-confirm-button,
            .swal-cancel-button {
                color: white !important;
                border-radius: 8px;
                padding: 0.75em 2em;
                transition: all 0.3s ease;
            }

            .swal-confirm-button {
                background-color: #22c55e !important;
            }

            .swal-confirm-button:hover {
                background-color: #16a34a !important;
                transform: scale(1.05);
            }

            .swal-cancel-button {
                background-color: #ef4444 !important;
            }

            .swal-cancel-button:hover {
                background-color: #dc2626 !important;
                transform: scale(1.05);
            }
        </style>

        <div class="min-h-screen w-full bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-8 space-y-6 animate-fadeIn">
                <h2 class="text-2xl font-bold text-indigo-600 text-center">
                    {{ isset($zone) ? 'Modifier une Zone' : 'Ajouter une Zone' }}
                </h2>

                <form id="zoneForm" action="{{ isset($zone) ? route('zones.update', $zone->idzone) : route('zones.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @if(isset($zone))
                    @method('PUT')
                    @endif

                    @php
                    $data = isset($zone) ? $zone : (object) old();
                    @endphp

                    <div>
                        <label for="idcontainer" class="block text-sm font-medium text-gray-700">Sélectionner un Container</label>
                        <select name="idcontainer" id="idcontainer" class="w-full border px-3 py-2 rounded" required>
                            <option value="">-- Choisir --</option>
                            @foreach($container as $g)
                            <option value="{{ $g->idcontainer }}" {{ old('idcontainer', $zone->idcontainer ?? '') == $g->idcontainer ? 'selected' : '' }}>
                                {{ $g->numerocontainer }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="zonestockage" class="block text-sm font-medium text-gray-700">Zone de Stockage</label>
                        <select name="zonestockage" id="zonestockage" class="w-full border px-3 py-2 rounded" required>
                            <option value="">-- Choisir l'état --</option>
                            @foreach(['déchargement', 'Stockage temporaire', 'expédition'] as $etat)
                            <option value="{{ $etat }}" {{ old('zonestockage', $zone->zonestockage ?? '') == $etat ? 'selected' : '' }}>
                                {{ ucfirst($etat) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="datestockage" class="block text-sm font-medium text-gray-700">Date de Stockage</label>
                        <input type="date" name="datestockage" id="datestockage" value="{{ old('datestockage', $data->datestockage ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="heurestockage" class="block text-sm font-medium text-gray-700">Heure de Stockage</label>
                        <input type="time" name="heurestockage" id="heurestockage" value="{{ old('heurestockage', $data->heurestockage ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="text-center mt-6 flex justify-center gap-4">
                        <button type="button" id="btnSave" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition transform hover:scale-105">Enregistrer</button>
                        <a href="#" id="btnCancel" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition transform hover:scale-105">Annuler</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- SweetAlert CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.getElementById('btnSave').addEventListener('click', function() {
                Swal.fire({
                    title: 'Confirmer l\'enregistrement',
                    text: "Voulez-vous vraiment enregistrer cette zone ?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#22c55e',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Oui, enregistrer',
                    cancelButtonText: 'Annuler',
                    customClass: {
                        popup: 'swal-popup',
                        title: 'swal-title',
                        confirmButton: 'swal-confirm-button',
                        cancelButton: 'swal-cancel-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('zoneForm').submit();
                    }
                });
            });

            document.getElementById('btnCancel').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Annuler la modification',
                    text: "Voulez-vous vraiment annuler cette modification ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Oui, annuler',
                    cancelButtonText: 'Rester sur la page',
                    customClass: {
                        popup: 'swal-popup',
                        title: 'swal-title',
                        confirmButton: 'swal-confirm-button',
                        cancelButton: 'swal-cancel-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('zones.index') }}";
                    }
                });
            });
        </script>
    </div>
</x-app-layout>