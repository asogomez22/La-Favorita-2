@extends('layouts.public')

@section('content')
    <div class="relative bg-brand-cream min-h-screen flex flex-col">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('fotos/hero.jpg') }}" alt="Fondo de celebración" class="w-full h-full object-cover opacity-10">
        </div>

        <div class="relative z-10 grow flex items-center justify-center py-20 lg:py-24">
            <div class="container mx-auto px-6 md:px-12 lg:px-24">
                <div class="text-center fade-in-element">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-brand-pink/10 border-2 border-brand-pink mb-6">
                        <svg class="h-10 w-10 text-brand-pink" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black font-serif tracking-tight text-brand-dark">
                        ¡Gracias por tu pedido!
                    </h1>
                    <p class="mt-6 text-lg text-gray-600 font-medium max-w-2xl mx-auto">
                        Hemos recibido tu pedido correctamente. ¡Estamos preparando tu momento dulce con todo el cariño!
                    </p>
                </div>

                <div class="max-w-2xl mx-auto mt-12 bg-white rounded-2xl shadow-[8px_8px_0px_#B2C9AE] border-2 border-brand-dark p-8 fade-in-element">
                    <h2 class="text-2xl font-black font-serif text-brand-dark mb-6 text-center uppercase">
                        Resumen del Pedido
                    </h2>
                    <div class="space-y-4 text-brand-dark font-medium">
                        <div class="flex justify-between items-center text-base">
                            <span class="font-bold text-brand-dark">Número de Pedido:</span>
                            <span class="font-mono bg-brand-dark text-white px-3 py-1 rounded-full text-sm font-bold">#{{ $pedido->id }}</span>
                        </div>
                        <div class="flex justify-between text-base border-b border-gray-100 pb-2">
                            <span class="font-bold text-brand-dark">Fecha:</span>
                            <span>{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between text-base border-b border-gray-100 pb-2">
                            <span class="font-bold text-brand-dark">Nombre:</span>
                            <span>{{ $pedido->cliente_nombre }}</span>
                        </div>
                        <div class="flex justify-between text-base border-b border-gray-100 pb-2">
                            <span class="font-bold text-brand-dark">Teléfono:</span>
                            <span>{{ $pedido->cliente_telefono }}</span>
                        </div>
                        @if ($pedido->notas)
                            <div class="pt-4">
                                <span class="font-bold text-brand-dark block mb-2 text-base">Notas Adicionales:</span>
                                <p class="text-gray-600 text-sm italic bg-gray-50 p-4 rounded-lg border border-gray-200">{{ $pedido->notas }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-6 border-t-2 border-brand-dark pt-6">
                        <div class="flex justify-between items-center font-black text-xl">
                            <span class="text-brand-dark">Total:</span>
                            <span class="text-brand-pink font-serif text-3xl">{{ number_format($pedido->precio_total, 2, ',', '.') }}€</span>
                        </div>
                    </div>
                </div>

                <div class="mt-16 text-center fade-in-element">
                    <a href="{{ route('public.inicio') }}"
                       class="inline-flex items-center gap-2 px-8 py-3 text-base font-bold text-white bg-brand-pink rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#1C1C1C] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Volver al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection