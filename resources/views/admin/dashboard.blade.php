<x-admin-layout title="Panel de Control">
    
    <!-- Welcome Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-[#a3b48c] to-[#8a9a74] rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-2" style="font-family: 'Poppins', sans-serif;">¡Hola, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-white/90 text-lg">Bienvenido a tu panel de control. Aquí tienes un resumen de tu tienda.</p>
            </div>
            <!-- Decorative circle -->
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Products Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#FF40A8]/10 rounded-xl group-hover:bg-[#FF40A8] transition-colors duration-300">
                    <i class="fas fa-cheese text-2xl text-[#FF40A8] group-hover:text-white transition-colors duration-300"></i>
                </div>
                <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+2 nuevos</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Productos</h3>
            <p class="text-3xl font-bold text-[#2c2c2c] mt-1" id="stats-products" data-count="{{ $productCount ?? 0 }}">0</p>
        </div>

        <!-- Categories Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#a3b48c]/10 rounded-xl group-hover:bg-[#a3b48c] transition-colors duration-300">
                    <i class="fas fa-tags text-2xl text-[#a3b48c] group-hover:text-white transition-colors duration-300"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Categorías</h3>
            <p class="text-3xl font-bold text-[#2c2c2c] mt-1" id="stats-categories" data-count="{{ $categoryCount ?? 0 }}">0</p>
        </div>

        <!-- Orders Card (Placeholder) -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 rounded-xl group-hover:bg-blue-500 transition-colors duration-300">
                    <i class="fas fa-shopping-cart text-2xl text-blue-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <span class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Hoy</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Pedidos Nuevos</h3>
            <p class="text-3xl font-bold text-[#2c2c2c] mt-1">0</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <h3 class="text-xl font-bold text-[#2c2c2c] mb-6" style="font-family: 'Poppins', sans-serif;">Acciones Rápidas</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <a href="{{ route('admin.productos.create') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-[#FF40A8]/30 transition-all duration-300 group cursor-pointer">
            <div class="w-12 h-12 bg-[#FF40A8]/10 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-plus text-[#FF40A8] text-xl"></i>
            </div>
            <span class="font-bold text-gray-700 group-hover:text-[#FF40A8] transition-colors">Nuevo Producto</span>
        </a>

        <a href="{{ route('admin.categorias.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-[#a3b48c]/30 transition-all duration-300 group cursor-pointer">
            <div class="w-12 h-12 bg-[#a3b48c]/10 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-tags text-[#a3b48c] text-xl"></i>
            </div>
            <span class="font-bold text-gray-700 group-hover:text-[#a3b48c] transition-colors">Gestionar Categorías</span>
        </a>

        <a href="{{ route('admin.pedidos.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition-all duration-300 group cursor-pointer">
            <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-list text-blue-500 text-xl"></i>
            </div>
            <span class="font-bold text-gray-700 group-hover:text-blue-500 transition-colors">Ver Pedidos</span>
        </a>

        <a href="/" target="_blank" class="flex flex-col items-center justify-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-gray-300 transition-all duration-300 group cursor-pointer">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-eye text-gray-600 text-xl"></i>
            </div>
            <span class="font-bold text-gray-700 group-hover:text-black transition-colors">Ir a la Web</span>
        </a>

    </div>

    <!-- CountUp Script -->
    <script src="https://unpkg.com/countup.js@2.8.0/dist/countUp.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const options = { duration: 2, enableScrollSpy: true, scrollSpyDelay: 100 };
            
            const productEl = document.getElementById('stats-products');
            if (productEl) {
                new countUp.CountUp(productEl, productEl.getAttribute('data-count'), options).start();
            }

            const categoryEl = document.getElementById('stats-categories');
            if (categoryEl) {
                new countUp.CountUp(categoryEl, categoryEl.getAttribute('data-count'), options).start();
            }
        });
    </script>
</x-admin-layout>
