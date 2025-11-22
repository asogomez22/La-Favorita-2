<footer id="contacto" class="bg-primary-black text-gray-400"> 
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            
            <!-- Logo -->
            <div class="md:col-span-1">
                <a href="/" class="flex flex-col items-start gap-4" title="La Favorita Xees Keyk">
                    <img class="h-48 w-auto" src="{{ asset('fotos/logo_letra_LA_FAVORITA.png') }}" alt="Logo La Favorita Xees Keyk">
                </a>
            </div>

            <!-- Horaris -->
            <div>
                <h3 class="text-sm font-semibold text-text-light tracking-wider uppercase">Horaris</h3>
                <ul class="mt-4 space-y-3">
                    <li><p class="hover:text-accent-pink transition">🕒 Dl–Dj: 16:30 – 22:00</p></li>
                    <li><p class="hover:text-accent-pink transition">🕒 Divendres: 16:30 – 22:30</p></li>
                    <li><p class="hover:text-accent-pink transition">🕒 Dissabte: 16:00 – 22:30</p></li>
                    <li><p class="hover:text-accent-pink transition">❌ Diumenge tancat</p></li>
                </ul>
            </div>

            <!-- Contacte + Mapa -->
            <div>
                <h3 class="text-sm font-semibold text-text-light tracking-wider uppercase">On trobar-nos</h3>


                <!-- Mapa -->
             <div class="mt-5 rounded-xl overflow-hidden shadow-lg border border-bg-dark-secondary relative">
                    <!-- Botón centrado sobre el mapa -->
                    <a href="https://www.google.com/maps/place/Carrer+Raval+de+Robuster,+31,+Reus" 
                    target="_blank" 
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 px-6 py-3 bg-accent-pink text-primary-black font-semibold rounded-full shadow-lg hover:bg-pink-600 transition">
                        Veure mapa
                    </a>

                    <!-- Mapa -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.712489123543!2d1.1052574757566933!3d41.15550727133698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a15002f0211df9%3A0xe0d2fef3e5b63cc!2sRaval%20de%20Robuster%2C%2031%2C%2043201%20Reus%2C%20Tarragona!5e0!3m2!1ses!2ses!4v1698668025909!5m2!1ses!2ses"
                        width="100%" height="180" style="border:0; opacity:0.2;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>

            <!-- Xarxes socials -->
            <div>
                <h3 class="text-sm font-semibold text-text-light tracking-wider uppercase">Segueix-nos!</h3>                
                <a href="https://www.instagram.com/lafavoritaxeeskeyk/"
                   target="_blank" rel="noopener noreferrer"
                   class=" mt-[30px] inline-flex items-center gap-2 px-4 py-2 rounded-full border border-accent-pink text-accent-pink font-semibold hover:bg-accent-pink hover:text-primary-black transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zm0 1.5h8.5A4.25 4.25 0 0120.5 7.75v8.5a4.25 4.25 0 01-4.25 4.25h-8.5A4.25 4.25 0 013.5 16.25v-8.5A4.25 4.25 0 017.75 3.5zm8.75 2a1 1 0 100 2 1 1 0 000-2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z"/>
                    </svg>
                    @lafavoritaxeeskeyk
                </a>
            </div>
        </div>

        <div class="mt-12 border-t border-bg-dark-secondary pt-8 text-center">
            <p class="text-sm text-gray-500">&copy; <span id="current-year"></span> La Favorita Xees Keyk. Tots els drets reservats.</p>
        </div>
    </div>

    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
</footer>