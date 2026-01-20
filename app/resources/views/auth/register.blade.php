<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Género -->
        <div class="mt-4">
            <x-input-label for="gender" value="Género" />
            <select id="gender" name="gender"
                class="block mt-1 w-full rounded-md border-gray-300
                       focus:border-orange-500 focus:ring-orange-500">
                <option value="">Selecciona género</option>
                <option value="masculino" {{ old('gender') === 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ old('gender') === 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ old('gender') === 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <!-- Fecha nacimiento -->
        <div class="mt-4">
            <x-input-label for="birth_date" value="Fecha de nacimiento" />
            <x-text-input id="birth_date"
                class="block mt-1 w-full"
                type="date"
                name="birth_date"
                value="{{ old('birth_date') }}" />
        </div>

        <!-- Comuna -->
        <div class="mt-4">
            <x-input-label for="comuna" value="Comuna / Ciudad" />
            <x-text-input id="comuna"
                class="block mt-1 w-full"
                type="text"
                name="comuna"
                value="{{ old('comuna') }}"
                placeholder="Ej: Santiago" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-gray-600 hover:text-gray-900 underline"
               href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>

            <x-primary-button>
                Crear cuenta
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
