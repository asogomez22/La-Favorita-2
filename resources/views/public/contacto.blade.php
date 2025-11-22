@extends('layouts.public')

@section('content')
    <section class="relative bg-brand-dark py-20 lg:py-28 text-center overflow-hidden border-b-4 border-brand-dark">
        <div class="absolute inset-0 z-0 opacity-40" style="background-image: url('{{ asset('fotos/hero.jpg') }}'); background-size: cover; background-position: center;"></div>
        <div class="absolute inset-0 bg-brand-dark/60 backdrop-blur-[2px]"></div>
        
        <div class="relative z-10 fade-in-element px-4">
            <span class="inline-block bg-brand-pink text-white font-bold tracking-[0.2em] uppercase mb-4 text-xs md:text-sm px-4 py-1 rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#FFF]">Estamos Aquí Para Ti</span>
            <h1 class="font-serif text-5xl md:text-7xl font-black text-brand-cream tracking-tight drop-shadow-[4px_4px_0px_#000]">Ponte en Contacto</h1>
            <p class="mt-6 text-lg md:text-xl text-brand-cream/90 font-medium max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                ¿Tienes una pregunta sobre un pedido, una consulta para un evento especial o simplemente quieres saludarnos?
            </p>
        </div>
    </section>

    <section class="py-20 lg:py-24 bg-brand-cream">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">

                <div class="w-full lg:w-3/5 fade-in-element" style="transition-delay: 150ms;">
                    <div class="bg-white p-8 lg:p-12 rounded-3xl shadow-[8px_8px_0px_#B2C9AE] border-4 border-brand-dark relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-pink/10 rounded-bl-full -mr-16 -mt-16"></div>
                        
                        <h3 class="font-serif text-3xl lg:text-4xl font-black text-brand-dark mb-8 relative z-10">Envíanos un mensaje</h3>
                        
                        <form action="{{ route('contacto.enviar') }}" method="POST" class="space-y-6 relative z-10">
                            @csrf 
                            @if(session('success'))
                                <div class="p-4 rounded-xl bg-brand-green/20 text-brand-dark border-2 border-brand-green font-bold shadow-[4px_4px_0px_#B2C9AE]">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="nombre" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="w-full bg-gray-50 border-2 border-brand-dark rounded-lg px-4 py-3 text-brand-dark font-bold focus:outline-none focus:border-brand-pink focus:shadow-[4px_4px_0px_#FF69B4] transition-all" placeholder="Tu nombre" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Email</label>
                                    <input type="email" id="email" name="email" class="w-full bg-gray-50 border-2 border-brand-dark rounded-lg px-4 py-3 text-brand-dark font-bold focus:outline-none focus:border-brand-pink focus:shadow-[4px_4px_0px_#FF69B4] transition-all" placeholder="tu@email.com" required>
                                </div>
                            </div>

                            <div>
                                <label for="asunto" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Asunto</label>
                                <input type="text" id="asunto" name="asunto" class="w-full bg-gray-50 border-2 border-brand-dark rounded-lg px-4 py-3 text-brand-dark font-bold focus:outline-none focus:border-brand-pink focus:shadow-[4px_4px_0px_#FF69B4] transition-all" placeholder="Ej: Pedido para evento" required>
                            </div>

                            <div>
                                <label for="mensaje" class="block text-sm font-bold text-brand-dark mb-2 uppercase tracking-wide">Mensaje</label>
                                <textarea id="mensaje" name="mensaje" rows="5" class="w-full bg-gray-50 border-2 border-brand-dark rounded-lg px-4 py-3 text-brand-dark font-bold focus:outline-none focus:border-brand-pink focus:shadow-[4px_4px_0px_#FF69B4] transition-all" placeholder="Escribe tu consulta aquí..." required></textarea>
                            </div>

                            <div>
                                <button type="submit" class="w-full sm:w-auto px-10 py-4 text-lg font-black text-white bg-brand-dark rounded-lg border-2 border-brand-dark shadow-[4px_4px_0px_#FF69B4] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none hover:bg-brand-pink transition-all duration-300 uppercase tracking-wide">
                                    Enviar Mensaje
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="w-full lg:w-2/5 fade-in-element" style="transition-delay: 300ms;">
                    <h3 class="font-serif text-3xl lg:text-4xl font-black text-brand-dark mb-8">Información Directa</h3>
                    <div class="space-y-6">
                        
                        <div class="flex items-start gap-5 group p-6 bg-white rounded-2xl border-2 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] hover:shadow-[6px_6px_0px_#FF69B4] hover:-translate-y-1 transition-all duration-300">
                            <div class="shrink-0 p-3 bg-brand-cream rounded-full border-2 border-brand-dark">
                                <svg class="w-6 h-6 text-brand-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.828-1.45-5.156-3.778-6.606-6.606l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-brand-dark uppercase">Llámanos</h4>
                                <p class="text-gray-600 text-sm font-medium mb-1">Para pedidos o consultas rápidas.</p>
                                <a href="tel:+34000000000" class="inline-block text-brand-pink text-lg font-bold hover:text-brand-dark transition border-b-2 border-transparent hover:border-brand-dark">+34 000 000 000</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-5 group p-6 bg-white rounded-2xl border-2 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] hover:shadow-[6px_6px_0px_#FF69B4] hover:-translate-y-1 transition-all duration-300">
                            <div class="shrink-0 p-3 bg-brand-cream rounded-full border-2 border-brand-dark">
                                <svg class="w-6 h-6 text-brand-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.625a2.25 2.25 0 01-2.86 0l-7.5-4.625A2.25 2.25 0 012.25 6.993V6.75" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-brand-dark uppercase">Escríbenos</h4>
                                <p class="text-gray-600 text-sm font-medium mb-1">Para pedidos especiales o eventos.</p>
                                <a href="mailto:pedidos@lafavorita.com" class="inline-block text-brand-pink text-lg font-bold hover:text-brand-dark transition border-b-2 border-transparent hover:border-brand-dark">pedidos@lafavorita.com</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-5 group p-6 bg-white rounded-2xl border-2 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] hover:shadow-[6px_6px_0px_#FF69B4] hover:-translate-y-1 transition-all duration-300">
                            <div class="shrink-0 p-3 bg-brand-cream rounded-full border-2 border-brand-dark">
                                <svg class="w-6 h-6 text-brand-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-brand-dark uppercase">Horario de Tienda</h4>
                                <ul class="text-gray-600 text-sm font-bold mt-2 space-y-1">
                                    <li class="flex justify-between w-48 border-b border-gray-200 pb-1"><span>Lu – Ju:</span> <span>16:30 – 22:00</span></li>
                                    <li class="flex justify-between w-48 border-b border-gray-200 pb-1"><span>Viernes:</span> <span>16:30 – 22:30</span></li>
                                    <li class="flex justify-between w-48 border-b border-gray-200 pb-1"><span>Sábado:</span> <span>16:00 – 22:30</span></li>
                                    <li class="flex justify-between w-48 text-brand-pink pt-1"><span>Domingo:</span> <span>Cerrado</span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection