    <header class="sticky top-0 z-50 w-full bg-primary-black/90 backdrop-blur-md shadow-lg">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 ">
            
            <a href="{{ route('public.inicio') }}" class="shrink-0 flex items-center gap-2 mt-[-200px]" title="La Favorita Xees Keyk">
                <img class="h-72 w-auto" src="{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}" alt="Logo La Favorita Xees Keyk">
            </a>
            
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('public.menu') }}" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">El Nostre Menú</a>
                <a href="#historia" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">La Nostra Història</a>
                <a href="#galeria" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">Galeria</a>
                <a href="#contacto" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">Contacte</a>
            </div>
            
            <div class="flex items-center gap-4">
                 <a href="{{ route('cart.index') }}" class="relative text-text-light hover:text-accent-pink transition" title="Veure el carret">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                    @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-accent-pink text-xs font-bold text-primary-black">{{ $cartCount }}</span>
                    @endif
                </a>
                <div class="md:hidden">
                    <button id="menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-text-light hover:text-accent-pink hover:bg-bg-dark-secondary" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Obrir menú principal</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="md:hidden hidden bg-primary-black border-t border-gray-800" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('public.menu') }}" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">El Nostre Menú</a>
            <a href="#historia" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">La Nostra Història</a>
            <a href="#galeria" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">Galeria</a>
            <a href="#contacto" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">Contacte</a>
        </div>
    </div>
</header>
