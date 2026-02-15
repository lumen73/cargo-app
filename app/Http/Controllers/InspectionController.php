<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Cargaison;
use App\Models\Container;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inspection::with(['cargaison', 'container']);

        // Optionnel: filtre de recherche (à adapter si besoin)
        if ($search = $request->input('search')) {
            $query->whereHas('cargaison', function ($q) use ($search) {
                $q->where('nomcargaison', 'like', "%{$search}%");
            })
                ->orWhere('etatinspection', 'like', "%{$search}%")
                ->orWhere('rapport', 'like', "%{$search}%");
        }

        $inspection = $query->orderBy('dateinspection', 'desc')->paginate(10);

        return view('inspections.index', compact('inspection'));
    }

    public function create()
    {
        $cargaison = Cargaison::all();
        $container = Container::all();
        return view('inspections.create', compact('cargaison', 'container'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idcargaison' => 'required|exists:cargaison,idcargaison',
            'etatinspection' => 'required|string',
            'rapport' => 'required|string',
            'dateinspection' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'idcontainer' => 'nullable|exists:container,idcontainer',
        ]);

        $data = $request->only([
            'idcargaison',
            'etatinspection',
            'rapport',
            'dateinspection',
            'idcontainer'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Inspection::create($data);

        return redirect()->route('inspections.index')->with('success', 'Inspection enregistrée avec succès.');
    }

    public function show(string $idinspection)
    {
        $inspection = Inspection::with(['cargaison', 'container'])->findOrFail($idinspection);
        return view('inspections.show', compact('inspection'));
    }

    public function edit(string $id)
    {
        $inspection = Inspection::findOrFail($id);
        $cargaison = Cargaison::all();
        $container = Container::all();
        return view('inspections.edit', compact('inspection', 'cargaison', 'container'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'idcargaison' => 'required|exists:cargaison,idcargaison',
            'etatinspection' => 'required|string',
            'rapport' => 'required|string',
            'dateinspection' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'idcontainer' => 'nullable|exists:container,idcontainer',
        ]);

        $inspection = Inspection::findOrFail($id);

        $data = $request->only([
            'idcargaison',
            'etatinspection',
            'rapport',
            'dateinspection',
            'idcontainer'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $inspection->update($data);

        return redirect()->route('inspections.index')->with('success', 'Inspection mise à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $inspection = Inspection::findOrFail($id);
        $inspection->delete();
        return redirect()->route('inspections.index')->with('success', 'Inspection supprimée avec succès.');
    }
}
