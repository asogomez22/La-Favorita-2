@extends('layouts.public')

@section('content')
    <div class="bg-brand-cream min-h-screen flex flex-col">
        <div class="bg-brand-dark py-16">
            <div class="container mx-auto px-6 md:px-12 lg:px-24 text-center">
                <h1 class="text-4xl md:text-5xl font-black font-serif text-brand-cream tracking-tight">Finalizar la Compra</h1>
                <p class="mt-4 text-lg text-brand-cream/80 font-medium">¡Ya casi lo tienes! Necesitamos algunos datos para preparar tu pedido.</p>
            </div>
        </div>

        <div class="py-12 sm:py-16 grow">
            <div class="container mx-auto px-6 md:px-12 lg:px-24">
                
                @if ($errors->any() || session('error'))
                    <div class="mb-8 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg max-w-4xl mx-auto shadow-md">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-bold text-base">Ha ocurrido un problema</p>
                                @if ($errors->any())
                                    <ul class="mt-2 list-disc list-inside text-sm font-medium">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm mt-1 font-medium">{{ session('error') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if (empty($cart))
                    <div class="text-center py-16 max-w-lg mx-auto">
                        <svg class="mx-auto h-16 w-16 text-brand-dark/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="mt-4 text-xl text-brand-dark font-bold">Tu carrito está vacío.</p>
                        <p class="mt-2 text-gray-600 font-medium">Añade productos para poder finalizar la compra.</p>
                        <a href="{{ route('public.menu') }}"
                           class="mt-8 inline-flex items-center px-8 py-3 text-base font-bold text-white bg-brand-pink rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#1C1C1C] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                            Volver al Menú
                        </a>
                    </div>
                @else
                    <form action="{{ route('cart.startCheckout') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                            
                            <div class="bg-white p-8 rounded-2xl shadow-[8px_8px_0px_#B2C9AE] border-2 border-brand-dark">
                                <h2 class="text-2xl font-black font-serif text-brand-dark mb-6 uppercase">Tus Datos</h2>
                                <div class="space-y-6">
                                    <div>
                                        <label for="cliente_nombre" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Nombre Completo</label>
                                        <input type="text" id="cliente_nombre" name="cliente_nombre" value="{{ old('cliente_nombre', auth()->user()->name ?? '') }}" class="block w-full p-3 bg-gray-50 border-2 border-brand-dark rounded-lg text-brand-dark focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition-colors @error('cliente_nombre') border-red-500 @enderror" required autocomplete="name">
                                        @error('cliente_nombre')<p class="mt-1 text-sm text-red-500 font-bold">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="cliente_email" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Correo Electrónico</label>
                                        <input type="email" id="cliente_email" name="cliente_email" value="{{ old('cliente_email', auth()->user()->email ?? '') }}" class="block w-full p-3 bg-gray-50 border-2 border-brand-dark rounded-lg text-brand-dark focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition-colors @error('cliente_email') border-red-500 @enderror" required autocomplete="email">
                                        @error('cliente_email')<p class="mt-1 text-sm text-red-500 font-bold">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="cliente_telefono" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Teléfono de Contacto</label>
                                        <input type="tel" id="cliente_telefono" name="cliente_telefono" value="{{ old('cliente_telefono', auth()->user()->phone ?? '') }}" class="block w-full p-3 bg-gray-50 border-2 border-brand-dark rounded-lg text-brand-dark focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition-colors @error('cliente_telefono') border-red-500 @enderror" required autocomplete="tel">
                                        @error('cliente_telefono')<p class="mt-1 text-sm text-red-500 font-bold">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="notas" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Notas para el pedido (opcional)</label>
                                        <textarea id="notas" name="notas" rows="4" class="block w-full p-3 bg-gray-50 border-2 border-brand-dark rounded-lg text-brand-dark focus:outline-none focus:border-brand-pink focus:ring-1 focus:ring-brand-pink transition-colors">{{ old('notas') }}</textarea>
                                        @error('notas')<p class="mt-1 text-sm text-red-500 font-bold">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="lg:sticky lg:top-32">
                                <div class="bg-white p-8 rounded-2xl shadow-[8px_8px_0px_#FF69B4] border-2 border-brand-dark">
                                    <h2 class="text-2xl font-black font-serif text-brand-dark mb-6 uppercase">Resumen del Pedido</h2>
                                    <div class="space-y-4 mb-6 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                                        @foreach($cart as $id => $details)
                                            <div class="flex justify-between items-center text-base pb-3 border-b-2 border-brand-dark/10 last:border-b-0">
                                                <div class="flex items-center gap-4">
                                                    <img src="{{ $details['imagen'] ? asset('storage/' . $details['imagen']) : 'https://placehold.co/100x100/2c2c2c/E91E63?text=Pastel' }}" alt="{{ $details['nombre'] }}" class="h-14 w-14 object-cover rounded-lg border border-brand-dark">
                                                    <div>
                                                        <span class="font-bold text-brand-dark block">{{ $details['nombre'] }}</span>
                                                        <span class="text-gray-600 block text-sm font-medium">Cantidad: {{ $details['cantidad'] }}</span>
                                                    </div>
                                                </div>
                                                <span class="text-brand-dark font-bold">{{ number_format(($details['precio'] ?? 0) * ($details['cantidad'] ?? 0), 2, ',', '.') }}€</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="border-t-2 border-brand-dark pt-6 mt-auto">
                                        <div class="flex justify-between items-center font-black text-2xl text-brand-dark">
                                            <span>Total</span>
                                            <span class="font-serif text-3xl text-brand-pink">{{ number_format($total, 2, ',', '.') }}€</span>
                                        </div>
                                    </div>
                                    <div class="mt-8">
                                        <button type="submit" class="w-full px-8 py-4 bg-brand-dark text-white text-lg font-bold rounded-lg hover:bg-brand-pink transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-3 border-2 border-brand-dark">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            Continuar al Pago Seguro
                                        </button>
                                        <p class="mt-4 text-xs text-gray-500 text-center font-medium">Serás redirigido a la plataforma de pago segura de Stripe.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection