<div>
    <label for="idmoyen" class="block text-sm font-medium text-gray-700">Transport</label>
    <select name="idmoyen" id="idmoyen" required class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        <option value="">-- Sélectionner --</option>
        @foreach ($moyen as $moyen)
        <option value="{{ $moyen->idmoyen }}" {{ old('idmoyen', $expedition->idmoyen ?? '') == $moyen->idmoyen ? 'selected' : '' }}>
            {{ $moyen->prenomschauffeur}}
        </option>
        @endforeach
    </select>
</div>

<div>
    <label for="idgestionnaire" class="block text-sm font-medium text-gray-700">Gestionnaire</label>
    <select name="idgestionnaire" id="idgestionnaire" required class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        <option value="">-- Sélectionner --</option>
        @foreach ($gestionnaire as $gestionnaire)
        <option value="{{ $gestionnaire->idgestionnaire }}" {{ old('idgestionnaire', $expedition->idgestionnaire ?? '') == $gestionnaire->idgestionnaire ? 'selected' : '' }}>
            {{ $gestionnaire->name }}
        </option>
        @endforeach
    </select>
</div>

<div>
    <label for="idcontainer" class="block text-sm font-medium text-gray-700">Container</label>
    <select name="idcontainer" id="idcontainer" required class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        <option value="">-- Sélectionner --</option>
        @foreach ($container as $container)
        <option value="{{ $container->idcontainer }}" {{ old('idcontainer', $expedition->idcontainer ?? '') == $container->idcontainer ? 'selected' : '' }}>
            {{ $container->numerocontainer }}
        </option>
        @endforeach
    </select>
</div>

<div>
    <label for="datedepart" class="block text-sm font-medium text-gray-700">Date de départ</label>
    <input type="date" name="datedepart" id="datedepart" value="{{ old('datedepart', $expedition->datedepart ?? '') }}"
        required class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
</div>

<div>
    <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
    <input type="text" name="destination" id="destination" value="{{ old('destination', $expedition->destination ?? '') }}"
        required class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
</div>