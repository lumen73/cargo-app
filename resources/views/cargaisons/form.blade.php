<div>
    <label for="nomcargaison" class="block">Nom Cargaison</label>
    <input type="text" name="nomcargaison" id="nomcargaison"
        value="{{ old('nomcargaison', $cargaison->nomcargaison ?? '') }}"
        class="w-full border px-3 py-2 rounded" required>
</div>

<div>
    <label for="idgestionnaire" class="block">Gestionnaire</label>
    <select name="idgestionnaire" id="idgestionnaire" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Choisir --</option>
        @foreach($gestionnaire as $gestionnaire)
        <option value="{{ $gestionnaire->id }}"
            {{ (old('idgestionnaire', $cargaison->idgestionnaire ?? '') == $gestionnaire->id) ? 'selected' : '' }}>
            {{ $gestionnaire->name }}
        </option>
        @endforeach
    </select>
</div>

<div>
    <label for="naturemarchandise" class="block">Nature de la marchandise</label>
    <input type="text" name="naturemarchandise" id="naturemarchandise"
        value="{{ old('naturemarchandise', $cargaison->naturemarchandise ?? '') }}"
        class="w-full border px-3 py-2 rounded" required>
</div>

<div>
    <label for="volumemarchandise" class="block">Volume (m³)</label>
    <input type="number" step="0.01" name="volumemarchandise" id="volumemarchandise"
        value="{{ old('volumemarchandise', $cargaison->volumemarchandise ?? '') }}"
        class="w-full border px-3 py-2 rounded" required>
</div>

<div>
    <label for="poidscargaison" class="block">Poids (kg)</label>
    <input type="number" step="0.01" name="poidscargaison" id="poidscargaison"
        value="{{ old('poidscargaison', $cargaison->poidscargaison ?? '') }}"
        class="w-full border px-3 py-2 rounded" required>
</div>

<div>
    <label for="valeurcargaison" class="block">Valeur (FCFA)</label>
    <input type="number" step="0.01" name="valeurcargaison" id="valeurcargaison"
        value="{{ old('valeurcargaison', $cargaison->valeurcargaison ?? '') }}"
        class="w-full border px-3 py-2 rounded" required>
</div>

<div>
    <label for="etatcargaison" class="block">État</label>
    <select name="etatcargaison" id="etatcargaison" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Choisir l'état --</option>
        @foreach(['dechargement', 'transit', 'charge'] as $etat)
        <option value="{{ $etat }}"
            {{ (old('etatcargaison', $cargaison->etatcargaison ?? '') == $etat) ? 'selected' : '' }}>
            {{ ucfirst($etat) }}
        </option>
        @endforeach
    </select>
</div>