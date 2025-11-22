<x-admin-layout title="Detalle Pedido">
    <x-slot name="header">
        <div class="flex items-center justify-between py-4 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight" style="font-family: 'Inter', sans-serif;">
                Pedido #{{ $pedido->id }}
            </h1>
            <a href="{{ route('admin.pedidos.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-[#FF40A8] rounded-full hover:bg-[#E03694] transition duration-300 shadow-xs hover:shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Botón adicional para volver atrás -->
            <div class="mb-6">
                <a href="{{ route('admin.pedidos.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 hover:text-gray-900 transition duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la lista
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <!-- Columna Izquierda: Estado + Cliente -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Card: Estado del Pedido -->
                    <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Estado</h3>
                            <span class="text-xs text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                        </div>

                        @php
                            $estadoConfig = [
                                'Pendiente' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'En Proceso' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                'Listo' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'icon' => 'M5 13l4 4L19 7'],
                                'Recogido' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'Cancelado' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'icon' => 'M6 18L18 6M6 6l12 12'],
                            ];
                            $config = $estadoConfig[$pedido->estado] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'];
                        @endphp

                        <div class="flex items-center gap-3 mb-5">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $config['bg'] }}">
                                <svg class="w-5 h-5 {{ $config['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                </svg>
                            </span>
                            <span class="text-xl font-medium text-gray-900">{{ $pedido->estado }}</span>
                        </div>

                        <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="estado" class="block text-sm font-medium text-gray-600 mb-2">Cambiar Estado</label>
                            <select name="estado" id="estado"
                                    class="w-full p-3 text-sm border border-gray-200 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-[#FF40A8] focus:border-transparent transition-all">
                                @foreach(['Pendiente', 'En Proceso', 'Listo', 'Recogido', 'Cancelado'] as $estado)
                                    <option value="{{ $estado }}" {{ $pedido->estado == $estado ? 'selected' : '' }}>
                                        {{ $estado }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit"
                                    class="mt-4 w-full py-3 px-4 bg-[#FF40A8] text-white text-sm font-medium rounded-lg hover:bg-[#E03694] transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Actualizar Estado
                            </button>
                        </form>
                    </div>

                    <!-- Card: Datos del Cliente -->
                    <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 transition-all duration-300 hover:shadow-md">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Cliente</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 font-medium">Nombre</span>
                                <span class="text-gray-900">{{ $pedido->cliente_nombre }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 font-medium">Teléfono</span>
                                <a href="tel:{{ $pedido->cliente_telefono }}" class="text-[#FF40A8] hover:underline">
                                    {{ $pedido->cliente_telefono }}
                                </a>
                            </div>
                             <div class="flex items-center justify-between">
                                <span class="text-gray-600 font-medium">Email</span>
                                <a href="mailto:{{ $pedido->cliente_email }}" class="text-[#FF40A8] hover:underline">
                                    {{ $pedido->cliente_email }}
                                </a>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 font-medium">Fecha</span>
                                <span class="text-gray-900">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        @if ($pedido->notas)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-sm font-medium text-gray-600 mb-2">Notas del Cliente</p>
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $pedido->notas }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Columna Derecha: Productos -->
                <div class="md:col-span-3 bg-white p-6 rounded-2xl shadow-xs border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Productos</h3>
                        <span class="text-sm text-gray-600">{{ $pedido->productos->count() }} ítems</span>
                    </div>

                    @if ($pedido->productos->isEmpty())
                        <div class="text-center py-10">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <p class="text-sm text-gray-500 font-medium">No hay productos</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($pedido->productos as $producto)
                                <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-all duration-200 rounded-lg">
                                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                        @if ($producto->imagen)
                                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                 alt="{{ $producto->nombre }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 14"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</h4>
                                            <p class="text-sm font-semibold text-[#FF40A8]">
                                                {{ number_format($producto->pivot->precio_unitario * $producto->pivot->cantidad, 2, ',', '.') }}€
                                            </p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                                        <div class="flex items-center gap-4 text-xs text-gray-600 mt-2">
                                            <span>Cantidad: {{ $producto->pivot->cantidad }}</span>
                                            <span>Unitario: {{ number_format($producto->pivot->precio_unitario, 2, ',', '.') }}€</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-base font-semibold text-gray-900">Total</span>
                            <span class="text-xl font-bold text-[#FF40A8]">
                                {{ number_format($pedido->precio_total, 2, ',', '.') }}€
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>