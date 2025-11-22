<header class="bg-white shadow-sm h-20 flex items-center justify-between px-6 lg:px-10 z-40 sticky top-0">
    
    <!-- Mobile Menu Button -->
    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-[#FF40A8] focus:outline-none">
        <i class="fas fa-bars text-2xl"></i>
    </button>

    <!-- Page Title / Breadcrumbs -->
    <div class="hidden md:block">
        <h1 class="text-2xl font-bold text-[#2c2c2c]" style="font-family: 'Poppins', sans-serif;">
            {{ $title ?? 'Dashboard' }}
        </h1>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center space-x-6">
        
        <!-- View Website Link -->
        <a href="/" target="_blank" class="hidden sm:flex items-center text-gray-500 hover:text-[#FF40A8] transition-colors duration-200" title="Ver web">
            <i class="fas fa-globe text-xl"></i>
        </a>

        <!-- Notifications (Placeholder) -->
        <button class="relative text-gray-500 hover:text-[#FF40A8] transition-colors duration-200">
            <i class="fas fa-bell text-xl"></i>
            <span class="absolute -top-1 -right-1 h-2 w-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-[#2c2c2c]">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrador</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-[#FF40A8]/10 flex items-center justify-center text-[#FF40A8] font-bold text-lg border-2 border-transparent hover:border-[#FF40A8] transition-all duration-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 border border-gray-100 z-50">
                
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#FF40A8]">
                    <i class="fas fa-user-circle mr-2"></i> Perfil
                </a>
                
                <div class="border-t border-gray-100 my-1"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
