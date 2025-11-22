{{-- resources/views/admin/productos/index.blade.php --}}
<x-admin-layout title="Gestión de Productos">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-[#2c2c2c]" style="font-family: 'Poppins', sans-serif;">Productos</h2>
            <p class="text-gray-500 mt-1">Gestiona el catálogo de tu tienda</p>
        </div>
        <a href="{{ route('admin.productos.create') }}" 
           class="flex items-center px-6 py-3 bg-[#FF40A8] text-white rounded-xl shadow-lg shadow-pink-500/30 hover:bg-[#f32ba0] hover:shadow-pink-500/40 transition-all duration-300 transform hover:-translate-y-1 font-bold">
            <i class="fas fa-plus mr-2"></i>
            Nuevo Producto
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-left">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Destacado</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Novedad</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($productos as $producto)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                            
                            <!-- Product Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="shrink-0 h-14 w-14 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                                        @if ($producto->imagen)
                                            <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                                 alt="{{ $producto->nombre }}" 
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full w-full text-gray-400">
                                                <i class="fas fa-image text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-900">{{ $producto->nombre }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-[150px]">{{ $producto->descripcion }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="px-6 py-4">
                                @if($producto->categoria)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#a3b48c]/10 text-[#a3b48c]">
                                        {{ $producto->categoria->nombre }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>

                            <!-- Price -->
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">{{ number_format($producto->precio, 2) }} €</span>
                            </td>

                            <!-- Active Toggle -->
                            <td class="px-6 py-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer toggle-checkbox" 
                                           data-id="{{ $producto->id }}" data-field="activo"
                                           {{ $producto->activo ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF40A8]"></div>
                                </label>
                            </td>

                            <!-- Featured Toggle -->
                            <td class="px-6 py-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer toggle-checkbox" 
                                           data-id="{{ $producto->id }}" data-field="destacado"
                                           {{ $producto->destacado ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-400"></div>
                                </label>
                            </td>

                            <!-- New Radio -->
                            <td class="px-6 py-4 text-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer novedad-checkbox" 
                                           data-id="{{ $producto->id }}"
                                           {{ $producto->novedad ? 'checked' : '' }}>
                                    <div class="w-6 h-6 border-2 border-gray-300 rounded-full peer-checked:border-[#FF40A8] peer-checked:bg-[#FF40A8] flex items-center justify-center transition-all duration-200">
                                        <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100 transform scale-50 peer-checked:scale-100 transition-all"></i>
                                    </div>
                                </label>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.productos.edit', $producto) }}" 
                                       class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" title="Editar">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" 
                                          onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
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
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-3xl text-gray-400"></i>
                                    </div>
                                    <p class="text-lg font-medium">No hay productos todavía</p>
                                    <p class="text-sm mt-1">Empieza añadiendo uno nuevo a tu catálogo.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Toggles -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Toast Function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-5 right-5 px-6 py-4 rounded-xl shadow-2xl text-white font-bold z-50 transform transition-all duration-500 translate-y-20 opacity-0 flex items-center gap-3 ${type === 'success' ? 'bg-gradient-to-r from-green-500 to-green-600' : 'bg-gradient-to-r from-red-500 to-red-600'}`;
            toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-xl"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);
            
            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
            });

            // Animate out
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        // Handle Novedad (Single Selection)
        const novedadCheckboxes = document.querySelectorAll('.novedad-checkbox');
        novedadCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', async function() {
                const id = this.dataset.id;
                const isChecked = this.checked;

                // Uncheck others if checked
                if (isChecked) {
                    novedadCheckboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                }

                try {
                    const res = await fetch(`/admin/productos/${id}/set-novedad`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ novedad: isChecked })
                    });
                    const data = await res.json();
                    
                    if (data.success) {
                        showToast('Producto destacado como novedad actualizado');
                    } else {
                        this.checked = !isChecked; // Revert
                        showToast('Error al actualizar', 'error');
                    }
                } catch (err) {
                    this.checked = !isChecked;
                    showToast('Error de conexión', 'error');
                }
            });
        });

        // Handle Standard Toggles (Activo / Destacado)
        const toggles = document.querySelectorAll('.toggle-checkbox');
        toggles.forEach(toggle => {
            toggle.addEventListener('change', async function() {
                const id = this.dataset.id;
                const field = this.dataset.field;
                const isChecked = this.checked;

                try {
                    const res = await fetch(`/admin/productos/${id}/toggle/${field}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ [field]: isChecked })
                    });
                    const data = await res.json();

                    if (data.success) {
                        showToast(`Estado de ${field} actualizado`);
                    } else {
                        this.checked = !isChecked;
                        showToast('Error al actualizar', 'error');
                    }
                } catch (err) {
                    this.checked = !isChecked;
                    showToast('Error de conexión', 'error');
                }
            });
        });
    });
    </script>
</x-admin-layout>