@extends('layouts.public')

@section('content')
    <div class="py-12 md:py-20 bg-brand-cream">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                {{-- Columna de Imagen (Sticky) --}}
                <div class="lg:sticky lg:top-32">
                    <div class="relative w-full rounded-3xl overflow-hidden border-4 border-brand-dark shadow-[8px_8px_0px_#B2C9AE]">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/'. $producto->imagen) }}" alt="{{ $producto->nombre }}" 
                                 class="w-full h-auto object-cover transition-transform duration-500 ease-out hover:scale-105 transform"
                                 loading="eager">
                        @else
                            <div class="flex items-center justify-center h-96 bg-gray-100 text-gray-400 text-2xl font-bold">
                                Imagen no disponible
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Columna de Detalles y Compra --}}
                <div x-data="productoCompra" class="space-y-8">
                    
                    {{-- Bloque de Título y Descripción --}}
                    <div>
                        <h1 class="font-serif text-4xl md:text-6xl font-black text-brand-dark mb-2 leading-tight uppercase">{{ $producto->nombre }}</h1>
                        <p class="text-brand-pink text-lg font-bold uppercase tracking-widest">{{ $producto->categoria?->nombre ?? 'Cheesecake' }}</p>
                        <p class="text-gray-600 text-lg mt-4 leading-relaxed font-medium">{{ $producto->descripcion }}</p>
                    </div>
                    
                    {{-- Bloque de Precio y CTA --}}
                    <div class="pt-6 border-t-2 border-brand-dark space-y-6">
                        <span class="block text-5xl font-black text-brand-pink drop-shadow-[2px_2px_0px_rgba(28,28,28,1)]">{{ number_format($producto->precio, 2, ',', '.') }} €</span>

                        <form action="{{ route('cart.add', $producto) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4" onsubmit="event.preventDefault(); $dispatch('add-to-cart', { productId: {{ $producto->id }}, quantity: quantity });">

                            @csrf

                            <div class="flex items-center border-2 border-brand-dark rounded-full overflow-hidden shadow-[4px_4px_0px_#B2C9AE]">
                                <button type="button" @click="quantity = Math.max(1, quantity - 1)" class="p-3 bg-white text-brand-dark hover:bg-gray-100 transition duration-200 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path></svg>
                                </button>

                                <input type="number" x-model="quantity" name="cantidad" min="1"
                                       class="w-16 text-xl font-bold text-center bg-white border-none focus:outline-none p-2 text-brand-dark">

                                <button type="button" @click="quantity++" class="p-3 bg-white text-brand-dark hover:bg-gray-100 transition duration-200 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>

                            <button type="submit" class="flex items-center justify-center w-full sm:w-auto px-8 py-3 bg-brand-dark text-white text-lg font-black rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#FF69B4] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none hover:bg-brand-pink transition-all duration-300">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span>Añadir al Carrito</span>
                            </button>
                        </form>
                    </div>

                    {{-- Información adicional en Acordeón --}}
                    <div class="space-y-4">
                        @php
                            $accordionItems = [
                                [
                                    'title' => 'Alérgenos',
                                    'content' => 'Contiene: lácteos, gluten, huevos. Puede contener trazas de frutos secos.'
                                ]
                            ];
                        @endphp

                        @foreach($accordionItems as $item)
                            <div x-data="{ open: false }" class="border-2 border-brand-dark rounded-xl overflow-hidden bg-white shadow-[4px_4px_0px_#B2C9AE]">
                                <button @click="open =!open" :aria-expanded="open" 
                                        class="w-full flex justify-between items-center p-5 font-black text-lg text-brand-dark 
                                               hover:bg-gray-50 transition duration-300 focus:outline-none">
                                    <span class="flex items-center gap-3">
                                        <span class="text-brand-pink text-2xl">•</span>
                                        {{ $item['title'] }}
                                    </span>
                                    <svg class="w-6 h-6 text-brand-dark transition-transform transform shrink-0 duration-300" 
                                         :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <div x-show="open" 
                                     x-collapse.duration.400ms 
                                     class="p-5 pt-0 border-t-2 border-brand-dark/10 text-gray-600 font-medium bg-white transition-all duration-300">
                                    <p class="pt-4">{{ $item['content'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div> 
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de Productos relacionados --}}
    @if(isset($relacionados) && $relacionados->isNotEmpty())
    <section class="py-16 bg-white border-t-4 border-brand-dark">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            <h3 class="font-serif text-3xl md:text-4xl font-black text-center text-brand-dark mb-12 uppercase">
                También te podría gustar...
            </h3>
            
            <div class="flex flex-wrap justify-center gap-6">
                @foreach($relacionados as $relacionado)
                    <div class="w-full sm:w-1/2 lg:w-1/4 flex justify-center">
                        {{-- Tarjeta simplificada para relacionados --}}
                        <a href="{{ route('producto.detalle', $relacionado->id) }}" class="group block w-full bg-white rounded-xl overflow-hidden border-2 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] hover:shadow-[6px_6px_0px_#FF69B4] hover:-translate-y-1 transition-all duration-300">
                            <div class="relative aspect-square overflow-hidden border-b-2 border-brand-dark">
                                <img src="{{ $relacionado->imagen ? asset('storage/' . $relacionado->imagen) : 'https://placehold.co/400x400' }}" 
                                     alt="{{ $relacionado->nombre }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="p-4 text-center">
                                <h4 class="font-serif text-lg font-black text-brand-dark truncate uppercase">{{ $relacionado->nombre }}</h4>
                                <p class="text-brand-pink font-bold mt-1">{{ number_format($relacionado->precio, 2, ',', '.') }} €</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('public.menu') }}" class="inline-flex items-center px-8 py-3 border-2 border-brand-dark rounded-full text-brand-dark font-bold hover:bg-brand-dark hover:text-white transition-colors shadow-[4px_4px_0px_#1C1C1C] hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver al Menú
                </a>
            </div>
        </div>
    </section>
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('productoCompra', () => ({
                quantity: 1,
                
                init() {
                }
            }));
        });
    </script>
@endsection