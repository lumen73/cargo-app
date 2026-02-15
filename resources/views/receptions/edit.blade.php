<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4 px-4">
                <a href="{{ route('cargaisons.index') }}"
                    class="{{ request()->routeIs('cargaisons.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Cargaison
                </a>
                <a href="{{ route('receptions.index') }}"
                    class="{{ request()->routeIs('receptions.edit') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Réception
                </a>
                <a href="{{ route('containers.index') }}"
                    class="{{ request()->routeIs('containers.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Container
                </a>
                <a href="{{ route('inspections.index') }}"
                    class="{{ request()->routeIs('inspections.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Inspection
                </a>
                <a href="{{ route('zones.index') }}"
                    class="{{ request()->routeIs('zones.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Zone
                </a>
                <a href="{{ route('moyens.index') }}"
                    class="{{ request()->routeIs('moyens.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Moyen
                </a>
                <a href="{{ route('expeditions.index') }}"
                    class="{{ request()->routeIs('expeditions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center py-2 rounded">
                    Expéditions
                </a>
            </nav>
        </aside>

        <!-- Overlay -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-transition.opacity>
        </div>

        <!-- Main content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">

            <section class="p-6">

                @csrf
                @method('PUT')

                @include('receptions.form')


            </section>

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    document.addEventListener('DOMContentLoaded', function () {
    const isEditMode = window.isEditMode;

    const cancelBtn = document.getElementById('cancelBtn');
    cancelBtn.addEventListener('click', function(event) {
    event.preventDefault();

    Swal.fire({
    title: 'Êtes-vous sûr de vouloir annuler ?',
    text: "Les modifications non enregistrées seront perdues.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Oui, annuler',
    cancelButtonText: 'Non, rester ici'
    }).then((result) => {
    if (result.isConfirmed) {
    window.location.href = cancelBtn.href;
    }
    });
    });

    const updateBtn = document.getElementById('updateBtn');
    if (updateBtn && isEditMode) {
    updateBtn.addEventListener('click', function(event) {
    const confirmed = confirm('Voulez-vous vraiment mettre à jour cette réception ?');
    if (!confirmed) {
    event.preventDefault();
    }
    });
    }
    });



</x-app-layout>