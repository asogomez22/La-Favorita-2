<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Favorita Xees Keyk - Cheesecake Noir & Rose</title>
    
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-cream text-brand-dark selection:bg-brand-pink selection:text-white"
      x-data="{ 
          isScrolled: false, 
          galleryOpen: false,
          galleryImage: '' 
      }"
      x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 20; });">

<header class="fixed top-0 z-50 w-full transition-all duration-300 bg-brand-cream/95 backdrop-blur-md border-b-2 border-brand-dark"
        :class="{ 'py-2 shadow-md': isScrolled, 'py-4': !isScrolled }">
    <nav class="container mx-auto px-6 md:px-12 lg:px-24">
        <div class="flex items-center justify-between transition-all duration-300"
             :class="{ 'h-16': isScrolled, 'h-24': !isScrolled }">
            
            <div class="flex items-center gap-4 md:gap-12">
                <a href="{{ route('public.inicio') }}" class="shrink-0 flex items-center gap-2">
                    <img class="w-auto object-contain transition-all duration-300" 
                           :class="{ 'h-10 md:h-14': isScrolled, 'h-12 md:h-20': !isScrolled }"
                           src="{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}" 
                           alt="Logo"
                           onerror="this.style.display='none'"> </a>

                <div class="hidden md:flex md:items-center md:space-x-6 lg:space-x-8">
                    <a href="{{ route('public.menu') }}" class="text-brand-dark hover:text-brand-pink font-bold uppercase tracking-wide text-xs lg:text-sm transition">Menú</a>
                    <a href="{{ route('public.inicio') }}#historia" class="text-brand-dark hover:text-brand-pink font-bold uppercase tracking-wide text-xs lg:text-sm transition">Historia</a>
                    <a href="{{ route('public.inicio') }}#galeria" class="text-brand-dark hover:text-brand-pink font-bold uppercase tracking-wide text-xs lg:text-sm transition">Galería</a>
                    <a href="{{ route('public.contacto') }}" class="text-brand-dark hover:text-brand-pink font-bold uppercase tracking-wide text-xs lg:text-sm transition">Contacto</a>
                </div>
            </div>

            <div class="flex items-center gap-3 md:gap-4">
                <a href="{{ route('cart.index') }}" class="relative group p-2 rounded-full border-2 border-brand-dark hover:bg-brand-pink hover:border-brand-pink hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 flex h-5 w-5 md:h-6 md:w-6 items-center justify-center rounded-full bg-brand-pink text-white text-[10px] md:text-xs font-bold border-2 border-brand-dark">{{ $cartCount }}</span>
                    @endif
                </a>

                <div class="md:hidden">
                    <button id="menu-button" type="button" class="inline-flex items-center justify-center p-1 rounded-md text-brand-dark">
                        <svg class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="md:hidden hidden bg-brand-cream border-t-2 border-brand-dark fixed w-full z-40 shadow-2xl" id="mobile-menu">
        <div class="flex flex-col p-4 space-y-2">
            <a href="{{ route('public.menu') }}" class="px-4 py-3 text-lg font-bold text-brand-dark bg-brand-green/10 hover:bg-brand-pink hover:text-white rounded-xl transition-colors">Nuestro Menú</a>
            <a href="{{ route('public.inicio') }}#historia" class="px-4 py-3 text-lg font-bold text-brand-dark bg-white hover:bg-brand-pink hover:text-white rounded-xl transition-colors border-2 border-transparent hover:border-brand-dark">Historia</a>
            <a href="{{ route('public.inicio') }}#galeria" class="px-4 py-3 text-lg font-bold text-brand-dark bg-white hover:bg-brand-pink hover:text-white rounded-xl transition-colors border-2 border-transparent hover:border-brand-dark">Galería</a>
            <a href="{{ route('public.contacto') }}" class="px-4 py-3 text-lg font-bold text-brand-dark bg-white hover:bg-brand-pink hover:text-white rounded-xl transition-colors border-2 border-transparent hover:border-brand-dark">Contacto</a>
        </div>
    </div>
</header>

<main class="pt-32">
    @yield('content')
</main>

<footer id="contacto" class="bg-brand-dark text-brand-cream py-16 border-t-8 border-brand-pink">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            
            <div class="flex flex-col items-start space-y-4">
                <a href="/" class="block">
                    <!-- Logo Fix: Pink color and aspect ratio -->
                    <div class="h-28 w-auto aspect-auto bg-brand-pink" 
                         style="mask-image: url('{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;">
                         <img src="{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}" class="opacity-0 h-full w-auto" alt="Logo La Favorita">
                    </div>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed">Cheesecakes artesanales hechos con rebeldía y pasión en el corazón de Reus.</p>
                <div class="flex gap-4 mt-2">
                    <a href="https://instagram.com" target="_blank" class="bg-white/10 p-2 rounded-full hover:bg-brand-pink hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.36-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.667-.072-4.947-.2-4.361-2.618-6.782-6.98-6.98-1.281-.059-1.689-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.162c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>

            <div>
                <h3 class="text-brand-green font-bold uppercase tracking-widest mb-6">Explora</h3>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li><a href="{{ route('public.menu') }}" class="hover:text-brand-pink transition flex items-center gap-2"><span>→</span> Menú Completo</a></li>
                    <li><a href="{{ route('public.inicio') }}#historia" class="hover:text-brand-pink transition flex items-center gap-2"><span>→</span> Nuestra Historia</a></li>
                    <li><a href="{{ route('public.inicio') }}#galeria" class="hover:text-brand-pink transition flex items-center gap-2"><span>→</span> Galería</a></li>
                    <li><a href="{{ route('public.contacto') }}" class="hover:text-brand-pink transition flex items-center gap-2"><span>→</span> Contacto</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-brand-green font-bold uppercase tracking-widest mb-6">Horarios</h3>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li class="flex justify-between border-b border-white/10 pb-2"><span>Lu - Ju</span> <span>16:30 - 22:00</span></li>
                    <li class="flex justify-between border-b border-white/10 pb-2"><span>Viernes</span> <span>16:30 - 22:30</span></li>
                    <li class="flex justify-between border-b border-white/10 pb-2"><span>Sábado</span> <span>16:00 - 22:30</span></li>
                    <li class="flex justify-between text-brand-pink font-bold"><span>Domingo</span> <span>Cerrado</span></li>
                </ul>
            </div>

            <div>
                <h3 class="text-brand-green font-bold uppercase tracking-widest mb-6">Únete al Club</h3>
                <p class="text-gray-400 text-xs mb-4">Recibe ofertas dulces y novedades exclusivas.</p>
                <form class="flex flex-col gap-2">
                    <input type="email" placeholder="Tu email..." class="bg-white/5 border border-white/10 rounded-sm px-4 py-2 text-sm text-white focus:outline-hidden focus:border-brand-pink">
                    <button type="button" class="bg-brand-green text-brand-dark font-bold uppercase text-xs py-2 rounded-sm hover:bg-white transition">Suscribirse</button>
                </form>
            </div>
        </div>

        <div class="w-full rounded-2xl overflow-hidden border-2 border-brand-green/30 shadow-lg mb-8 h-48 md:h-64">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.712489123543!2d1.1052574757566933!3d41.15550727133698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a15002f0211df9%3A0xe0d2fef3e5b63cc!2sRaval%20de%20Robuster%2C%2031%2C%2043201%20Reus%2C%20Tarragona!5e0!3m2!1ses!2ses!4v1698668025909!5m2!1ses!2ses" width="100%" height="100%" style="border:0; opacity:0.7; filter: grayscale(100%) invert(90%);" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/10 text-xs text-gray-500">
            <p>© <span id="current-year"></span> La Favorita Xees Keyk.</p>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Aviso Legal</a>
                <a href="#" class="hover:text-white transition">Política de Privacidad</a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
    
    const menuBtn = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    if(menuBtn && mobileMenu){
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuBtn.querySelectorAll('svg').forEach(i => i.classList.toggle('hidden'));
        });
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                const icons = menuBtn.querySelectorAll('svg');
                icons[0].classList.remove('hidden'); 
                icons[1].classList.add('hidden');    
            });
        });
    }

    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('is-visible');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in-element').forEach(el => observer.observe(el));
</script>
</body>
</html>
