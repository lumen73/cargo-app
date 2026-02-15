<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-center text-3xl font-bold text-orange-600 mb-8">Tous les commentaires</h2>

        <div class="text-center mb-6">
            <a href="contacts.index" class="inline-block px-6 py-2 rounded bg-orange-500 text-white hover:bg-orange-600 transition duration-300">
                ← Retour à l'accueil
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($contacts as $contact)
            <div class="bg-white shadow-md rounded-xl p-5 hover:shadow-lg transition duration-300">
                <p class="font-semibold text-lg text-orange-600">{{ $contact->nom }}</p>
                <p class="text-gray-700 mt-2">{{ \Illuminate\Support\Str::limit($contact->message, 200) }}</p>
                <p class="text-sm text-gray-500 mt-3">{{ $contact->email }}</p>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500">
                Aucun commentaire trouvé.
            </div>
            @endforelse
        </div>

        <div class="mt-8 flex justify-center">
            {{ $contacts->links() }}
        </div>
    </div>
</x-app-layout>