<x-app-layout>
    <div x-data="{ sidebarOpen: false }" style="margin-top:-1px;" class="flex h-screen overflow-hidden">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 form-transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
            <h2 class="text-3xl text-center font-bold mb-6 text-white py-6">Dashboard</h2>
            <nav class="flex flex-col gap-4">
                <a class="{{ request()->routeIs('cargaisons.edit') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('cargaisons.index') }}">Cargaison</a>
                <a class="{{ request()->routeIs('receptions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('receptions.index') }}">reception</a>
                <a class="{{ request()->routeIs('containers.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('containers.index') }}">Container</a>
                <a class="{{ request()->routeIs('inspections.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('inspections.index') }}">inspection</a>
                <a class="{{ request()->routeIs('zones.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('zones.index') }}">Zone</a>
                <a class="{{ request()->routeIs('moyens.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('moyens.index') }}">Moyen</a>
                <a class="{{ request()->routeIs('expeditions.index') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('expeditions.index') }}">expeditions</a>
                <a class="{{ request()->routeIs('profile.edit') ? 'bg-red-400 font-bold' : 'hover:bg-yellow-400' }} text-white text-xl text-center hover:bg-yellow-400" href="{{ route('admin.dashboard') }}">retour</a>
            </nav>
        </aside>

        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            x-transition.opacity>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col w-full ml-0 md:ml-64">

            <!-- Header mobile -->
            <header class="flex items-center justify-between p-4 bg-blue-600 border-b shadow md:hidden">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-xl font-bold text-white">Dashboard</span>
            </header>

            <!-- Main content -->
            <main style="margin-left: -15px; margin-top: 20px; ;width: 1300px; " class="w-full  p-6">
                <div style="margin-left: px; width: 1300px; " class=" mx-auto space-y-8 flex ">
                    <div style="margin-left: px; width: 1300px; " class="flex">
                        <div class="flex justify-start  border-l-8 border-r-8">
                            <!-- Profil -->
                            <div class="bg-white shadow-xl rounded-2xl p-6  border-gray-200 w-full min-h-[250px]">
                                <h3 class="text-xl font-semibold text-gray-700 mb-4">Mise à jour du profil</h3>
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="flex justify-center border-l-8 border-r-8">
                            <!-- Mot de passe -->
                            <div class="bg-white shadow-xl rounded-2xl p-6  border-gray-200 w-full min-h-[250px]">
                                <h3 class="text-xl font-semibold text-gray-700 mb-4">Changer le mot de passe</h3>
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                        <div class="flex justify-end w-1/3  border-l-8 border-r-8">
                            <!-- Suppression -->
                            <div class="bg-red-50 shadow-xl rounded-2xl p-6  border-red-300 w-full  min-h-[250px]">
                                <h3 class="text-xl font-semibold text-red-700 mb-4">Supprimer le compte</h3>
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</x-app-layout>