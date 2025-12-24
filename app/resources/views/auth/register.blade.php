<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- GÉNERO --}}
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

        {{-- FECHA NACIMIENTO --}}
        <div class="mt-4">
            <x-input-label for="birth_date" value="Fecha de nacimiento" />
            <x-text-input id="birth_date"
                        class="block mt-1 w-full"
                        type="date"
                        name="birth_date"
                        value="{{ old('birth_date') }}" />
        </div>

        {{-- COMUNA --}}
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
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
