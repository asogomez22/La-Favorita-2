@extends('layouts.public')

@section('content')
    <div class="bg-brand-cream min-h-screen flex flex-col">
        <div class="bg-brand-dark py-16">
            <div class="container mx-auto px-6 md:px-12 lg:px-24 text-center">
                <h1 class="text-4xl md:text-5xl font-black font-serif text-brand-cream tracking-tight">Tu Carrito</h1>
            </div>
        </div>

        <div class="py-12 sm:py-16 grow">
            <div class="container mx-auto px-6 md:px-12 lg:px-24">
                @if (empty($cart))
                    <div class="text-center py-16 max-w-lg mx-auto">
                        <svg class="mx-auto h-16 w-16 text-brand-dark/50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>
                        <p class="mt-4 text-xl text-brand-dark font-bold">El carrito está vacío.</p>
                        <a href="{{ route('public.menu') }}" class="mt-8 inline-block px-8 py-3 bg-brand-pink text-white font-bold rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#1C1C1C] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                            Ver la Carta
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 items-start">
                        <div class="lg:col-span-2 space-y-6">
                            @foreach($cart as $id => $details)
                                <div x-data="{ quantity: {{ $details['cantidad'] }} }" class="bg-white p-6 rounded-xl border-2 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] flex flex-col sm:flex-row items-center gap-6">
                                    <img src="{{ $details['imagen'] ? asset('storage/' . $details['imagen']) : 'https://placehold.co/150x150/2c2c2c/E91E63?text=Pastis' }}" alt="{{ $details['nombre'] ?? 'Producto' }}" class="w-24 h-24 object-cover rounded-lg border border-brand-dark shrink-0">
                                    
                                    <div class="grow text-center sm:text-left">
                                        <a href="{{ route('producto.detalle', $id) }}" class="text-lg font-black font-serif text-brand-dark hover:text-brand-pink transition uppercase">{{ $details['nombre'] }}</a>
                                        <p class="text-sm text-gray-600 mt-1 font-bold">{{ number_format($details['precio'], 2, ',', '.') }}€ / unidad</p>
                                    </div>
                                    
                                    <div class="flex items-center gap-4 mt-4 sm:mt-0">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                            @csrf
                                            <div class="flex items-center border-2 border-brand-dark rounded-lg overflow-hidden">
                                                <button type="button" @click="quantity = Math.max(1, quantity - 1)" class="p-2 bg-gray-100 text-brand-dark hover:bg-gray-200 transition font-bold">-</button>
                                                <input type="number" name="cantidad" x-model="quantity" min="1" class="w-12 bg-white text-brand-dark text-center border-x-2 border-brand-dark focus:outline-none font-bold">
                                                <button type="button" @click="quantity++" class="p-2 bg-gray-100 text-brand-dark hover:bg-gray-200 transition font-bold">+</button>
                                            </div>
                                            <button type="submit" x-show="quantity != {{ $details['cantidad'] }}" class="ml-3 text-xs font-bold text-brand-pink hover:underline uppercase" title="Actualizar cantidad">Actualizar</button>
                                        </form>

                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Eliminar producto">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="lg:sticky lg:top-32">
                            <div class="bg-white p-8 rounded-2xl border-2 border-brand-dark shadow-[8px_8px_0px_#FF69B4]">
                                <h2 class="text-2xl font-black font-serif text-brand-dark mb-6 uppercase">Resumen</h2>
                                <div class="space-y-3 text-brand-dark font-medium">
                                    <div class="flex justify-between">
                                        <span>Subtotal</span>
                                        <span>{{ number_format($total, 2, ',', '.') }}€</span>
                                    </div>
                                </div>
                                <div class="border-t-2 border-brand-dark pt-6 mt-6">
                                    <div class="flex justify-between items-center font-black text-2xl text-brand-dark">
                                        <span>Total</span>
                                        <span class="font-serif text-3xl text-brand-pink">{{ number_format($total, 2, ',', '.') }}€</span>
                                    </div>
                                </div>
                                <div class="mt-8 space-y-4">
                                    <a href="{{ route('cart.checkout') }}" class="w-full block text-center px-8 py-4 bg-brand-dark text-white text-lg font-bold rounded-lg hover:bg-brand-pink transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        Finalizar Compra
                                    </a>
                                    <a href="{{ route('public.menu') }}" class="w-full block text-center text-gray-500 font-bold hover:text-brand-dark transition">
                                        o Seguir Comprando
                                    </a>
                                </div>
                                <div class="mt-6 text-center">
                                     <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('¿Seguro que quieres vaciar todo el carrito?');">
                                        @csrf
                                        <button type="submit" class="text-sm text-gray-400 hover:text-red-500 transition underline font-bold">
                                            Vaciar Carrito
                                        </button>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection