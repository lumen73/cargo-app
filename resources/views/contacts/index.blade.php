<div class="container bg-black-800 py-8 px-4">

    <h2 class="text-center text-2xl font-semibold mb-6 text-white">Nos Commentaires</h2>

    @if($contacts->count())
    <div class="flex flex-row md:grid md:grid-cols-3 md:gap-6 space-x-4 md:space-x-0 overflow-x-auto md:overflow-visible">
        @foreach($contacts as $contact)
        <div class="bg-gray-100 shadow rounded-lg p-4 min-w-[280px] md:min-w-0 flex-shrink-0">
            <p class="font-bold text-orange-600">{{ $contact->nom }}</p>
            <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($contact->message, 100) }}</p>
            <a href="mailto:{{ $contact->email }}" class="text-sm text-green-600 mt-2">{{ $contact->email }}</a>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-center">
        {{ $contacts->withQueryString()->links() }}
    </div>
    @else
    <p class="text-center text-gray-200">Aucun commentaire pour le moment.</p>
    @endif

</div>