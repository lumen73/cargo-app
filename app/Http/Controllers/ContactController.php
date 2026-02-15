<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Récupère les contacts depuis la base, paginés 3 par page
        $contacts = Contact::latest()->paginate(3);
        $user = Auth::user();

        return view('contacts.index', compact('contacts', 'user'));
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

    public function create() {}
    public function show(Contact $contact) {}
    public function edit(Contact $contact) {}
    public function update(Request $request, Contact $contact) {}
    public function destroy(Contact $contact) {}
}
