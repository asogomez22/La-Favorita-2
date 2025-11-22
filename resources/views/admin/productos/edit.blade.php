<x-app-layout title="Editar Producto">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-sm relative" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">Hay problemas con los datos introducidos:</span>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.productos.update', $producto) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                                <input id="nombre" 
                                       class="block mt-1 w-full rounded-md shadow-xs border border-gray-300 focus:border-[#FF40A8] focus:ring-3 focus:ring-[#FF40A8]/30 text-gray-800 px-3 py-2" 
                                       type="text" 
                                       name="nombre" 
                                       value="{{ old('nombre', $producto->nombre) }}" 
                                       required autofocus />
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label for="categoria_id" class="block font-medium text-sm text-gray-700">Categoría</label>
                                <select id="categoria_id" 
                                        name="categoria_id" 
                                        class="block mt-1 w-full rounded-md shadow-xs border border-gray-300 focus:border-[#FF40A8] focus:ring-3 focus:ring-[#FF40A8]/30 text-gray-800 px-3 py-2">
                                    <option value="">Sin categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" 
                                            {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Precio -->
                        <div class="mt-4">
                            <label for="precio" class="block font-medium text-sm text-gray-700">Precio (€)</label>
                            <input id="precio" 
                                   class="block mt-1 w-full rounded-md shadow-xs border border-gray-300 focus:border-[#FF40A8] focus:ring-3 focus:ring-[#FF40A8]/30 text-gray-800 px-3 py-2" 
                                   type="number" 
                                   name="precio" 
                                   step="0.01" 
                                   value="{{ old('precio', $producto->precio) }}" 
                                   required />
                        </div>

                        <!-- Descripción -->
                        <div class="mt-4">
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <textarea id="descripcion" 
                                      name="descripcion" 
                                      rows="4" 
                                      class="block mt-1 w-full rounded-md shadow-xs border border-gray-300 focus:border-[#FF40A8] focus:ring-3 focus:ring-[#FF40A8]/30 text-gray-800 px-3 py-2" 
                                      required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                        </div>
                        <!-- Imagen -->
                        <div class="mt-6">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Imagen del Producto</label>

                            <!-- Botón personalizado -->
                            <label for="imagen" 
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#FF40A8] text-white rounded-lg shadow-sm hover:bg-[#f32ba0] transition duration-200">
                                <!-- Icono moderno: cámara -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 7h4l2-3h4l2 3h4a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V8a1 1 0 011-1zm8 11a4 4 0 100-8 4 4 0 000 8z"/>
                                </svg>
                                Seleccionar imagen
                            </label>
                            <input id="imagen" type="file" name="imagen" accept="image/*" class="hidden" />

                            @if ($producto->imagen)
                                <div class="mt-4 flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                        alt="Imagen de {{ $producto->nombre }}" 
                                        class="h-24 w-auto rounded-md shadow-xs border border-gray-200">
                                    <span class="text-sm text-gray-500">Dejar vacío para no cambiar la imagen.</span>
                                </div>
                            @endif
                        </div>
<!-- Checkboxes Activo / Destacado / Novedad -->
<div class="mt-6 flex flex-wrap gap-6">
    <div class="flex items-center">
        <input id="activo" name="activo" type="checkbox" 
               class="rounded-sm border-gray-300 text-[#FF40A8] shadow-xs focus:ring-[#FF40A8]" 
               value="1" 
               @checked(old('activo', $producto->activo))>
        <label for="activo" class="ms-2 block text-sm font-medium text-gray-700">
            Activo (Visible en la web)
        </label>
    </div>

    <div class="flex items-center">
        <input id="destacado" name="destacado" type="checkbox" 
               class="rounded-sm border-gray-300 text-[#FF40A8] shadow-xs focus:ring-[#FF40A8]" 
               value="1" 
               @checked(old('destacado', $producto->destacado))>
        <label for="destacado" class="ms-2 block text-sm font-medium text-gray-700">
            Destacado (Mostrar en inicio)
        </label>
    </div>

    <div class="flex items-center">
      <input id="novedad" name="novedad" type="checkbox" 
       class="rounded-sm border-gray-300 text-[#FF40A8] shadow-xs focus:ring-[#FF40A8]" 
       value="1" 
       @checked(old('novedad', $producto->estado === 'novedad'))>
<label for="novedad" class="ms-2 block text-sm font-medium text-gray-700">
    Novedad (Mostrar en sección Novedades)
</label>

    </div>
</div>


                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.productos.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-[#FF40A8] text-white rounded-lg shadow-md hover:bg-[#f32ba0] transition-all duration-200 transform hover:-translate-y-1 font-bold">
                                Actualizar Producto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
