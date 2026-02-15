<?php

namespace App\Http\Controllers;

use App\Models\Gestionnaire;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GestionnaireController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'role:gestionnaire']);
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {

        $user = Auth::user();
        return view('gestionnaire.dashboard', compact('user')); // Crée cette vue dans resources/views/gestionnaire/dashboard.blade.php
    }

    public function store(Request $request)
    {
        // Valider les données si nécessaire
        $data = $request->validate([
            'idusers' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email',

        ]);

        // Insérer dans la table gestionnaire
        DB::table('gestionnaire')->insert($data);

        return redirect()->route('admin.dashboard')->with('status', 'Gestionnaire enregistré avec succès');
    }
}
