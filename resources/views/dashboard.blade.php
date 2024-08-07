<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen flex flex-col items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h3 class="text-2xl mb-4">{{ __("¡Estas registrado!") }}</h3>
                    <p class="mb-6">{{ __("Tu registro ha sido exitoso. Ahora puedes acceder a todas las funciones.") }}</p>
                    <a href="{{ url('/user') }}" class="btn btn-primary">
                        {{ __('Continuar') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

