<section class="p-6 sm:p-8 bg-white shadow-md rounded-2xl border border-gray-100 transition-all duration-300 hover:shadow-lg">
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-900" style="font-family: 'Inter', sans-serif;">
            Actualizar Contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Asegúrate de que tu cuenta utilice una contraseña larga y segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6 mt-6">
        @csrf
        @method('put')

        <!-- Contraseña Actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="'Contraseña Actual'" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nueva Contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="'Nueva Contraseña'" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="'Confirmar Contraseña'" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón Guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button>Guardar</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Guardado.</p>
            @endif
        </div>
    </form>
</section>
