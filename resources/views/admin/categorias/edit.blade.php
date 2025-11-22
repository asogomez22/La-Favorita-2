<x-app-layout title="Editar Categoría">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Editar Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('admin.categorias.update', $categoria) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input id="nombre" class="block mt-1 w-full rounded-md shadow-xs border-gray-300 focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200 focus:ring-opacity-50" 
                                   type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.categorias.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-[#FF40A8] text-white rounded-lg shadow-md hover:bg-[#FB80A1] transition-all duration-200 transform hover:-translate-y-1 font-bold">
                                Actualizar Categoría
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
