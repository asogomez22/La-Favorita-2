<section class="p-6 sm:p-8 bg-white shadow-md rounded-2xl border border-gray-100 transition-all duration-300 hover:shadow-lg">
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-900" style="font-family: 'Inter', sans-serif;">
            Eliminar Cuenta
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán de forma permanente. Antes de eliminar tu cuenta, descarga cualquier información que desees conservar.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Eliminar Cuenta
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                ¿Estás seguro de que deseas eliminar tu cuenta?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Una vez eliminada, todos los recursos y datos se borrarán de manera permanente. Por favor, ingresa tu contraseña para confirmar que deseas eliminar tu cuenta.
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="Contraseña" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Contraseña"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Eliminar Cuenta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
