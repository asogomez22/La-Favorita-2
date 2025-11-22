<x-app-layout  title="Categorías">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Gestión de Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="font-family: 'Poppins', sans-serif;">
                    
                    {{-- Botón Añadir --}}
                    <div class="mb-6 text-right">
                        <a href="{{ route('admin.categorias.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-[#FF40A8] text-white text-base font-semibold rounded-lg shadow-md hover:bg-[#FB80B1] transition duration-300 focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Añadir Nueva Categoria
                        </a>
                    </div>
                    
                    {{-- Mensajes de Sesión (Eliminado el @include) --}}
                    {{-- Si quieres mostrar mensajes aquí, tendrías que añadir el código --}}
                     @if (session('success'))
                         <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-sm relative" role="alert">
                             <span class="block sm:inline">{{ session('success') }}</span>
                         </div>
                     @endif
                     @if (session('error'))
                         <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-sm relative" role="alert">
                             <span class="block sm:inline">{{ session('error') }}</span>
                         </div>
                     @endif


                    @if ($categorias->isEmpty())
                        <p class="text-center text-gray-500 text-lg py-10">Aún no hay categorias creadas.</p>
                    @else
                        {{-- Tabla de categorías --}}
                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    {{-- Bucle CORRECTO sobre $categorias --}}
                                    @foreach ($categorias as $categoria)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $categoria->nombre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                                {{-- Botón Editar --}}
                                                <a href="{{ route('admin.categorias.edit', $categoria) }}" 
                                                   class="text-[#FF40A8] hover:text-[#FB80A1] font-semibold transition duration-150">
                                                    Editar
                                                </a>
                                                {{-- Formulario Borrar --}}
                                                <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" class="inline-block" 
                                                      onsubmit="return confirm('ATENCIÓ: Vols eliminar la categoria \'{{ $categoria->nombre }}\'? Si té productes associats, no es podrà eliminar.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold transition duration-150">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

