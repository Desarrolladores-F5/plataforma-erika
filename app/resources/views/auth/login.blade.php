<x-guest-layout>

    {{-- =========================================================
        ESTADO DE SESIÓN
    ========================================================== --}}
    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />


    {{-- =========================================================
        FORMULARIO DE INICIO DE SESIÓN
    ========================================================== --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf


        {{-- =====================================================
            CORREO ELECTRÓNICO
        ====================================================== --}}
        <div>

            <label
                for="email"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >
                Correo electrónico
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="tu@correo.cl"
                class="block w-full
                       rounded-xl
                       border border-gray-300
                       bg-white
                       px-4 py-3
                       text-gray-800
                       shadow-sm
                       transition-all duration-200
                       placeholder:text-gray-400
                       hover:border-gray-400
                       focus:border-orange-500
                       focus:ring-2
                       focus:ring-orange-100"
            >

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- =====================================================
            CONTRASEÑA
        ====================================================== --}}
        <div x-data="{ show: false }">

            <label
                for="password"
                class="mb-2 block text-sm font-semibold text-gray-700"
            >
                Contraseña
            </label>

            <div class="relative">

                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Ingresa tu contraseña"
                    class="block w-full
                           rounded-xl
                           border border-gray-300
                           bg-white
                           px-4 py-3
                           pr-12
                           text-gray-800
                           shadow-sm
                           transition-all duration-200
                           placeholder:text-gray-400
                           hover:border-gray-400
                           focus:border-orange-500
                           focus:ring-2
                           focus:ring-orange-100"
                >

                {{-- Mostrar / ocultar contraseña --}}
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0
                           flex items-center justify-center
                           px-4
                           text-gray-400
                           transition
                           hover:text-orange-600"
                    tabindex="-1"
                    aria-label="Mostrar u ocultar contraseña"
                >

                    {{-- Ojo abierto --}}
                    <svg
                        x-show="!show"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                               c4.478 0 8.268 2.943 9.542 7
                               -1.274 4.057-5.064 7-9.542 7
                               -4.477 0-8.268-2.943-9.542-7z"
                        />
                    </svg>

                    {{-- Ojo cerrado --}}
                    <svg
                        x-show="show"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                               c-4.478 0-8.268-2.943-9.542-7
                               a9.956 9.956 0 012.293-3.95"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6.228 6.228A9.956 9.956 0 0112 5
                               c4.478 0 8.268 2.943 9.542 7
                               a9.97 9.97 0 01-4.293 5.774"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3l18 18"
                        />
                    </svg>

                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- =====================================================
            MANTENER SESIÓN + RECUPERAR CONTRASEÑA
        ====================================================== --}}
        <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:items-center sm:justify-between">

            {{-- Mantener sesión --}}
            <label
                for="remember_me"
                class="inline-flex cursor-pointer items-center"
            >
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded
                           border-gray-300
                           text-orange-600
                           shadow-sm
                           focus:ring-orange-200"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Mantener sesión iniciada
                </span>
            </label>


            {{-- Recuperar contraseña --}}
            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="text-sm font-medium
                           text-gray-500
                           transition
                           hover:text-orange-600"
                >
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

        </div>


        {{-- =====================================================
            BOTÓN INICIAR SESIÓN
        ====================================================== --}}
        <div class="pt-3">

            <button
                type="submit"
                class="group
                       inline-flex w-full
                       items-center justify-center gap-2
                       rounded-xl
                       px-5 py-3.5
                       text-sm font-semibold
                       text-white
                       shadow-sm
                       transition-all duration-200
                       hover:-translate-y-0.5
                       hover:shadow-md
                       focus:outline-none
                       focus:ring-2
                       focus:ring-orange-200
                       focus:ring-offset-2"
                style="background: var(--brand, #ff6b00);"
            >
                <span>Iniciar sesión</span>

                <span
                    class="transition-transform duration-200
                           group-hover:translate-x-1"
                >
                    →
                </span>
            </button>

        </div>

    </form>

</x-guest-layout>