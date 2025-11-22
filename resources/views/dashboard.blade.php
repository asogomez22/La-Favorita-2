<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#2c2c2c] leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <!-- Espaciado vertical cambiado de py-12 a py-8 para un aspecto más compacto -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Tarjeta de Bienvenida -->
            <div class="bg-[#a3b48c] text-white p-6 sm:p-8 rounded-lg shadow-md">
                <h3 class="text-3xl font-bold" style="font-family: 'Poppins', sans-serif;">¡Bienvenido/a de nuevo, {{ Auth::user()->name }}!</h3>
                <p class="mt-2 text-lg text-white/90">Aquí puedes gestionar fácilmente tus productos y categorías.</p>
            </div>

            <!-- Estadísticas Rápidas -->
            <div>
                <h3 class="text-xl font-bold text-[#2c2c2c] mb-4" style="font-family: 'Poppins', sans-serif;">Estadísticas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Card 1: Productos -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 transition-all duration-200 transform hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="shrink-0 bg-[#FF40A8]/10 p-3 rounded-full">
                                <i class="fas fa-cheese text-2xl text-[#FF40A8]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Total Productos</p>
                                <p id="stats-products" class="text-3xl font-bold text-[#2c2c2c]" data-count="{{ $productCount ?? 0 }}">
                                    0
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2: Categorías -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 transition-all duration-200 transform hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="shrink-0 bg-[#a3b48c]/10 p-3 rounded-full">
                                <i class="fas fa-tags text-2xl text-[#a3b48c]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Total Categorías</p>
                                <p id="stats-categories" class="text-3xl font-bold text-[#2c2c2c]" data-count="{{ $categoryCount ?? 0 }}">
                                    0
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 3: Pedidos (Placeholder) -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 transition-all duration-200 transform hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="shrink-0 bg-gray-200 p-3 rounded-full">
                                <i class="fas fa-shopping-cart text-2xl text-gray-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Nuevos Pedidos</p>
                                <p class="text-3xl font-bold text-[#2c2c2c]">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div>
                <h3 class="text-xl font-bold text-[#2c2c2c] mb-4" style="font-family: 'Poppins', sans-serif;">Acciones Rápidas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('admin.productos.create') }}" class="flex items-center justify-center text-center p-6 bg-[#FF40A8] text-white rounded-lg shadow-md hover:bg-[#f32ba0] transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-plus mr-3"></i>
                        <span class="font-bold">Añadir Nuevo Producto</span>
                    </a>
                    <a href="{{ route('admin.categorias.index') }}" class="flex items-center justify-center text-center p-6 bg-[#a3b48c] text-white rounded-lg shadow-md hover:bg-[#8a9a74] transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-tags mr-3"></i>
                        <span class="font-bold">Gestionar Categorías</span>
                    </a>
                    <a href="/" target="_blank" class="flex items-center justify-center text-center p-6 bg-white border border-gray-300 text-[#2c2c2c] rounded-lg shadow-md hover:bg-gray-50 transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-eye mr-3"></i>
                        <span class="font-bold">Ver la Web</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPTS PER L'ANIMACIÓ DE CONTEO -->
    <!-- 1. Importar la llibreria CountUp.js -->
    <script src="https://unpkg.com/countup.js@2.8.0/dist/countUp.umd.js"></script>
    
    <!-- 2. Inicialitzar l'script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animació per Productes
            const productEl = document.getElementById('stats-products');
            if (productEl) {
                const productTarget = productEl.getAttribute('data-count');
                const productAnim = new countUp.CountUp(productEl, productTarget, {
                    duration: 2, // 2 segons
                    enableScrollSpy: true, // Començar l'animació quan es fa scroll fins a l'element
                    scrollSpyDelay: 100 // ms
                });
                if (!productAnim.error) {
                    productAnim.start();
                } else {
                    console.error(productAnim.error);
                }
            }

            // Animació per Categories
            const categoryEl = document.getElementById('stats-categories');
            if (categoryEl) {
                const categoryTarget = categoryEl.getAttribute('data-count');
                const categoryAnim = new countUp.CountUp(categoryEl, categoryTarget, {
                    duration: 2,
                    enableScrollSpy: true,
                    scrollSpyDelay: 100
                });
                if (!categoryAnim.error) {
                    categoryAnim.start();
                } else {
                    console.error(categoryAnim.error);
                }
            }
        });
    </script>
</x-app-layout>
