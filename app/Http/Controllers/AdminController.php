<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gestionnaire;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.dashboard', compact('users'));
    }
    public function indexGest()
    {
        $users = User::where('role', 'gestionnaire')->get();
        $gestionnaireIds = Gestionnaire::pluck('idgestionnaire')->toArray();

        return view('admin.show2', compact('users', 'gestionnaireIds'));
    }


    public function show($id)
    {
        $user = User::findOrFail($id); // Trouver l'utilisateur par son ID
        return view('admin.show', compact('user'));
    }
    public function show1($id)
    {
        $user = User::findOrFail($id); // Trouver l'utilisateur par son ID
        return view('admin.show1', compact('user')); // Assurez-vous que cette vue existe
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);  // Trouver l'utilisateur par ID
        return view('admin.edit', compact('user'));  // Retourne la vue avec l'utilisateur
    }

    public function update(Request $request, User $user)
    {


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,utilisateur,gestionnaire',
        ]);

        $user->update($validated);

        return redirect()->route('admin.dashboard')->with('status', 'Utilisateur mis à jour avec succès');
    }
}
