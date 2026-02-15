<?php

namespace App\Http\Controllers;

use App\Models\Reception;
use App\Models\Gestionnaire;
use App\Models\Cargaison;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reception = Reception::with(['gestionnaire', 'cargaison'])->get();
        return view('receptions.index', compact('reception'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gestionnaire = Gestionnaire::all();
        $cargaison = Cargaison::all();
        return view('receptions.create', compact('gestionnaire', 'cargaison'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idgestionnaire' => 'required|exists:gestionnaire,idgestionnaire',
            'idcargaison' => 'required|exists:cargaison,idcargaison',
            'datearrivee' => 'required|date',
            'nombrecontainer' => 'required|integer',
            'lieudereception' => 'required|string|max:255',
        ]);

        Reception::create($request->all());

        return redirect()->route('receptions.index')->with('success', 'Réception ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reception = Reception::with(['gestionnaire', 'cargaison'])->findOrFail($id);
        return view('receptions.show', compact('reception'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reception $reception)
    {
        $gestionnaire = Gestionnaire::all();
        $cargaison = Cargaison::all();
        return view('receptions.edit', compact('reception', 'gestionnaire', 'cargaison'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reception $reception)
    {
        $request->validate([
            'idgestionnaire' => 'required|exists:gestionnaire,idgestionnaire',
            'idcargaison' => 'required|exists:cargaison,idcargaison',
            'datearrivee' => 'required|date',
            'nombrecontainer' => 'required|integer',
            'lieudereception' => 'required|string|max:255',
        ]);

        $reception->update($request->all());

        return redirect()->route('receptions.index')->with('success', 'Réception modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reception $reception)
    {
        $reception->delete();
        return redirect()->route('receptions.index')->with('success', 'Réception supprimée.');
    }
}
