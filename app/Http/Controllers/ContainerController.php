<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargaison;
use App\Models\Container;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $container = Container::all();
        return view('containers.index', compact('container'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cargaison = Cargaison::all();  // Liste des cargaisons pour le select
        return view('containers.create', compact('cargaison'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numerocontainer' => 'required|string|max:255',
            'taillecontainer' => 'required|string|max:255',
            'typecargaison' => 'required|string|max:255',
            'paysorigine' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'poidscontainer' => 'required|numeric',
            'datearrivee' => 'required|date',
            'etatinspection' => 'required|string|max:255',
            'idcargaison' => 'required|exists:cargaison,idcargaison',
        ]);

        Container::create($request->all());
        return redirect()->route('containers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Container $container)
    {
        return view('containers.show', compact('container'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Container $container)
    {
        $cargaison = Cargaison::all();
        return view('containers.edit', compact('container', 'cargaison'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Container $container)
    {
        $request->validate([
            'numerocontainer' => 'required|string|max:255',
            'taillecontainer' => 'required|string|max:255',
            'typecargaison' => 'required|string|max:255',
            'paysorigine' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'poidscontainer' => 'required|numeric',
            'datearrivee' => 'required|date',
            'etatinspection' => 'required|string|max:255',
            'idcargaison' => 'required|exists:cargaison,idcargaison',
        ]);

        $container->update($request->all());
        return redirect()->route('containers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Container $container)
    {
        $container->delete();
        return redirect()->route('containers.index');
    }
}
