<div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-8 space-y-6 animate-fadeIn">
    <h2 class="text-2xl font-bold text-indigo-600 text-center">
        {{ isset($reception) ? 'Modifier la Réception' : 'Ajouter une Réception' }}
    </h2>

    @php
    $data = isset($reception) ? $reception : (object) old();
    @endphp

    <form id="receptionForm" action="{{ isset($reception) ? route('receptions.update', $reception->idreception) : route('receptions.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($reception))
        @method('PUT')
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Gestionnaire -->
            <div>
                <label for="idgestionnaire" class="block text-sm font-medium text-gray-700">Gestionnaire</label>
                <select name="idgestionnaire" id="idgestionnaire" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('idgestionnaire') border-red-500 @enderror">
                    <option value="">-- Sélectionnez --</option>
                    @foreach ($gestionnaire as $g)
                    <option value="{{ $g->idgestionnaire }}" {{ (old('idgestionnaire', $data->idgestionnaire ?? '') == $g->idgestionnaire) ? 'selected' : '' }}>
                        {{ $g->name }}
                    </option>
                    @endforeach
                </select>
                @error('idgestionnaire')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cargaison -->
            <div>
                <label for="idcargaison" class="block text-sm font-medium text-gray-700">Cargaison</label>
                <select name="idcargaison" id="idcargaison" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('idcargaison') border-red-500 @enderror">
                    <option value="">-- Sélectionnez --</option>
                    @foreach ($cargaison as $c)
                    <option value="{{ $c->idcargaison }}" {{ (old('idcargaison', $data->idcargaison ?? '') == $c->idcargaison) ? 'selected' : '' }}>
                        {{ $c->nomcargaison }}
                    </option>
                    @endforeach
                </select>
                @error('idcargaison')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date d'arrivée -->
            <div>
                <label for="datearrivee" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                <input type="date" name="datearrivee" id="datearrivee" required
                    value="{{ old('datearrivee', $data->datearrivee ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('datearrivee') border-red-500 @enderror">
                @error('datearrivee')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre de Containers -->
            <div>
                <label for="nombrecontainer" class="block text-sm font-medium text-gray-700">Nombre de Containers</label>
                <input type="number" name="nombrecontainer" id="nombrecontainer" required
                    value="{{ old('nombrecontainer', $data->nombrecontainer ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nombrecontainer') border-red-500 @enderror">
                @error('nombrecontainer')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lieu de Réception -->
            <div class="sm:col-span-2">
                <label for="lieudereception" class="block text-sm font-medium text-gray-700">Lieu de Réception</label>
                <select name="lieudereception" id="lieudereception" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('lieudereception') border-red-500 @enderror">
                    <option value="">-- Sélectionnez un quai --</option>
                    @for ($i = 1; $i <= 11; $i++)
                        @php $quai="quai{$i}" ; @endphp
                        <option value="{{ $quai }}" {{ (old('lieudereception', $data->lieudereception ?? '') == $quai) ? 'selected' : '' }}>
                        {{ ucfirst($quai) }}
                        </option>
                        @endfor
                </select>
                @error('lieudereception')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Boutons -->

        <div class="flex justify-end gap-4 mt-6">
            <button type="submit" id="updateBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                {{ isset($reception) ? 'Mettre à jour' : 'Enregistrer' }}
            </button>
            <a href="{{ route('receptions.index') }}" id="cancelBtn"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition flex items-center justify-center">
                Annuler
            </a>
        </div>

    </form>
</div>