<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda</title>
    
    {{-- Carga los estilos y scripts usando la directiva de Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased">

    {{-- Encabezado con sombra para darle profundidad --}}
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-4">
            {{-- Aquí puedes poner tu logo y menú de navegación --}}
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900">MiTienda</a>
        </nav>
    </header>

    {{-- Contenido principal de la página --}}
    <main class="container mx-auto py-10 px-6">
        @yield('content')
    </main>

    {{-- Pie de página simple y elegante --}}
    <footer class="bg-gray-800 text-white mt-10">
        <div class="container mx-auto px-6 py-4 text-center">
            <p>&copy; {{ date('Y') }} Mi Tienda. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>