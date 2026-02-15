<?php

namespace App\Http\Controllers;

use App\Models\Cargaison;
use App\Models\Gestionnaire;
use App\Models\User;
use App\Models\Inspection;

use Illuminate\Http\Request;

class CargaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        $cargaison = Cargaison::with('gestionnaire')->get();

        return view('cargaisons.index', compact('cargaison'));
    }

    public function create()
    {
        $gestionnaire = Gestionnaire::all();
        $cargaison = Cargaison::with('gestionnaire')->get();
        return view('cargaisons.create', compact('gestionnaire', 'cargaison'));
    }
    public function show($id)
    {

        $cargaison = Cargaison::with('gestionnaire')->findOrFail($id);
        return view('cargaisons.show', compact('cargaison'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomcargaison' => 'required|string',
            'idgestionnaire' => 'required|exists:gestionnaire,idgestionnaire',
            'naturemarchandise' => 'required|string',
            'volumemarchandise' => 'required|numeric',
            'poidscargaison' => 'required|numeric',
            'valeurcargaison' => 'required|numeric',
            'etatcargaison' => 'required|in:dechargement,transit,charge',
        ]);

        Cargaison::create($validated);
        return redirect()->route('cargaisons.index')->with('success', 'Cargaison ajoutée avec succès');
    }

    public function edit(Cargaison $cargaison)
    {

        $gestionnaire = Gestionnaire::all();
        return view('cargaisons.edit', compact('cargaison', 'gestionnaire'));
    }

    public function update(Request $request, Cargaison $cargaison)
    {
        $validated = $request->validate([
            'nomcargaison' => 'required|string',
            'idgestionnaire' => 'required|exists:gestionnaire,idgestionnaire',
            'naturemarchandise' => 'required|string',
            'volumemarchandise' => 'required|numeric',
            'poidscargaison' => 'required|numeric',
            'valeurcargaison' => 'required|numeric',
            'etatcargaison' => 'required|in:dechargement,transit,charge',
        ]);

        $cargaison->update($validated);
        return redirect()->route('cargaisons.index')->with('success', 'Cargaison mise à jour');
    }

    public function destroy(Cargaison $cargaison)
    {
        $cargaison->delete();
        return redirect()->route('cargaisons.index')->with('success', 'Cargaison supprimée');
    }
}
