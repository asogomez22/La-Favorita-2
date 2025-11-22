<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'La Favorita Xees Keyk')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-black': '#0a0a0a',
                        'bg-dark-secondary': '#1a1a1a',
                        'text-light': '#f5f5f5',
                        'accent-pink': '#ff69b4',
                        'light-pink': '#ff8dc7',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .hover\:scale-105:hover { transform: scale(1.05); }
    </style>

    @stack('styles')
</head>
<body class="bg-primary-black text-text-light font-sans min-h-screen flex flex-col">

{{-- ================== TU HEADER EXACTO ================== --}}
<header class="sticky top-0 z-50 w-full bg-primary-black/90 backdrop-blur-md shadow-lg">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <div class="flex items-center gap-12">
                <a href="{{ route('public.inicio') }}" class="shrink-0 flex items-center gap-2" title="La Favorita Xees Keyk">
                    <img class="h-72 w-auto" src="{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}" alt="Logo La Favorita Xees Keyk">
                </a>

                <div class="hidden md:flex md:items-center md:space-x-8 ml-[80px]">
                    <a href="{{ route('public.menu') }}" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">Nuestro Menú</a>
                    <a href="#historia" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">Nuestra Historia</a>
                    <a href="#galeria" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">Galería</a>
                    <a href="{{ route('public.contacto') }}" class="text-text-light hover:text-accent-pink transition duration-300 font-medium">Contacto</a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative text-text-light hover:text-accent-pink transition" title="Ver el carrito">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-accent-pink text-xs font-bold text-primary-black">{{ $cartCount }}</span>
                    @endif
                </a>

                <div class="md:hidden">
                    <button id="menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-text-light hover:text-accent-pink hover:bg-bg-dark-secondary" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menú principal</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="md:hidden hidden bg-primary-black border-t border-gray-800" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('public.menu') }}" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">Nuestro Menú</a>
            <a href="#historia" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">Nuestra Historia</a>
            <a href="#galeria" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">Galería</a>
            <a href="#contacto" class="text-text-light hover:bg-bg-dark-secondary hover:text-accent-pink block px-3 py-2 rounded-md text-base font-medium">Contacto</a>
        </div>
    </div>
</header>

{{-- ================== CONTENIDO ================== --}}
<main class="grow">
    @yield('content')
</main>

{{-- ================== TU FOOTER EXACTO ================== --}}
<footer id="contacto" class="bg-primary-black text-gray-400"> 
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            
            <div class="md:col-span-1">
                <a href="/" class="flex flex-col items-start gap-4" title="La Favorita Xees Keyk">
                    <img class="h-48 w-auto" src="{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}" alt="Logo La Favorita Xees Keyk">
                </a>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-text-light tracking-wider uppercase">Horarios</h3>
                <ul class="mt-4 space-y-3">
                    <li><p class="hover:text-accent-pink transition">Lu–Ju: 16:30 – 22:00</p></li>
                    <li><p class="hover:text-accent-pink transition">Viernes: 16:30 – 22:30</p></li>
                    <li><p class="hover:text-accent-pink transition">Sábado: 16:00 – 22:30</p></li>
                    <li><p class="hover:text-accent-pink transition">Domingo cerrado</p></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-text-light tracking-wider uppercase">Dónde encontrarnos</h3>

               <div class="mt-5 rounded-xl overflow-hidden shadow-lg border border-bg-dark-secondary relative">
                    <a href="https://www.google.com/maps/place/Carrer+Raval+de+Robuster,+31,+Reus" 
                       target="_blank" 
                       class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 px-6 py-3 bg-accent-pink text-primary-black font-semibold rounded-full shadow-lg hover:bg-pink-600 transition">
                        Ver mapa
                    </a>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.712489123543!2d1.1052574757566933!3d41.15550727133698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a15002f0211df9%3A0xe0d2fef3e5b63cc!2sRaval%20de%20Robuster%2C%2031%2C%2043201%20Reus%2C%20Tarragona!5e0!3m2!1ses!2ses!4v1698668025909!5m2!1ses!2ses"
                        width="100%" height="180" style="border:0; opacity:0.2;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
               </div>

            </div>

            <div>
                <h3 class="text-sm font-semibold text-text-light tracking-wider uppercase">¡Síguenos!</h3>                
                <a href="https://www.instagram.com/lafavoritaxeeskeyk/"
                   target="_blank" rel="noopener noreferrer"
                   class="mt-[30px] inline-flex items-center gap-2 px-4 py-2 rounded-full border border-accent-pink text-accent-pink font-semibold hover:bg-accent-pink hover:text-primary-black transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zm0 1.5h8.5A4.25 4.25 0 0120.5 7.75v8.5a4.25 4.25 0 01-4.25 4.25h-8.5A4.25 4.25 0 013.5 16.25v-8.5A4.25 4.25 0 017.75 3.5zm8.75 2a1 1 0 100 2 1 1 0 000-2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z"/>
                    </svg>
                    @lafavoritaxeeskeyk
                </a>
            </div>
        </div>

        <div class="mt-12 border-t border-bg-dark-secondary pt-8 text-center">
            <p class="text-sm text-gray-500">© <span id="current-year"></span> La Favorita Xees Keyk. Todos los derechos reservados.</p>
        </div>
    </div>

    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
</footer>

{{-- ================== SCRIPTS GLOBALES ================== --}}
<script>
    // Menú móvil
    document.getElementById('menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        const openIcon = this.querySelector('svg.block');
        const closeIcon = this.querySelector('svg.hidden');
        menu.classList.toggle('hidden');
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
        openIcon.classList.toggle('block');
        closeIcon.classList.toggle('block');
    });
</script>

@stack('scripts')

</body>
</html>