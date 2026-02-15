<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expedition;
use App\Models\Moyen;
use App\Models\Gestionnaire;
use App\Models\Container;

class ExpeditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $expeditions = \App\Models\Expedition::with(['moyen', 'gestionnaire', 'container'])
            ->when($search, function ($query, $search) {
                return $query->where('destination', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('expeditions.index', compact('expeditions', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $moyen = Moyen::all();
        $gestionnaire = Gestionnaire::all();
        $container = Container::all();
        return view('expeditions.create', compact('moyen', 'gestionnaire', 'container'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idmoyen' => 'required',
            'idgestionnaire' => 'required',
            'idcontainer' => 'required',
            'datedepart' => 'required|date',
            'destination' => 'required|string|max:255',
        ]);

        Expedition::create($request->all());

        return redirect()->route('expeditions.index')->with('success', 'Expédition créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expedition $expedition)
    {
        $moyen = Moyen::all();
        $gestionnaire = Gestionnaire::all();
        $container = Container::all();
        return view('expeditions.edit', compact('expedition', 'moyen', 'gestionnaire', 'container'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expedition $expedition)
    {
        $request->validate([
            'idmoyen' => 'required',
            'idgestionnaire' => 'required',
            'idcontainer' => 'required',
            'datedepart' => 'required|date',
            'destination' => 'required|string|max:255',
        ]);

        $expedition->update($request->all());

        return redirect()->route('expeditions.index')->with('success', 'Expédition mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Expedition $expedition)
    {
        $expedition->delete();
        return redirect()->route('expeditions.index')->with('success', 'Expédition supprimée avec succès.');
    }
}
