<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{ route('moyens.index')  }}">moyen</a>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{ route('cargaisons.index')  }}">cargaison</a>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{ route('containers.index')  }}">container</a>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{  route('zones.index')  }}">zone</a>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{ route('receptions.index') }}">reception</a>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{ route('inspections.index') }}">inspection</a>
            <a class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" href="{{ route('expeditions.index')  }}">expedition</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("welcome gestionnaire You're logged in!") }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>