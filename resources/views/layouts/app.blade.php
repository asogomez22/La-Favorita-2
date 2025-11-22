<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">


<title>{{ $title ?? 'La Favorita Xees Keyk' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="antialiased">
<div class="min-h-screen bg-gray-50">

    <!-- Navegación personalizada centrada -->
    <nav x-data="{ open: false }" class="bg-white shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center py-4">
                <!-- Logo -->
                <div class="shrink-0 mb-4">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('fotos/logotransparente.png') }}" alt="Logo" class="h-[90px] w-auto object-contain">
                    </a>
                </div>

                <!-- Links centrados -->
                <div class="flex space-x-8 text-xl sm:text-2xl font-semibold mb-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="relative text-gray-600 transition duration-200 ease-in-out hover:text-[#a3b48c] group">
                        {{ __('Inicio') }}
                        <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left rounded-full"></span>
                        @if (request()->routeIs('dashboard'))
                            <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 rounded-full"></span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('admin.productos.index')" :active="request()->routeIs('admin.productos.*')" class="relative text-gray-600 transition duration-200 ease-in-out hover:text-[#a3b48c] group">
                        {{ __('Productos') }}
                        <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left rounded-full"></span>
                        @if (request()->routeIs('admin.productos.*'))
                            <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 rounded-full"></span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')" class="relative text-gray-600 transition duration-200 ease-in-out hover:text-[#a3b48c] group">
                        {{ __('Categorías') }}
                        <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left rounded-full"></span>
                        @if (request()->routeIs('admin.categorias.*'))
                            <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 rounded-full"></span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('admin.pedidos.index')" :active="request()->routeIs('admin.pedidos.*')" class="relative text-gray-600 transition duration-200 ease-in-out hover:text-[#a3b48c] group">
                        {{ __('Pedidos') }}
                        <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left rounded-full"></span>
                        @if (request()->routeIs('admin.pedidos.*'))
                            <span class="absolute left-0 -bottom-1 w-full h-[3px] bg-pink-500 rounded-full"></span>
                        @endif
                    </x-nav-link>
                </div>

                <!-- Dropdown usuario centrado debajo de los links -->
                <div class="flex items-center space-x-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:bg-gray-50 hover:text-[#FF40A8] focus:outline-hidden focus:bg-gray-50 transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Perfil') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>

        <!-- Menú móvil (opcional) -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white border-t border-gray-200">
            <div class="pt-2 pb-3 space-y-1 text-xl">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.productos.index')" :active="request()->routeIs('admin.productos.*')">{{ __('Productos') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')">{{ __('Categorías') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.pedidos.index')" :active="request()->routeIs('admin.pedidos.*')">{{ __('Pedidos') }}</x-responsive-nav-link>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-[#2c2c2c]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Perfil') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Cerrar sesión') }}</x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor Dashboard -->
    <div class="flex flex-col items-center mt-10">
        <!-- Título centrado -->

        <!-- Contenido dinámico -->
        <div class="w-full max-w-7xl">
            {{ $slot }}
        </div>
    </div>

</div>
</body>
</html>
