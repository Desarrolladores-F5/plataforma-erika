<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        ¿Olvidaste tu contraseña? No te preocupes.
        Ingresa el correo electrónico asociado a tu cuenta y te enviaremos un enlace para restablecer tu contraseña de forma segura.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                Enviar enlace de recuperación
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>