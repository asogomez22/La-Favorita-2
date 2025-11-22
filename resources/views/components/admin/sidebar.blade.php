<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
    
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <img src="{{ asset('fotos/logotransparente.png') }}" alt="Logo" class="h-12 w-auto">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="mt-6 px-4 space-y-2">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-[#FF40A8]/10 text-[#FF40A8]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF40A8]' }}">
            <i class="fas fa-home w-6 text-lg {{ request()->routeIs('admin.dashboard') ? 'text-[#FF40A8]' : 'text-gray-400 group-hover:text-[#FF40A8]' }}"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Productos -->
        <a href="{{ route('admin.productos.index') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.productos.*') ? 'bg-[#FF40A8]/10 text-[#FF40A8]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF40A8]' }}">
            <i class="fas fa-cheese w-6 text-lg {{ request()->routeIs('admin.productos.*') ? 'text-[#FF40A8]' : 'text-gray-400 group-hover:text-[#FF40A8]' }}"></i>
            <span class="font-medium">Productos</span>
        </a>

        <!-- Categorías -->
        <a href="{{ route('admin.categorias.index') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.categorias.*') ? 'bg-[#FF40A8]/10 text-[#FF40A8]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF40A8]' }}">
            <i class="fas fa-tags w-6 text-lg {{ request()->routeIs('admin.categorias.*') ? 'text-[#FF40A8]' : 'text-gray-400 group-hover:text-[#FF40A8]' }}"></i>
            <span class="font-medium">Categorías</span>
        </a>

        <!-- Pedidos -->
        <a href="{{ route('admin.pedidos.index') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.pedidos.*') ? 'bg-[#FF40A8]/10 text-[#FF40A8]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF40A8]' }}">
            <i class="fas fa-shopping-cart w-6 text-lg {{ request()->routeIs('admin.pedidos.*') ? 'text-[#FF40A8]' : 'text-gray-400 group-hover:text-[#FF40A8]' }}"></i>
            <span class="font-medium">Pedidos</span>
        </a>

        <!-- Comandes (si existe ruta) -->
        @if(Route::has('admin.comandes.index'))
        <a href="{{ route('admin.comandes.index') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.comandes.*') ? 'bg-[#FF40A8]/10 text-[#FF40A8]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF40A8]' }}">
            <i class="fas fa-clipboard-list w-6 text-lg {{ request()->routeIs('admin.comandes.*') ? 'text-[#FF40A8]' : 'text-gray-400 group-hover:text-[#FF40A8]' }}"></i>
            <span class="font-medium">Comandes</span>
        </a>
        @endif

    </nav>

    <!-- Bottom Actions -->
    <div class="absolute bottom-0 w-full p-4 border-t border-gray-100 bg-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-600 hover:text-red-500 transition-colors duration-200">
                <i class="fas fa-sign-out-alt w-6"></i>
                <span class="font-medium">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</aside>
