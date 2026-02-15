<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Container;
use App\Models\Cargaison;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zone = Zone::with('container')->get();
        return view('zones.index', compact('zone'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $container = Container::all();
        return view('zones.create', compact('container'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idcontainer' => 'required|exists:container,idcontainer',
            'zonestockage' => 'required|string|max:255',
            'datestockage' => 'required|date',
            'heurestockage' => 'required|date_format:H:i',
        ]);

        Zone::create($request->all());
        return redirect()->route('zones.index')->with('success', 'Zone créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        $zone->load('container');
        return view('zones.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {

        $cargaison = Cargaison::all();
        $container = Container::all();
        return view('zones.edit', compact('zone', 'cargaison', 'container'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
        $request->validate([

            'idcontainer' => 'required|exists:container,idcontainer',
            'zonestockage' => 'required|string|max:255',
            'datestockage' => 'required|date',
            'heurestockage' => 'required|date_format:H:i',
        ]);

        $zone->update($request->all());
        return redirect()->route('zones.index')->with('success', 'Zone mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone supprimée avec succès');
    }
}
