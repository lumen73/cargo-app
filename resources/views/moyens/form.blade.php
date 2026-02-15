<div>
    <label class="block font-medium text-sm text-gray-700">Transport</label>
    <input type="text" name="transport" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('transport', $moyen->transport ?? '') }}" required>
</div>

<div>
    <label class="block font-medium text-sm text-gray-700">Nom du Chauffeur</label>
    <input type="text" name="nomchauffeur" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nomchauffeur', $moyen->nomchauffeur ?? '') }}" required>
</div>

<div>
    <label class="block font-medium text-sm text-gray-700">Prénom du Chauffeur</label>
    <input type="text" name="prenomschauffeur" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('prenomschauffeur', $moyen->prenomschauffeur ?? '') }}" required>
</div>

<div>
    <label class="block font-medium text-sm text-gray-700">Numéro</label>
    <input type="text" name="numero" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('numero', $moyen->numero ?? '') }}" required>
</div>

<div>
    <label class="block font-medium text-sm text-gray-700">Permis</label>
    <input type="text" name="permis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('permis', $moyen->permis ?? '') }}" required>
</div>