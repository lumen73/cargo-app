<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionnaireController extends Controller
{
    public function index()
    {
        // Récupère tous les utilisateurs ayant un lien avec la table gestionnaire
        $gestionnaire = User::where('role', 'gestionnaire')->whereHas('gestionnaire')->get();

        return view('admin.gestionnaire.index', compact('gestionnaire'));
    }
}
