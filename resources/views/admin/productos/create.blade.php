<x-app-layout title="Crear Producto">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Afegir Nou Producte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-sm relative" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">Hay problemas con los datos introducidos:</span>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                                <input id="nombre" class="block mt-1 w-full rounded-md shadow-xs border-gray-300" 
                                       type="text" name="nombre" value="{{ old('nombre') }}" required autofocus />
                            </div>

<div>
    <label for="categoria_id" class="block font-medium text-sm text-gray-700">Categoría</label>
    <select id="categoria_id" name="categoria_id" class="block mt-1 w-full rounded-md shadow-xs border-gray-300">
        <option value="">Sin categoría</option> 
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
</div>
                        </div>

                        <div class="mt-4">
                            <label for="precio" class="block font-medium text-sm text-gray-700">Precio (€)</label>
                            <input id="precio" class="block mt-1 w-full rounded-md shadow-xs border-gray-300" 
                                   type="number" name="precio" step="0.01" value="{{ old('precio') }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4" class="block mt-1 w-full rounded-md shadow-xs border-gray-300" required>{{ old('descripcion') }}</textarea>
                        </div>

                        <!-- Imagen con botón moderno -->
                        <div class="mt-6">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Imagen del Producto</label>

                            <!-- Botón personalizado -->
                            <label for="imagen" 
                                   class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#FF40A8] text-white rounded-lg shadow-sm hover:bg-[#f32ba0] transition duration-200">
                                <!-- Icono cámara -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 7h4l2-3h4l2 3h4a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V8a1 1 0 011-1zm8 11a4 4 0 100-8 4 4 0 000 8z"/>
                                </svg>
                                Seleccionar imagen
                            </label>
                            <input id="imagen" type="file" name="imagen" accept="image/*" class="hidden" />
                        </div>

                        <div class="mt-6 flex space-x-6">
                            <div class="flex items-center">
                                <input id="activo" name="activo" type="checkbox" 
                                       class="rounded-sm border-gray-300 text-[#FF40A8] shadow-xs focus:ring-[#FF40A8]" 
                                       value="1" checked> 
                                <label for="activo" class="ms-2 block text-sm font-medium text-gray-700">Activo (Visible en la web)</label>
                            </div>
                            <div class="flex items-center">
                                <input id="destacado" name="destacado" type="checkbox" 
                                       class="rounded-sm border-gray-300 text-[#FF40A8] shadow-xs focus:ring-[#FF40A8]" 
                                       value="1"> 
                                <label for="destacado" class="ms-2 block text-sm font-medium text-gray-700">Destacado (Mostrar en inicio)</label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.productos.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-[#FF40A8] text-white rounded-lg shadow-md hover:bg-[#f32ba0] transition-all duration-200 transform hover:-translate-y-1 font-bold">
                                Guardar Producto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
