<!-- Barra de navegación personalizada -->
<nav x-data="{ open: false }" class="bg-white shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 justify-between w-full">

            <!-- Logo a la izquierda -->
            <div class="shrink-0">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('fotos/logo_fodoblanco.png') }}" alt="Logo" class="h-16 w-auto object-contain">
                </a>
            </div>

            <!-- Panel de control en el centro -->
            <div class="flex-1 flex justify-center">
                <x-nav-link 
                    :href="route('admin.comandes.index')" 
                    :active="request()->routeIs('admin.comandes.*')" 
                    class="relative text-gray-600 hover:text-[#FF40A8] focus:text-[#FF40A8] font-medium">
                    {{ __('Comandes') }}
                    @if (request()->routeIs('admin.comandes.*'))
                        <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-[#a3b48c] rounded-full"></span>
                    @endif
                </x-nav-link>
            </div>

            <!-- Dropdown usuario a la derecha -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-600 bg-white hover:bg-gray-50 hover:text-[#FF40A8] focus:outline-hidden transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger móvil -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-[#FF40A8] hover:bg-gray-100 focus:outline-hidden transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 text-xl">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.productos.index')" :active="request()->routeIs('admin.productos.*')">
                {{ __('Productos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')">
                {{ __('Categorías') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.comandes.index')" :active="request()->routeIs('admin.comandes.*')">
                {{ __('Comandes') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-[#2c2c2c]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
