<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])

    <style>
        :root {
            --primary-pink: #FF40A8;       /* rosa fuerte */
            --primary-pink-light: #FF95C4; /* rosa claro */
            --primary-green: #a3b48c;
            --dark-text: #1f2937;
            --light-text: #FFFFFF;
            --font-family: 'Poppins', sans-serif;
            --subtle-pattern: url("data:image/svg+xml,%3Csvg width='6' height='6' viewBox='0 0 6 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cpath d='M5 0h1L0 6V5zM6 5v1H5z'/%3E%3C/g%3E%3C/svg%3E");
        }

        body {
            font-family: var(--font-family);
            background-color: #f3f4f6;
            color: var(--dark-text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .login-container {
            min-height: 100vh;
        }

        .branding-section {
            background-color: var(--primary-green);
            background-image: var(--subtle-pattern);
        }

        /* Inputs rosa claro por defecto, rosa fuerte al foco */
        .form-input {
            border: 2px solid var(--primary-pink-light);
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-input:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(255, 64, 168, 0.2);
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

        .link-pink {
            color: var(--primary-pink);
            transition: color 0.2s ease-in-out;
        }
        .link-pink:hover {
            color: #f32ba0;
        }
    </style>
</head>
<body class="antialiased">
    <div class="login-container flex flex-col md:flex-row">

        <!-- Branding Section -->
        <div class="w-full md:w-1/2 branding-section flex flex-col items-center justify-center p-12">
            
                <img src="{{ asset('fotos/logo.png') }}" alt="Logo" class="h-[400px] w-auto" style="margin-top: -150px;">
            

            <h1 class="text-5xl font-extrabold text-white text-center mb-4">
                Benvingut/da de nou!
            </h1>

            <p class="text-xl text-white/80 text-center max-w-sm mx-auto mb-2">
                Accedeix al panell d'administració de
            </p>

            <p class="text-3xl font-bold text-[#FF40A8] text-center max-w-sm mx-auto">
                La Favorita Xeeskeyk
            </p>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 bg-white flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Iniciar Sessió</h2>

                <x-auth-session-status class="mb-4 text-center text-sm font-medium text-green-600" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                        <input id="email" class="block w-full form-input text-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 mb-1">Contrasenya</label>
                        <input id="password" class="block w-full form-input text-lg" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between mt-6 mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded-sm border-gray-300 shadow-xs checkbox-pink" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Recorda'm</span>
                        </label>

                        <a class="underline text-sm text-gray-600 link-pink" href="{{ route('password.request') }}">
                            Has oblidat la contrasenya?
                        </a>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-center mt-8">
                        <button type="submit" class="w-full btn-primary font-bold py-3 px-6 rounded-lg text-lg">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>
