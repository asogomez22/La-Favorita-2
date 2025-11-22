<x-admin-layout title="Gestión de Pedidos">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-[#2c2c2c]" style="font-family: 'Poppins', sans-serif;">Pedidos</h2>
            <p class="text-gray-500 mt-1">Gestiona y procesa los pedidos de la tienda</p>
        </div>
        <a href="{{ url()->previous() }}" 
           class="flex items-center px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl shadow-sm hover:bg-gray-50 hover:text-[#FF40A8] transition-all duration-300 font-bold">
            <i class="fas fa-arrow-left mr-2"></i>
            Volver
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Pendientes -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Pendientes</p>
                <p class="text-3xl font-bold text-yellow-500 mt-1" id="pendientes-count">{{ session('counters.pendientes', $pendientes) }}</p>
            </div>
            <div class="p-4 bg-yellow-50 rounded-xl group-hover:bg-yellow-100 transition-colors">
                <i class="fas fa-clock text-2xl text-yellow-500"></i>
            </div>
        </div>

        <!-- Listos -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Listos para Recoger</p>
                <p class="text-3xl font-bold text-green-500 mt-1" id="listos-count">{{ session('counters.listos', $listos) }}</p>
            </div>
            <div class="p-4 bg-green-50 rounded-xl group-hover:bg-green-100 transition-colors">
                <i class="fas fa-check-circle text-2xl text-green-500"></i>
            </div>
        </div>

        <!-- Total -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Pedidos</p>
                <p class="text-3xl font-bold text-gray-700 mt-1" id="total-pedidos-count">{{ session('counters.totalPedidos', $totalPedidos) }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl group-hover:bg-gray-100 transition-colors">
                <i class="fas fa-clipboard-list text-2xl text-gray-500"></i>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <form method="GET" action="{{ route('admin.pedidos.index') }}" class="flex flex-col md:flex-row gap-6 items-end">
            
            <!-- Filter by Status -->
            <div class="w-full md:w-1/3">
                <label for="estado" class="block text-sm font-bold text-gray-700 mb-2">Estado</label>
                <div class="relative">
                    <select name="estado" id="estado" onchange="this.form.submit()"
                            class="w-full pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF40A8] focus:border-transparent outline-none appearance-none transition-all font-medium text-gray-700">
                        <option value="">Todos los estados</option>
                        <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>🚨 Pendiente</option>
                        <option value="En Proceso" {{ request('estado') == 'En Proceso' ? 'selected' : '' }}>⏳ En Proceso</option>
                        <option value="Listo" {{ request('estado') == 'Listo' ? 'selected' : '' }}>📦 Listo</option>
                        <option value="Recogido" {{ request('estado') == 'Recogido' ? 'selected' : '' }}>✅ Recogido</option>
                        <option value="Cancelado" {{ request('estado') == 'Cancelado' ? 'selected' : '' }}>❌ Cancelado</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="w-full md:w-2/3">
                <label for="search" class="block text-sm font-bold text-gray-700 mb-2">Buscar</label>
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" id="search" placeholder="ID, Cliente, Teléfono..."
                               value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF40A8] focus:border-transparent outline-none transition-all font-medium">
                    </div>
                    <button type="submit"
                            class="px-6 py-3 bg-[#FF40A8] text-white font-bold rounded-xl hover:bg-[#f32ba0] transition-colors shadow-lg shadow-pink-500/30">
                        Buscar
                    </button>
                    @if (request()->has('search') || request()->has('estado'))
                        <a href="{{ route('admin.pedidos.index') }}"
                           class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                            Limpiar
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Bulk Actions Form -->
    <form id="bulk-action-form" action="{{ route('admin.pedidos.bulk-action') }}" method="POST">
        @csrf
        
        <!-- Bulk Controls -->
        <div class="bg-white rounded-t-2xl border-b border-gray-100 p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <div class="relative">
                    <select name="bulk_estado" id="bulk_estado"
                            class="pl-4 pr-10 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#FF40A8] outline-none text-sm font-medium appearance-none">
                        <option value="">Cambiar Estado...</option>
                        <option value="Pendiente">🚨 Pendiente</option>
                        <option value="En Proceso">⏳ En Proceso</option>
                        <option value="Listo">📦 Listo</option>
                        <option value="Recogido">✅ Recogido</option>
                        <option value="Cancelado">❌ Cancelado</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
                
                <button type="button" id="update-status-btn" onclick="updateStatus()" disabled
                        class="px-4 py-2 bg-[#a3b48c] text-white text-sm font-bold rounded-lg hover:bg-[#8a9a74] disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    Actualizar
                </button>
                
                <button type="submit" name="action" value="delete" disabled
                        onclick="return validateBulkAction('delete', '¿Estás seguro de que quieres eliminar los pedidos seleccionados?')"
                        class="px-4 py-2 bg-red-50 text-red-600 text-sm font-bold rounded-lg hover:bg-red-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>

            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" id="header-checkbox" class="w-5 h-5 text-[#FF40A8] border-gray-300 rounded focus:ring-[#FF40A8]" onclick="toggleSelectAll(this)">
                    <span class="text-sm font-bold text-gray-600">Seleccionar todo</span>
                </label>
            </div>
        </div>

        <!-- Feedback Message -->
        <div id="status-message" class="hidden mx-6 mt-4 p-4 rounded-xl text-sm font-bold shadow-sm"></div>

        <!-- Table -->
        <div class="bg-white shadow-sm border-x border-b border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-left">
                            <th class="px-6 py-4 w-10"></th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Cliente</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pedidosPaginados as $pedido)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="selected_pedidos[]" value="{{ $pedido->id }}"
                                           class="w-5 h-5 text-[#FF40A8] border-gray-300 rounded focus:ring-[#FF40A8] pedido-checkbox"
                                           onclick="updateBulkButtons()">
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">#{{ $pedido->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden shrink-0">
                                            @if ($pedido->productos->isNotEmpty() && $pedido->productos->first()->imagen)
                                                <img src="{{ asset('storage/' . $pedido->productos->first()->imagen) }}" 
                                                     class="h-full w-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center h-full text-gray-400">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        @if($pedido->productos->count() > 1)
                                            <span class="ml-2 text-xs font-bold bg-gray-100 text-gray-600 px-2 py-1 rounded-full">+{{ $pedido->productos->count() - 1 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $pedido->cliente_nombre }}</div>
                                    <div class="text-xs text-gray-500">{{ $pedido->cliente_telefono }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pedido->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $pedido->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $clases = match ($pedido->estado) {
                                            'Pendiente' => 'bg-yellow-100 text-yellow-700',
                                            'En Proceso' => 'bg-blue-100 text-blue-700',
                                            'Listo' => 'bg-green-100 text-green-700',
                                            'Recogido', 'Completado' => 'bg-indigo-100 text-indigo-700',
                                            'Cancelado' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full {{ $clases }}" data-pedido-id="{{ $pedido->id }}">
                                        {{ $pedido->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-[#FF40A8]">{{ number_format($pedido->precio_total, 2, ',', '.') }}€</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.pedidos.show', $pedido) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-lg hover:bg-[#FF40A8] hover:text-white transition-colors" title="Ver Detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-search text-3xl text-gray-400"></i>
                                        </div>
                                        <p class="text-lg font-medium">No se encontraron pedidos</p>
                                        <p class="text-sm mt-1">Intenta ajustar los filtros de búsqueda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                {{ $pedidosPaginados->appends(request()->query())->links() }}
            </div>
        </div>
    </form>

    <!-- JavaScript Logic -->
    <script>
        function toggleSelectAll(headerCheckbox) {
            const checkboxes = document.querySelectorAll('.pedido-checkbox');
            checkboxes.forEach(cb => cb.checked = headerCheckbox.checked);
            updateBulkButtons();
        }

        function updateBulkButtons() {
            const checkboxes = document.querySelectorAll('.pedido-checkbox:checked');
            const anyChecked = checkboxes.length > 0;
            const updateButton = document.getElementById('update-status-btn');
            const deleteButton = document.querySelector('button[name="action"][value="delete"]');
            
            updateButton.disabled = !anyChecked;
            deleteButton.disabled = !anyChecked;

            // Sync header checkbox
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
                alert('Selecciona al menos un pedido.');
                return false;
            }
            if (action === 'delete') {
                return confirm(message);
            }
            return true;
        }

        async function updateStatus() {
            const checkboxes = document.querySelectorAll('.pedido-checkbox:checked');
            const estado = document.getElementById('bulk_estado').value;
            const statusMessage = document.getElementById('status-message');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            
            statusMessage.classList.add('hidden');
            
            if (checkboxes.length === 0) {
                showStatusMessage('Selecciona al menos un pedido.', 'error');
                return;
            }
            if (!estado) {
                showStatusMessage('Selecciona un estado.', 'error');
                return;
            }
            if (!confirm(`¿Cambiar estado de ${checkboxes.length} pedidos a "${estado}"?`)) {
                return;
            }

            const selectedPedidos = Array.from(checkboxes).map(cb => cb.value);

            try {
                const response = await fetch("{{ route('admin.pedidos.bulk-action') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'update_status',
                        selected_pedidos: selectedPedidos,
                        bulk_estado: estado
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showStatusMessage(result.message || 'Estado actualizado.', 'success');
                    
                    // Update badges
                    if (result.updated_pedidos) {
                        result.updated_pedidos.forEach(p => {
                            const badge = document.querySelector(`span[data-pedido-id="${p.id}"]`);
                            if (badge) {
                                badge.textContent = p.estado;
                                badge.className = `px-3 py-1 inline-flex text-xs font-bold rounded-full ${getStatusClasses(p.estado)}`;
                            }
                        });
                    }
                    
                    // Update counters
                    if (result.counters) {
                        document.getElementById('pendientes-count').textContent = result.counters.pendientes ?? 0;
                        document.getElementById('listos-count').textContent = result.counters.listos ?? 0;
                        document.getElementById('total-pedidos-count').textContent = result.counters.totalPedidos ?? 0;
                    }

                    checkboxes.forEach(cb => cb.checked = false);
                    updateBulkButtons();
                } else {
                    showStatusMessage(result.message || 'Error al actualizar.', 'error');
                }
            } catch (error) {
                console.error(error);
                showStatusMessage('Error de conexión.', 'error');
            }
        }

        function showStatusMessage(message, type) {
            const el = document.getElementById('status-message');
            el.textContent = message;
            el.className = `mx-6 mt-4 p-4 rounded-xl text-sm font-bold shadow-sm ${type === 'error' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'}`;
            el.classList.remove('hidden');
            setTimeout(() => el.classList.add('hidden'), 5000);
        }

        function getStatusClasses(estado) {
            switch (estado) {
                case 'Pendiente': return 'bg-yellow-100 text-yellow-700';
                case 'En Proceso': return 'bg-blue-100 text-blue-700';
                case 'Listo': return 'bg-green-100 text-green-700';
                case 'Recogido':
                case 'Completado': return 'bg-indigo-100 text-indigo-700';
                case 'Cancelado': return 'bg-red-100 text-red-700';
                default: return 'bg-gray-100 text-gray-700';
            }
        }

        document.addEventListener('DOMContentLoaded', updateBulkButtons);
    </script>
</x-admin-layout>
