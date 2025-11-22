<x-admin-layout title="Gestión de Categorías">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-[#2c2c2c]" style="font-family: 'Poppins', sans-serif;">Categorías</h2>
            <p class="text-gray-500 mt-1">Organiza tus productos en categorías</p>
        </div>
        <a href="{{ route('admin.categorias.create') }}" 
           class="flex items-center px-6 py-3 bg-[#FF40A8] text-white rounded-xl shadow-lg shadow-pink-500/30 hover:bg-[#f32ba0] hover:shadow-pink-500/40 transition-all duration-300 transform hover:-translate-y-1 font-bold">
            <i class="fas fa-plus mr-2"></i>
            Nueva Categoría
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-left">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($categorias as $categoria)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                            
                            <!-- Name -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="shrink-0 w-10 h-10 rounded-full bg-[#a3b48c]/10 flex items-center justify-center text-[#a3b48c]">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $categoria->nombre }}</span>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.categorias.edit', $categoria) }}" 
                                       class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" title="Editar">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" 
                                          onsubmit="return confirm('ATENCIÓ: Vols eliminar la categoria \'{{ $categoria->nombre }}\'? Si té productes associats, no es podrà eliminar.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-tags text-3xl text-gray-400"></i>
                                    </div>
                                    <p class="text-lg font-medium">No hay categorías todavía</p>
                                    <p class="text-sm mt-1">Crea tu primera categoría para organizar tus productos.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

