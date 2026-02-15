<?php

namespace App\Http\Controllers;

use App\Models\Moyen;
use Illuminate\Http\Request;

class MoyenController extends Controller
{
    public function index()
    {
        $moyens = Moyen::paginate(10);
        return view('moyens.index', compact('moyens'));
    }


    public function create()
    {
        return view('moyens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transport' => 'required',
            'nomchauffeur' => 'required',
            'prenomschauffeur' => 'required',
            'numero' => 'required',
            'permis' => 'required',
        ]);

        Moyen::create($request->all());
        return redirect()->route('moyens.index')->with('success', 'Moyen créé avec succès.');
    }

    public function show(Moyen $moyen)
    {
        return view('moyens.show', compact('moyen'));
    }

    public function edit(Moyen $moyen)
    {
        return view('moyens.edit', compact('moyen'));
    }

    public function update(Request $request, Moyen $moyen)
    {
        $request->validate([
            'transport' => 'required',
            'nomchauffeur' => 'required',
            'prenomschauffeur' => 'required',
            'numero' => 'required',
            'permis' => 'required',
        ]);

        $moyen->update($request->all());
        return redirect()->route('moyens.index')->with('success', 'Moyen mis à jour avec succès.');
    }

    public function destroy(Moyen $moyen)
    {
        $moyen->delete();
        return redirect()->route('moyens.index')->with('success', 'Moyen supprimé.');
    }
}
