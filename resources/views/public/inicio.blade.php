@extends('layouts.public')

@section('content')
    <section class="relative min-h-[85vh] flex items-center justify-center bg-brand-cream overflow-hidden">
        <div class="absolute top-0 right-0 w-full h-full bg-brand-green opacity-20 rounded-bl-[40%] -z-10 translate-x-1/4 -translate-y-1/4"></div>

        <div class="container mx-auto px-6 md:px-12 lg:px-24 grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <div class="text-center lg:text-left fade-in-element z-10 mt-8 lg:mt-0 order-2 lg:order-1">
                <h1 class="font-serif text-5xl xs:text-6xl md:text-7xl lg:text-8xl font-black text-brand-dark leading-[0.9] tracking-tighter">
                    LA FAVORITA <br>
                    <span class="text-brand-pink drop-shadow-[3px_3px_0px_rgba(28,28,28,1)]">XEES KEYK</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-brand-dark font-medium max-w-lg mx-auto lg:mx-0 leading-relaxed">
                    Cheesecakes artesanales que rompen las reglas. <br class="hidden md:block">Sabor atrevido, textura perfecta.
                </p>
                <div class="mt-10 flex flex-col xs:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('public.menu') }}" class="px-8 py-4 bg-brand-pink text-white font-bold rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#1C1C1C] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all text-center">
                        Ver el Menú
                    </a>
                    <a href="#historia" class="px-8 py-4 bg-white text-brand-dark font-bold rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#1C1C1C] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all text-center">
                        Historia
                    </a>
                </div>
            </div>
            
            <div class="relative fade-in-element order-1 lg:order-2">
                <div class="absolute inset-0 bg-brand-pink rounded-full blur-3xl opacity-20 animate-pulse"></div>
                <img src="{{ asset('fotos/inicio.jpg') }}" 
                     alt="Cheesecake Hero" 
                     class="relative z-10 w-full max-w-xs sm:max-w-md mx-auto lg:max-w-full rounded-3xl border-4 border-brand-dark shadow-[8px_8px_0px_#B2C9AE] rotate-2 hover:rotate-0 transition-transform duration-500"
                     onerror="this.src='https://placehold.co/600x600/B2C9AE/1C1C1C?text=La+Favorita'">
            </div>
        </div>
    </section>
    
    @php $novedad = \App\Models\Producto::where('novedad', true)->first(); @endphp
    @if($novedad)
    <section id="novedad" class="py-20 bg-brand-green border-y-4 border-brand-dark">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-center lg:text-left text-brand-dark order-2 lg:order-1">
                    <span class="inline-block bg-brand-dark text-white px-4 py-1 rounded-full text-sm font-bold uppercase tracking-widest mb-4">
                        Novedad Exclusiva
                    </span>
                    <h2 class="font-serif text-4xl sm:text-5xl lg:text-7xl font-black leading-none mb-4">
                        {{ $novedad->nombre }}
                    </h2>
                    <p class="text-4xl sm:text-5xl font-black text-white drop-shadow-[3px_3px_0px_rgba(28,28,28,1)] mb-6">
                        {{ number_format($novedad->precio, 2, ',', '.') }}€
                    </p>
                    <p class="text-lg font-medium max-w-md mx-auto lg:mx-0 mb-8">
                        {{ $novedad->descripcion ?? 'Nueva creación exclusiva. Sabor único.' }}
                    </p>
                    <div class="flex flex-col xs:flex-row justify-center lg:justify-start gap-4">
                        <a href="{{ route('producto.detalle', $novedad) }}" class="px-8 py-3 bg-white text-brand-dark font-bold rounded-lg border-2 border-brand-dark hover:bg-brand-pink hover:text-white transition-colors text-center">Ver Detalle</a>
                        <form action="{{ route('cart.add', $novedad) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full xs:w-auto px-8 py-3 bg-brand-dark text-white font-bold rounded-lg border-2 border-brand-dark hover:bg-gray-800 transition-colors">
                                Añadir
                            </button>
                        </form>
                    </div>
                </div>

                <div class="relative order-1 lg:order-2">
                    <img src="{{ $novedad->imagen ? asset('storage/' . $novedad->imagen) : '' }}" 
                         alt="{{ $novedad->nombre }}" 
                         class="w-full h-auto object-cover rounded-3xl border-4 border-brand-dark shadow-[8px_8px_0px_#FF69B4] transform -rotate-2 hover:rotate-0 transition duration-500"
                         onerror="this.src='https://placehold.co/600x600/FF69B4/FFFFFF?text=Novedad'">
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(isset($productosDestacados) && $productosDestacados->isNotEmpty())
    <section id="sabores" class="py-16 md:py-20 bg-brand-cream">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center mb-10 md:mb-16 fade-in-element">
                <h2 class="font-serif text-4xl md:text-6xl font-black text-brand-dark">Los Favoritos</h2>
                <div class="h-2 w-20 md:w-24 bg-brand-pink mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="flex flex-wrap justify-center gap-3 md:gap-6">
                @foreach($productosDestacados as $producto)
                    <div class="group desktop-hover-trigger 
                                w-[calc(50%-0.4rem)] md:w-[calc(33.33%-1rem)] xl:w-[calc(25%-1.125rem)]
                                bg-white rounded-xl overflow-hidden 
                                border-2 md:border-4 border-brand-dark 
                                shadow-[4px_4px_0px_#B2C9AE] hover:shadow-[6px_6px_0px_#FF69B4] 
                                hover:-translate-y-1 transition-all duration-300 flex flex-col">
                        
                        <a href="{{ route('producto.detalle', $producto->id) }}" class="block overflow-hidden aspect-4/3 border-b-2 md:border-b-4 border-brand-dark relative">
                            <img src="{{ $producto->imagen ? asset('storage/'. $producto->imagen) : '' }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 onerror="this.src='https://placehold.co/400x300/F9F9F9/1C1C1C?text=Sin+Foto'">
                            
                            <div class="absolute top-2 right-2 bg-brand-pink text-white font-bold px-2 py-0.5 rounded-sm text-xs md:text-sm border border-brand-dark shadow-xs z-10">
                                {{ number_format($producto->precio, 2, ',', '.') }}€
                            </div>
                        </a>

                        <div class="p-3 md:p-5 flex flex-col grow">
                            <h3 class="font-serif text-sm md:text-xl font-black text-brand-dark uppercase leading-tight mb-1 md:mb-2 truncate">
                                {{ $producto->nombre }}
                            </h3>
                            <p class="text-xs md:text-sm text-gray-600 line-clamp-2 mb-3 grow font-medium leading-snug">
                                {{ $producto->descripcion }}
                            </p>
                            <div class="mt-auto pt-1">
                                <form action="{{ route('cart.add', $producto) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-1 md:gap-2 py-2 md:py-3 px-2 rounded-lg font-bold border border-brand-dark transition-all duration-300 bg-brand-dark text-white text-xs md:text-sm hover:bg-brand-pink lg:bg-white lg:text-brand-dark lg:group-hover:bg-brand-dark lg:group-hover:text-white">
                                        <span>Añadir</span>
                                        <svg class="hidden md:block w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section id="indeciso" class="py-24 bg-brand-dark text-brand-cream relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, #333 0, #333 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>

        <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16"
                 x-data='{
                     todos: @json($todosLosProductos ?? []),
                     selected: null,
                     shuffling: false,
                     fallbackImage: "{{ asset("fotos/logo.png") }}",
                     baseStorage: "{{ asset("storage") }}/",

                     getImageUrl() {
                        if (!this.selected || !this.selected.imagen) {
                            return this.fallbackImage;
                        }
                        return this.baseStorage + this.selected.imagen;
                     },

                     roulette() {
                        if(this.shuffling || this.todos.length === 0) return;
                        this.shuffling = true;
                        this.selected = null;
                        let steps = 0;
                        let maxSteps = 20;
                        let interval = setInterval(() => {
                            this.selected = this.todos[Math.floor(Math.random() * this.todos.length)];
                            steps++;
                            if(steps >= maxSteps) {
                                clearInterval(interval);
                                this.shuffling = false;
                            }
                        }, 100);
                     }
                 }'>

                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <span class="text-brand-green font-bold uppercase tracking-widest">¿Indeciso?</span>
                    <h2 class="mt-2 font-serif text-4xl sm:text-5xl lg:text-6xl font-black text-white">
                        Deja que el <span class="text-brand-pink">Destino</span> Elija
                    </h2>
                    <p class="mt-6 text-lg text-gray-300 max-w-lg mx-auto lg:mx-0">
                        Nuestro algoritmo goloso seleccionará la porción perfecta para tu estado de ánimo.
                    </p>
                    <button @click="roulette()" :disabled="shuffling" class="mt-8 px-10 py-4 bg-brand-green text-brand-dark font-black text-lg rounded-full border-2 border-white shadow-[4px_4px_0px_#FFF] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all active:scale-95">
                        <span x-show="!shuffling">¡SORPRÉNDEME!</span>
                        <span x-show="shuffling">GIRANDO...</span>
                    </button>
                </div>

                <div class="w-full lg:w-1/2 flex justify-center h-[450px] items-center">
                    <div class="relative w-full max-w-md bg-white rounded-3xl p-4 border-4 border-brand-pink shadow-[0_0_40px_rgba(255,105,180,0.3)] min-h-[400px] flex flex-col justify-center items-center transition-all duration-300"
                         :class="{'scale-105 rotate-1 shadow-[0_0_60px_rgba(255,105,180,0.5)]': shuffling}">
                        
                        <template x-if="!selected">
                             <div class="text-center text-brand-dark opacity-50">
                                <svg class="w-24 h-24 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="font-bold text-xl">Pulsa el botón</p>
                             </div>
                        </template>

                        <template x-if="selected">
                            <div class="w-full h-full flex flex-col animate-fadeIn">
                                <div class="relative grow overflow-hidden rounded-xl border-2 border-brand-dark mb-4 bg-gray-100">
                                    <img :src="getImageUrl()" 
                                         class="w-full h-full object-cover absolute inset-0"
                                         alt="Tarta seleccionada">
                                </div>
                                <div class="text-center pb-2">
                                    <h3 class="font-serif text-2xl sm:text-3xl font-black text-brand-dark leading-tight" x-text="selected.nombre"></h3>
                                    <p class="text-brand-pink font-bold text-2xl mt-2" x-text="`${parseFloat(selected.precio).toFixed(2)}€`"></p>
                                    <a :href="`/producto/${selected.id}`" x-show="!shuffling" class="mt-4 inline-block px-6 py-2 bg-brand-dark text-white font-bold rounded-full hover:bg-brand-pink transition">Ver Detalle</a>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="historia" class="py-20 bg-brand-cream">
        <div class="container mx-auto px-6 md:px-12 lg:px-24 flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('fotos/horno.png') }}" 
                     class="w-full h-auto rounded-3xl border-4 border-brand-dark shadow-[10px_10px_0px_#B2C9AE]"
                     onerror="this.src='https://placehold.co/800x600/1C1C1C/FFFFFF?text=Historia'">
            </div>
            <div class="w-full lg:w-1/2 fade-in-element text-center lg:text-left">
                <h2 class="font-serif text-4xl sm:text-5xl font-black text-brand-dark mb-6">No es solo Pastel,<br>es <span class="text-brand-pink underline decoration-wavy decoration-brand-green">Arte</span>.</h2>
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">"La Favorita Xees Keyk" nació de la rebeldía. Cansados de los postres aburridos, decidimos crear cheesecakes con personalidad propia.</p>
                <a href="{{ route('public.menu') }}" class="inline-block font-bold text-brand-dark border-b-4 border-brand-pink hover:text-brand-pink hover:border-brand-green transition-colors pb-1">Leer más sobre nosotros -></a>
            </div>
        </div>
    </section>

    <section id="galeria" class="py-24 bg-white border-t-4 border-brand-dark">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-element">
                <h2 class="text-sm font-bold text-brand-pink tracking-[0.2em] uppercase mb-2">El Arte del Placer</h2>
                <h2 class="font-serif text-5xl font-black text-brand-dark leading-tight">Galería Visual</h2>
                <p class="mt-6 text-lg text-gray-600 font-medium">Cada imagen captura la esencia de nuestra pasión.</p>
                <div class="h-2 w-24 bg-brand-green mx-auto mt-6 rounded-full border-2 border-brand-dark"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 auto-rows-[250px] md:auto-rows-[300px]">
                @php
                    $galleryItems = [
                        ['img' => 'fotos/index/1.png', 'span' => '', 'delay' => '0ms'],
                        ['img' => 'fotos/index/2.png', 'span' => '', 'delay' => '100ms'],
                        ['img' => 'fotos/index/3.png', 'span' => '', 'delay' => '200ms'],
                        ['img' => 'fotos/index/4.png', 'span' => '', 'delay' => '300ms'],
                        ['img' => 'fotos/index/5.png', 'span' => 'col-span-2', 'delay' => '0ms'], 
                        ['img' => 'fotos/index/6.png', 'span' => '', 'delay' => '100ms'],
                        ['img' => 'fotos/index/7.png', 'span' => '', 'delay' => '200ms'],
                    ];
                @endphp
                @foreach($galleryItems as $item)
                    <div class="relative group rounded-xl overflow-hidden border-4 border-brand-dark shadow-[6px_6px_0px_#B2C9AE] hover:shadow-[8px_8px_0px_#FF69B4] hover:-translate-y-1 transition-all duration-300 cursor-pointer {{ $item['span'] }} fade-in-element"
                         style="transition-delay: {{ $item['delay'] }}"
                         @click="galleryOpen = true; galleryImage = '{{ asset($item['img']) }}'">
                        
                        <img src="{{ asset($item['img']) }}" alt="Galería" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             onerror="this.src='https://placehold.co/600x400/1C1C1C/FFFFFF?text=Foto+Galeria'">
                        
                        <div class="absolute inset-0 bg-brand-dark/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="bg-white p-3 rounded-full border-2 border-brand-dark shadow-md transform scale-0 group-hover:scale-100 transition-transform duration-300 delay-100">
                                <svg class="w-6 h-6 text-brand-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div x-show="galleryOpen" 
         class="fixed inset-0 z-100 bg-brand-dark/95 backdrop-blur-md flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         x-cloak>
        <div class="relative max-w-6xl w-full max-h-full flex flex-col items-center" @click.outside="galleryOpen = false">
            <button @click="galleryOpen = false" class="absolute -top-12 right-0 text-white hover:text-brand-pink transition transform hover:rotate-90 duration-300">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            <img :src="galleryImage" class="w-auto max-h-[85vh] object-contain rounded-xl border-4 border-brand-dark shadow-[0_0_50px_rgba(0,0,0,0.5)]">
        </div>
    </div>
@endsection