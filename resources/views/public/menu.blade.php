@extends('layouts.public')

@section('content')
    {{-- Alpine.js State Management --}}
    <div x-data="{
          searchQuery: '',
          showBackToTop: false,
          activeCategory: '',
          
          clearSearch() {
              this.searchQuery = '';
          },
          
          productMatchesSearch(productName) {
              if (this.searchQuery === '') return true;
              return productName.toLowerCase().includes(this.searchQuery.toLowerCase());
          },

          hasResults() {
              if (this.searchQuery === '') return true;
              let products = Array.from(document.querySelectorAll('.product-card'));
              return products.some(p => this.productMatchesSearch(p.dataset.name));
          },

          scrollToCategory(id) {
              const element = document.getElementById(id);
              if (element) {
                  const offset = 180; // Adjust for sticky header + nav
                  const elementPosition = element.getBoundingClientRect().top;
                  const offsetPosition = elementPosition + window.pageYOffset - offset;
                  
                  window.scrollTo({
                      top: offsetPosition,
                      behavior: 'smooth'
                  });
              }
          }
      }"
      @scroll.window="showBackToTop = (window.scrollY > 400); 
                      // Simple scroll spy logic
                      const sections = document.querySelectorAll('.category-section');
                      let current = '';
                      sections.forEach(section => {
                          const sectionTop = section.offsetTop;
                          if (window.scrollY >= (sectionTop - 250)) {
                              current = section.getAttribute('id');
                          }
                      });
                      activeCategory = current;"
      class="min-h-screen bg-brand-cream">

        {{-- Hero Section --}}
        <section class="relative h-[40vh] min-h-[300px] flex items-center justify-center overflow-hidden border-b-4 border-brand-dark">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('fotos/hero.jpg') }}" alt="Menu Hero" class="w-full h-full object-cover object-center scale-105 motion-safe:animate-subtle-zoom">
                <div class="absolute inset-0 bg-brand-dark/50 backdrop-blur-[2px]"></div>
            </div>
            
            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto fade-in-element">
                <span class="block text-brand-pink font-bold tracking-[0.2em] uppercase mb-2 text-sm md:text-base bg-brand-dark inline-block px-4 py-1 rounded-full border border-brand-pink shadow-[2px_2px_0px_#FF69B4]">Nuestra Carta</span>
                <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-black text-white mb-4 tracking-tight drop-shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                    Sabores <span class="text-brand-pink">Inolvidables</span>
                </h1>
            </div>
        </section>

        {{-- Sticky Navigation & Search --}}
        <div class="sticky top-[60px] md:top-[80px] z-40 bg-brand-cream/95 backdrop-blur-xl border-b-2 border-brand-dark shadow-md transition-all duration-300">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3 md:py-4">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    
                    {{-- Categories --}}
                    <div class="flex-1 w-full md:w-auto overflow-x-auto pb-2 md:pb-0 hide-scrollbar">
                        <div class="flex items-center gap-2 md:gap-4 min-w-max px-1">
                            @foreach ($categoriasConProductos as $categoria)
                                <button @click="scrollToCategory('categoria-{{ $categoria->id }}')"
                                        class="px-4 md:px-5 py-2 rounded-full text-xs md:text-sm font-bold transition-all duration-300 border-2 uppercase tracking-wide"
                                        :class="activeCategory === 'categoria-{{ $categoria->id }}' 
                                            ? 'bg-brand-dark text-white border-brand-dark shadow-[2px_2px_0px_#FF69B4] transform -translate-y-0.5' 
                                            : 'bg-white text-brand-dark border-brand-dark hover:bg-brand-pink hover:text-white hover:border-brand-dark'">
                                    {{ $categoria->nombre }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Search --}}
                    <div class="w-full md:w-auto md:min-w-[300px] relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-brand-dark group-focus-within:text-brand-pink transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input x-model.debounce.300ms="searchQuery" 
                               type="text" 
                               placeholder="BUSCAR SABOR..."
                               class="w-full bg-white border-2 border-brand-dark rounded-full py-2 pl-10 pr-10 text-brand-dark font-bold placeholder-gray-400 focus:outline-none focus:ring-0 focus:border-brand-pink focus:shadow-[4px_4px_0px_#FF69B4] transition-all uppercase text-sm">
                        <button x-show="searchQuery" 
                                @click="clearSearch" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-pink transition-colors">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Main Content --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 space-y-20">
            
            @foreach ($categoriasConProductos as $categoria)
                <div id="categoria-{{ $categoria->id }}" class="category-section scroll-mt-48">
                    
                    {{-- Category Header --}}
                    <div class="flex items-end gap-4 mb-8 border-b-4 border-brand-dark/10 pb-2">
                        <h2 class="font-serif text-3xl md:text-5xl font-black text-brand-dark uppercase tracking-tight">{{ $categoria->nombre }}</h2>
                        <div class="h-4 w-4 bg-brand-pink rounded-full mb-2 animate-pulse"></div>
                    </div>

                    {{-- Products Grid --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 lg:gap-8">
                        @forelse ($categoria->productos->where('activo', true) as $producto)
                            <div class="product-card group relative flex flex-col bg-white rounded-xl overflow-hidden border-2 md:border-4 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] hover:shadow-[6px_6px_0px_#FF69B4] hover:-translate-y-1 transition-all duration-300" 
                                 data-name="{{ $producto->nombre }}" 
                                 x-show="productMatchesSearch('{{ $producto->nombre }}')" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100">
                                
                                <a href="{{ route('producto.detalle', $producto->id) }}" class="block overflow-hidden aspect-4/3 border-b-2 md:border-b-4 border-brand-dark relative">
                                    <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '' }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                         onerror="this.src='https://placehold.co/400x300/F9F9F9/1C1C1C?text=Sin+Foto'">
                                    
                                    <div class="absolute top-2 right-2 bg-brand-pink text-white font-bold px-2 py-0.5 rounded-sm text-xs md:text-sm border border-brand-dark shadow-sm z-10">
                                        {{ number_format($producto->precio, 2, ',', '.') }}€
                                    </div>
                                </a>

                                <div class="p-3 md:p-5 flex flex-col grow">
                                    <h3 class="font-serif text-sm md:text-xl font-black text-brand-dark uppercase leading-tight mb-1 md:mb-2 truncate group-hover:text-brand-pink transition-colors">
                                        {{ $producto->nombre }}
                                    </h3>
                                    <p class="text-xs md:text-sm text-gray-600 line-clamp-2 mb-3 grow font-medium leading-snug">
                                        {{ $producto->descripcion }}
                                    </p>
                                    <div class="mt-auto pt-1">
                                        <form action="{{ route('cart.add', $producto) }}" method="POST" class="w-full" onsubmit="addToCart(event, this.action)">

                                            @csrf
                                            <button type="submit" class="w-full flex items-center justify-center gap-1 md:gap-2 py-2 md:py-3 px-2 rounded-lg font-bold border border-brand-dark transition-all duration-300 bg-brand-dark text-white text-xs md:text-sm hover:bg-brand-pink lg:bg-white lg:text-brand-dark lg:group-hover:bg-brand-dark lg:group-hover:text-white cursor-pointer">

                                                <span>Añadir</span>
                                                <svg class="hidden md:block w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center bg-white rounded-2xl border-2 border-dashed border-brand-dark/30">
                                <p class="text-gray-500 font-medium italic">Próximamente nuevos sabores irresistibles en esta categoría.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

            {{-- No Results State --}}
            <div x-show="!hasResults()" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="text-center py-24 bg-white rounded-3xl shadow-[8px_8px_0px_#B2C9AE] border-4 border-brand-dark max-w-2xl mx-auto"
                 style="display: none;">
                <div class="bg-brand-cream w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-brand-dark">
                    <svg class="h-10 w-10 text-brand-pink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold text-brand-dark mb-2">No encontramos ese antojo</h3>
                <p class="text-gray-500 font-medium">No hay productos que coincidan con "<span x-text="searchQuery" class="font-bold text-brand-dark"></span>".</p>
                <button @click="clearSearch" class="mt-6 px-6 py-2 bg-brand-dark text-white font-bold rounded-full hover:bg-brand-pink transition border-2 border-brand-dark shadow-[4px_4px_0px_#B2C9AE] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">
                    Ver todo el menú
                </button>
            </div>

        </div>
        
        {{-- Back to Top --}}
        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                x-show="showBackToTop"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="fixed bottom-8 right-8 bg-brand-dark text-white p-3 md:p-4 rounded-full border-2 border-brand-dark shadow-[4px_4px_0px_#FF69B4] hover:bg-brand-pink hover:-translate-y-1 transition-all duration-300 z-50 group"
                aria-label="Volver arriba">
            <svg class="h-6 w-6 group-hover:animate-bounce" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        @keyframes subtle-zoom {
            0% { transform: scale(1.05); }
            100% { transform: scale(1.1); }
        }
        .animate-subtle-zoom {
            animation: subtle-zoom 20s infinite alternate ease-in-out;
        }
    </style>
@endsection