<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Recuperar Contrasenya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js']) {{-- Assuming you still use Vite for JS --}}

    <style>
        :root {
            --primary-pink: #FF40A8;
            --primary-green: #a3b48c;
            --dark-text: #1f2937; /* gray-800 */
            --light-text: #FFFFFF;
            --font-family: 'Poppins', sans-serif;
        }
        body {
            font-family: var(--font-family);
            background-color: var(--primary-green);
            color: var(--dark-text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .content-card {
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
        .form-input {
            border-color: #d1d5db; /* gray-300 */
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .form-input:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(255, 64, 168, 0.2); /* Pink focus ring */
            outline: none;
        }
        .btn-primary {
            background-color: var(--primary-pink);
            color: var(--light-text);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #f32ba0;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 64, 168, 0.3);
        }
        .link-back {
            color: #6b7280; /* gray-500 */
            transition: color 0.2s ease-in-out;
        }
        .link-back:hover {
            color: var(--dark-text);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        
        <!-- Logo -->
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('fotos/logo.png') }}" alt="Logo La Favorita" class="h-[250px] w-auto">
            </a>
        </div>

        <!-- Tarjeta de Contenido -->
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white content-card overflow-hidden sm:rounded-xl">

            <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Recuperar Contrasenya</h2>


            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center text-sm font-medium text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    {{-- Usando sintaxis estándar de label e input para consistencia con el estilo --}}
                    <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                    <input id="email" class="block mt-1 w-full form-input rounded-md shadow-xs" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    {{-- Enlace para volver al login --}}
                    <a href="{{ route('login') }}" class="text-sm link-back hover:underline flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Tornar a l'inici de sessió
                    </a>

                    {{-- Usando botón estándar estilizado --}}
                    <button type="submit" class="ms-3 btn-primary font-bold py-2 px-5 rounded-lg">
                        {{ __('Enviar Enllaç') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
