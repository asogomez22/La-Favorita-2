<x-app-layout title="Añadir Nueva Categoría">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Añadir Nueva Categoria') }}
        </h2>
    </x-slot>

    <!-- Contenido de la página -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg border border-gray-200">
                <div class="p-6 sm:p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.categorias.store') }}">
                        @csrf
                        <div>
                            <label for="nombre" class="block font-medium text-sm text-gray-700">
                                Nombre (Ej: Clàsica, Pistacho)
                            </label>
                            <input id="nombre" class="block mt-1 w-full rounded-md shadow-xs border-gray-300 focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="nombre" value="{{ old('nombre') }}" required autofocus />
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.categorias.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 font-medium">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-[#FF40A8] text-white rounded-lg shadow-md hover:bg-[#FB80A1] transition-all duration-200 font-bold"
                                    style="font-family: 'Poppins', sans-serif;">
                                Guardar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
