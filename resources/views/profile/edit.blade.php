<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between py-6 bg-white border-b border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight" style="font-family: 'Inter', sans-serif;">
                Perfil
            </h2>
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-3 px-6 py-3 text-base font-medium text-white bg-[#FF40A8] rounded-full hover:bg-[#E03694] transition duration-300 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Información del Perfil -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-gray-100 transition-all duration-300 hover:shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-6" style="font-family: 'Inter', sans-serif;">
                    Información del Perfil
                </h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Actualizar Contraseña -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-gray-100 transition-all duration-300 hover:shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-6" style="font-family: 'Inter', sans-serif;">
                    Actualizar Contraseña
                </h3>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Eliminar Cuenta -->
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-gray-100 transition-all duration-300 hover:shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-6" style="font-family: 'Inter', sans-serif;">
                    Eliminar Cuenta
                </h3>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
