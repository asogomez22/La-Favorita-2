<x-app-layout title="Pedidos">

    <x-slot name="header">
        {{-- Header estilizado --}}
        <div class="flex items-center justify-between py-6 bg-white border-b border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight" style="font-family: 'Poppins', sans-serif;">
                {{ __('Gestió de Comandes') }}
            </h2>
            {{-- Botón Volver con estilo mejorado --}}
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2 px-6 py-3 text-base font-semibold text-white bg-[#FF40A8] rounded-full hover:bg-[#E03694] transition duration-300 shadow-md hover:shadow-lg focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Contadores globales -->
<!-- Contadores globales -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    <div class="bg-white p-8 rounded-2xl shadow-md border-l-4 border-yellow-500 flex items-center justify-between transition-all duration-300 hover:shadow-lg">
        <div>
            <p class="text-base font-medium text-gray-600">Pedidos Pendientes</p>
            <p class="text-3xl font-bold text-yellow-600" id="pendientes-count">{{ session('counters.pendientes', $pendientes) }}</p>
        </div>
        <svg class="h-8 w-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-md border-l-4 border-green-500 flex items-center justify-between transition-all duration-300 hover:shadow-lg">
        <div>
            <p class="text-base font-medium text-gray-600">Listos para Recoger</p>
            <p class="text-3xl font-bold text-green-600" id="listos-count">{{ session('counters.listos', $listos) }}</p>
        </div>
        <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-md border-l-4 border-gray-500 flex items-center justify-between transition-all duration-300 hover:shadow-lg">
        <div>
            <p class="text-base font-medium text-gray-600">Pedidos Totales </p>
            <p class="text-3xl font-bold text-gray-600" id="total-pedidos-count">{{ session('counters.totalPedidos', $totalPedidos) }}</p>
        </div>
        <svg class="h-8 w-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
        </svg>
    </div>
</div>

            <!-- Formulario de filtros -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 mb-10">
                <form method="GET" action="{{ route('admin.pedidos.index') }}" class="flex flex-col md:flex-row gap-6 items-end">
                    <div class="w-full md:w-1/3">
                        <label for="estado" class="block text-base font-semibold text-gray-700 mb-3">Filtrar por Estado</label>
                        <select name="estado" id="estado" onchange="this.form.submit()"
                                class="w-full p-4 text-base border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:border-transparent transition-all shadow-xs appearance-none bg-white bg-no-repeat bg-right-8"
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23a0aec0%27%3e%3cpath fill-rule=%27evenodd%27 d=%27M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z%27 clip-rule=%27evenodd%27/%3e%3c/svg%3e'); background-position: right 0.75rem center; background-size: 1.5em 1.5em;">
                            <option value="">Todos los pedidos</option>
                            <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>🚨 Pendiente</option>
                            <option value="En Proceso" {{ request('estado') == 'En Proceso' ? 'selected' : '' }}>⏳ En Proceso</option>
                            <option value="Listo" {{ request('estado') == 'Listo' ? 'selected' : '' }}>📦 Listo</option>
                            <option value="Recogido" {{ request('estado') == 'Recogido' ? 'selected' : '' }}>✅ Recogido</option>
                            <option value="Cancelado" {{ request('estado') == 'Cancelado' ? 'selected' : '' }}>❌ Cancelado</option>
                        </select>
                    </div>
                    <div class="w-full md:w-2/3">
                        <label for="search" class="block text-base font-semibold text-gray-700 mb-3">Buscar (ID, Cliente, Teléfono)</label>
                        <div class="flex items-center gap-3">
                            <input type="text" name="search" id="search" placeholder="Escribe para buscar..."
                                   value="{{ request('search') }}"
                                   class="flex-1 p-4 text-base border border-gray-300 rounded-l-lg focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:border-transparent shadow-xs">
                            <button type="submit"
                                    class="px-6 py-4 bg-[#FF40A8] text-white text-base font-semibold rounded-r-lg hover:bg-[#E03694] transition duration-300 shadow-md hover:shadow-lg focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:ring-offset-2">
                                Buscar
                            </button>
                            @if (request()->has('search') || request()->has('estado'))
                                <a href="{{ route('admin.pedidos.index') }}"
                                   class="px-6 py-4 text-base font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-300 shadow-xs focus:outline-hidden focus:ring-2 focus:ring-gray-400 focus:ring-offset-1">
                                    Limpiar
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Formulario para acciones masivas -->
             {{-- CORREGIDO: Añadido action con la ruta correcta --}}
            <form id="bulk-action-form" action="{{ route('admin.pedidos.bulk-action') }}" method="POST">
                @csrf
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-6 p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4 flex-wrap">
                         <label for="bulk_estado" class="text-base font-semibold text-gray-700 whitespace-nowrap">Con la selección:</label>
                        <select name="bulk_estado" id="bulk_estado"
                                class="p-3 text-base border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:border-transparent shadow-xs appearance-none bg-white bg-no-repeat bg-right-8"
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23a0aec0%27%3e%3cpath fill-rule=%27evenodd%27 d=%27M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z%27 clip-rule=%27evenodd%27/%3e%3c/svg%3e'); background-position: right 0.75rem center; background-size: 1.5em 1.5em;">
                            <option value="">Cambiar Estado</option>
                            <option value="Pendiente">🚨 Pendiente</option>
                            <option value="En Proceso">⏳ En Proceso</option>
                            <option value="Listo">📦 Listo</option>
                            <option value="Recogido">✅ Recogido</option>
                            <option value="Cancelado">❌ Cancelado</option>
                        </select>
                        <button type="button" id="update-status-btn"
                                class="px-6 py-3 bg-[#a3b48c] text-white text-base font-semibold rounded-lg hover:bg-[#8a9a74] transition duration-300 disabled:opacity-50 shadow-md hover:shadow-lg focus:outline-hidden focus:ring-2 focus:ring-[#a3b48c] focus:ring-offset-2"
                                onclick="updateStatus()" disabled> 
                            Actualizar Estado
                        </button>
                        <button type="submit" name="action" value="delete"
                                class="px-6 py-3 bg-red-600 text-white text-base font-semibold rounded-lg hover:bg-red-700 transition duration-300 disabled:opacity-50 shadow-md hover:shadow-lg focus:outline-hidden focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                onclick="return validateBulkAction('delete', 'ATENCIÓ: Vols eliminar les comandes seleccionades? Aquesta acció no es pot desfer.')" disabled>
                            Eliminar Selección
                        </button>
                    </div>
                    <div class="flex items-center gap-3 text-base text-gray-700 mt-4 sm:mt-0">
                        <input type="checkbox" id="header-checkbox" class="h-5 w-5 text-[#FF40A8] focus:ring-[#FF40A8] border-gray-300 rounded-sm shadow-xs"
                               onclick="toggleSelectAll(this)">
                        <label for="header-checkbox" class="font-semibold">Seleccionarlo todo</label>
                    </div>
                </div>

                <!-- Mensaje de feedback para AJAX -->
                <div id="status-message" class="hidden mb-6 p-4 rounded-lg text-base shadow-sm"></div>

                <!-- Tabla de pedidos -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-12">
                                     {{-- Checkbox individual en header ya no necesario si tenemos "Seleccionar todo" --}}
                                </th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-16">ID</th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-24">Producto</th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-64">Cliente / Teléfono</th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-48">Fecha / Hora</th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-32">Estado</th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-36">Notas</th>
                                <th class="px-4 py-4 text-left text-sm font-bold text-gray-600 uppercase tracking-wider w-24">Total</th>
                                <th class="px-4 py-4 text-right text-sm font-bold text-gray-600 uppercase tracking-wider w-36">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($pedidosPaginados as $pedido)
                                <tr class="hover:bg-[#FF40A8]/5 transition duration-300 group">
                                    <td class="px-4 py-5 whitespace-nowrap">
                                        <input type="checkbox" name="selected_pedidos[]"
                                               value="{{ $pedido->id }}"
                                               class="h-5 w-5 text-[#FF40A8] focus:ring-[#FF40A8] border-gray-300 rounded-sm shadow-xs pedido-checkbox"
                                               onclick="updateBulkButtons()">
                                    </td>
                                    <td class="px-4 py-5 whitespace-nowrap text-base font-bold text-gray-900 group-hover:text-[#FF40A8]">#{{ $pedido->id }}</td>
                                    <td class="px-4 py-5 whitespace-nowrap">
                                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center border border-gray-200">
                                            @if ($pedido->productos->isNotEmpty() && $pedido->productos->first()->imagen)
                                                <img src="{{ asset('storage/' . $pedido->productos->first()->imagen) }}"
                                                     alt="{{ $pedido->productos->first()->nombre }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 14m6-6l.01.01"></path>                                                </svg>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 whitespace-nowrap text-base text-gray-700">
                                        <div class="font-semibold text-gray-900">{{ $pedido->cliente_nombre }}</div>
                                        <div class="text-gray-500 text-sm">{{ $pedido->cliente_telefono }}</div>
                                        <div class="text-gray-500 text-sm">{{ $pedido->cliente_email }}</div>
                                    </td>
                                    <td class="px-4 py-5 whitespace-nowrap text-base text-gray-700">
                                        <div class="font-semibold text-gray-900">{{ $pedido->created_at->format('d/m/Y') }}</div>
                                        <div class="text-gray-500 text-sm">{{ $pedido->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 py-5 whitespace-nowrap">
                                        @php
                                            $clases = match ($pedido->estado) {
                                                'Pendiente' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                                                'En Proceso' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                                'Listo' => 'bg-green-50 text-green-700 border border-green-200',
                                                'Recogido', 'Completado' => 'bg-indigo-50 text-indigo-700 border border-indigo-200',
                                                'Cancelado' => 'bg-red-50 text-red-700 border border-red-200',
                                                default => 'bg-gray-50 text-gray-700 border border-gray-200',
                                            };
                                        @endphp
                                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full {{ $clases }}"
                                              data-pedido-id="{{ $pedido->id }}">
                                            {{ $pedido->estado }}
                                        </span>
                                    </td>
                                     <td class="px-4 py-5 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate" title="{{ $pedido->notas }}">
                                        {{ \Illuminate\Support\Str::limit($pedido->notas, 10, '...') ?: '--' }}
                                     </td>
                                    <td class="px-4 py-5 whitespace-nowrap text-base font-bold text-[#FF40A8]">{{ number_format($pedido->precio_total, 2, ',', '.') }}€</td>
                                    <td class="px-4 py-5 whitespace-nowrap text-right text-base font-medium">
                                        <a href="{{ route('admin.pedidos.show', $pedido) }}"
                                           class="inline-flex items-center px-6 py-3 text-white text-base font-semibold rounded-lg bg-[#a3b48c] hover:bg-[#8a9a74] transition duration-300 shadow-xs hover:shadow-sm focus:outline-hidden focus:ring-2 focus:ring-[#a3b48c] focus:ring-offset-2">
                                            Detalle
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-16 text-center text-gray-500 text-lg">
                                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Ningún pedido encontrado con los filtros seleccionados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                 <div class="bg-gray-50 px-8 py-6 rounded-b-2xl border-t border-gray-100">
                     {{ $pedidosPaginados->appends(request()->query())->links() }}
                 </div>
            </form>

            <!-- JavaScript para manejar checkboxes y AJAX -->
             <script>
                 // Funciones JS para seleccionar todo, validar y actualizar estado
                function toggleSelectAll(headerCheckbox) {
                    const checkboxes = document.querySelectorAll('.pedido-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = headerCheckbox.checked;
                    });
                    updateBulkButtons(); // Actualiza el estado de los botones
                }

                function updateBulkButtons() {
                    const checkboxes = document.querySelectorAll('.pedido-checkbox:checked');
                    const anyChecked = checkboxes.length > 0;
                    const updateButton = document.getElementById('update-status-btn');
                    const deleteButton = document.querySelector('button[name="action"][value="delete"]');
                    
                    updateButton.disabled = !anyChecked;
                    deleteButton.disabled = !anyChecked;

                    // Sincroniza el checkbox del header si todos están marcados/desmarcados
                    const allCheckboxes = document.querySelectorAll('.pedido-checkbox');
                    const headerCheckbox = document.getElementById('header-checkbox');
                    if (headerCheckbox) {
                        headerCheckbox.checked = anyChecked && checkboxes.length === allCheckboxes.length;
                        headerCheckbox.indeterminate = anyChecked && checkboxes.length < allCheckboxes.length;
                    }
                }

                function validateBulkAction(action, message) {
                    const checkboxes = document.querySelectorAll('.pedido-checkbox:checked');
                    if (checkboxes.length === 0) {
                        alert('Selecciona almenys una comanda per realitzar aquesta acció.');
                        return false;
                    }
                     // Si la acción es 'update_status', no pedimos confirmación aquí, se hace en updateStatus()
                     if (action === 'delete') {
                         return confirm(message);
                     }
                     return true; // Para otras acciones (si las hubiera)
                }

                async function updateStatus() {
                    const checkboxes = document.querySelectorAll('.pedido-checkbox:checked');
                    const estado = document.getElementById('bulk_estado').value;
                    const statusMessage = document.getElementById('status-message');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    
                    // Resetear mensaje
                    statusMessage.classList.add('hidden');
                    statusMessage.textContent = '';
                    statusMessage.className = 'hidden mb-6 p-4 rounded-lg text-base shadow-sm';

                    if (checkboxes.length === 0) {
                        showStatusMessage('Selecciona almenys una comanda per actualitzar.', 'error');
                        return;
                    }

                    if (!estado) {
                        showStatusMessage('Selecciona un estat per actualitzar.', 'error');
                        return;
                    }

                     if (!confirm(`Segur que vols canviar l'estat de ${checkboxes.length} comanda(es) a "${estado}"?`)) {
                         return;
                     }

                    const selectedPedidos = Array.from(checkboxes).map(cb => cb.value);
                    const data = {
                        action: 'update_status', // Indicamos la acción
                        selected_pedidos: selectedPedidos,
                        bulk_estado: estado
                    };

                    try {
                        const response = await fetch("{{ route('admin.pedidos.bulk-action') }}", { // Usamos la ruta nombrada
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json' // Indicamos que esperamos JSON
                            },
                            body: JSON.stringify(data)
                        });

                        const result = await response.json(); // Intentamos parsear como JSON siempre

                        if (response.ok && result.success) {
                            showStatusMessage(result.message || 'Estat actualitzat correctament.', 'success');

                            // Actualizar dinámicamente los badges y contadores si la respuesta los incluye
                            if (result.updated_pedidos) {
                                result.updated_pedidos.forEach(pedidoInfo => {
                                    const badge = document.querySelector(`span[data-pedido-id="${pedidoInfo.id}"]`);
                                    if (badge) {
                                        badge.textContent = pedidoInfo.estado;
                                        badge.className = `px-4 py-2 inline-flex text-sm font-semibold rounded-full ${getStatusClasses(pedidoInfo.estado)}`;
                                    }
                                });
                            }
                            if (result.counters) {
                                document.getElementById('pendientes-count').textContent = result.counters.pendientes ?? 0;
                                document.getElementById('listos-count').textContent = result.counters.listos ?? 0;
                                document.getElementById('total-pedidos-count').textContent = result.counters.totalPedidos ?? 0;
                            }
                            
                            // Desmarcar checkboxes después de la actualización exitosa
                            checkboxes.forEach(cb => cb.checked = false);
                            updateBulkButtons(); // Desactivar botones

                        } else {
                             // Si el servidor responde con error (4xx, 5xx) o success=false
                            showStatusMessage(result.message || 'Error en actualitzar l\'estat.', 'error');
                        }
                    } catch (error) {
                        console.error('Error en la petición fetch:', error);
                        showStatusMessage('Error en la connexió. Torna a intentar-ho.', 'error');
                    }
                }

                function showStatusMessage(message, type) {
                    const statusMessage = document.getElementById('status-message');
                    statusMessage.textContent = message;
                    if (type === 'error') {
                        statusMessage.className = 'mb-6 p-4 rounded-lg text-base bg-red-100 text-red-800 shadow-sm';
                    } else {
                        statusMessage.className = 'mb-6 p-4 rounded-lg text-base bg-green-100 text-green-800 shadow-sm';
                    }
                    statusMessage.classList.remove('hidden');
                     // Opcional: Ocultar el mensaje después de unos segundos
                     setTimeout(() => {
                         statusMessage.classList.add('hidden');
                     }, 5000); // 5 segundos
                }

                function getStatusClasses(estado) {
                    switch (estado) {
                        case 'Pendiente': return 'bg-yellow-50 text-yellow-700 border border-yellow-200';
                        case 'En Proceso': return 'bg-blue-50 text-blue-700 border border-blue-200';
                        case 'Listo': return 'bg-green-50 text-green-700 border border-green-200';
                        case 'Recogido':
                        case 'Completado': return 'bg-indigo-50 text-indigo-700 border border-indigo-200';
                        case 'Cancelado': return 'bg-red-50 text-red-700 border border-red-200';
                        default: return 'bg-gray-50 text-gray-700 border border-gray-200';
                    }
                }

                 // Añadir listeners a los checkboxes individuales para actualizar botones
                 document.querySelectorAll('.pedido-checkbox').forEach(checkbox => {
                     checkbox.addEventListener('change', updateBulkButtons);
                 });
                 
                 // Inicializar estado de botones al cargar la página
                 document.addEventListener('DOMContentLoaded', updateBulkButtons);

            </script>
        </div>
    </div>
</x-app-layout>

