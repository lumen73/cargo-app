<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tableau de Bord
        </h2>
    </x-slot>



    @section('content')
    <h1>Liste des utilisateurs</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if ($user->role != 'gestionnaire')
                    <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="role" value="gestionnaire">
                        <button type="submit" class="btn btn-primary">Promouvoir en gestionnaire</button>
                    </form>
                    @else
                    <span>Déjà gestionnaire</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
</x-app-layout>