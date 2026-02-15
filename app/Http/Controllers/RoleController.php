<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{

    public function updateRole(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->back()->with('alert', 'Vous ne pouvez pas changer votre rôle en tant qu\'administrateur.Veuillez consulter un autre admin pour cela');
        }

        $request->validate([
            'role' => 'required|in:admin,gestionnaire,utilisateur'
        ]);

        $user->role = $request->role;
        $user->save();

        Auth::logout();
        Auth::login($user);

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'gestionnaire':
                return redirect()->route('gestionnaire.dashboard');
            default:
                return redirect()->route('landing');
        }
    }
}
