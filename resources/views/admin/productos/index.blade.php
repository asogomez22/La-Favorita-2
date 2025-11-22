{{-- resources/views/admin/productos/index.blade.php --}}
<x-app-layout title="Productos">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Gestión de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mb-4">
                        <a href="{{ route('admin.productos.create') }}" 
                           class="inline-block px-4 py-2 bg-[#FF40A8] text-white rounded-lg shadow-md hover:bg-[#f32ba0] transition-all duration-200 transform hover:-translate-y-1 font-bold">
                            Añadir Nuevo Producto
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Activo</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Destacado</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Novedad</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($productos as $producto)
                                    <tr class="align-middle">
                                        <!-- IMAGEN + NOMBRE -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-4">
                                                <div class="shrink-0 h-16 w-16 overflow-hidden rounded-md bg-gray-100">
                                                    @if ($producto->imagen)
                                                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                                             alt="{{ $producto->nombre }}" 
                                                             class="h-full w-full object-cover">
                                                    @else
                                                        <div class="flex items-center justify-center h-full w-full text-gray-400">
                                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 14m6-6l.01.01"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</div>
                                            </div>
                                        </td>

                                        <!-- CATEGORÍA -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $producto->categoria?->nombre ?? 'Sin categoría' }}
                                        </td>

                                        <!-- PRECIO -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ number_format($producto->precio, 2) }} €
                                        </td>

                                        <!-- TOGGLE: ACTIVO -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <label class="relative inline-block w-14 h-7 cursor-pointer">
                                                <input type="checkbox" class="sr-only toggle-checkbox" 
                                                       data-id="{{ $producto->id }}" data-field="activo"
                                                       {{ $producto->activo ? 'checked' : '' }}>
                                                <span class="block bg-gray-300 rounded-full h-7 w-full transition-colors duration-300"></span>
                                                <span class="absolute left-0 top-0 h-7 w-7 bg-white border-2 border-gray-300 rounded-full shadow-md transform transition-transform duration-300"></span>
                                            </label>
                                        </td>

                                        <!-- TOGGLE: DESTACADO -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <label class="relative inline-block w-14 h-7 cursor-pointer">
                                                <input type="checkbox" class="sr-only toggle-checkbox" 
                                                       data-id="{{ $producto->id }}" data-field="destacado"
                                                       {{ $producto->destacado ? 'checked' : '' }}>
                                                <span class="block bg-gray-300 rounded-full h-7 w-full transition-colors duration-300"></span>
                                                <span class="absolute left-0 top-0 h-7 w-7 bg-white border-2 border-gray-300 rounded-full shadow-md transform transition-transform duration-300"></span>
                                            </label>
                                        </td>

                                        <!-- NOVEDAD: Radio estilo con checkbox -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <label class="flex items-center justify-center cursor-pointer">
                                                <input 
                                                    type="checkbox" 
                                                    class="novedad-checkbox sr-only" 
                                                    data-id="{{ $producto->id }}"
                                                    {{ $producto->novedad ? 'checked' : '' }}
                                                >
                                                <div class="w-6 h-6 border-2 border-pink-500 rounded-full flex items-center justify-center transition-all duration-200">
                                                    <div class="w-3 h-3 bg-pink-500 rounded-full scale-0 transition-transform duration-200 checked:scale-100"></div>
                                                </div>
                                            </label>
                                        </td>

                                        <!-- ACCIONES -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.productos.edit', $producto) }}" 
                                               class="text-[#FF40A8] hover:text-[#FF80B8] font-bold">Editar</a>
                                            
                                            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('¿Eliminar?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No hay productos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS PURO (sin @apply) -->
    <style>
        /* Estilo del radio de novedad */
        .novedad-checkbox:checked ~ div > div {
            transform: scale(1);
        }
        .novedad-checkbox:checked ~ div {
            border-color: #ec4899;
        }
    </style>

    <!-- JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const novedadCheckboxes = document.querySelectorAll('.novedad-checkbox');
        const toggles = document.querySelectorAll('.toggle-checkbox');

        // ========================================
        // 1. NOVEDAD: Solo 1 + desmarcar
        // ========================================
        novedadCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', async function () {
                const id = this.dataset.id;
                const isChecked = this.checked;

                if (isChecked) {
                    novedadCheckboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                    await updateNovedad(id, true);
                } else {
                    await updateNovedad(id, false);
                }
            });
        });

        async function updateNovedad(id, value) {
            try {
                const res = await fetch(`/admin/productos/${id}/set-novedad`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ novedad: value })
                });
                const data = await res.json();
                if (data.success) {
                    showToast(data.message, 'success');
                } else {
                    showToast('Error', 'error');
                    location.reload();
                }
            } catch (err) {
                showToast('Error de red', 'error');
                location.reload();
            }
        }

        // ========================================
        // 2. TOGGLES
        // ========================================
        toggles.forEach(toggle => {
            const updateToggle = async () => {
                const id = toggle.dataset.id;
                const field = toggle.dataset.field;
                const checked = toggle.checked;

                try {
                    const res = await fetch(`/admin/productos/${id}/toggle/${field}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ [field]: checked })
                    });
                    const data = await res.json();

                    if (data.success) {
                        const bg = toggle.nextElementSibling;
                        const knob = bg.nextElementSibling;
                        bg.classList.toggle('bg-pink-500', checked);
                        knob.classList.toggle('translate-x-7', checked);
                        knob.classList.toggle('border-pink-500', checked);
                        showToast(data.message, 'success');
                    } else {
                        toggle.checked = !checked;
                        showToast('Error', 'error');
                    }
                } catch (err) {
                    toggle.checked = !checked;
                    showToast('Error de red', 'error');
                }
            };

            toggle.addEventListener('change', updateToggle);

            // Estado inicial
            const bg = toggle.nextElementSibling;
            const knob = bg.nextElementSibling;
            bg.classList.toggle('bg-pink-500', toggle.checked);
            knob.classList.toggle('translate-x-7', toggle.checked);
            knob.classList.toggle('border-pink-500', toggle.checked);
        });

        // ========================================
        // 3. TOAST
        // ========================================
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.textContent = message;
            toast.className = `fixed bottom-5 right-5 px-5 py-3 rounded-xl shadow-lg text-white font-semibold z-50 transition-all duration-300 ${type === 'success' ? 'bg-pink-500' : 'bg-red-500'}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.add('opacity-100'), 10);
            setTimeout(() => toast.remove(), 2800);
        }
    });
    </script>
</x-app-layout>