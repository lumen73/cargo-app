<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contact;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Récupère les contacts depuis la base, paginés 3 par page
        $contacts = Contact::latest()->paginate(3);
        $user = Auth::user();

        return view('landing', compact('contacts', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('nom', 'email', 'message'));

        return redirect()->back()->with('success', 'Message envoyé avec succès.');
    }
}
