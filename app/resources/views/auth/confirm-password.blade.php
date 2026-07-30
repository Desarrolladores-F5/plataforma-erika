<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        Esta es una sección protegida de la plataforma.
        Para continuar, por favor confirma tu contraseña.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Contraseña -->
        <div x-data="{ show: false }">

            <x-input-label for="password" value="Contraseña" />

            <div class="relative mt-1">

                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pr-12"
                >

                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 focus:outline-none select-none"
                    tabindex="-1"
                >

                    <!-- Ojo abierto -->
                    <svg
                        x-show="!show"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                 c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>

                    <!-- Ojo cerrado -->
                    <svg
                        x-show="show"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13.875 18.825A10.05 10.05 0 0112 19
                                 c-4.478 0-8.268-2.943-9.542-7
                                 a9.956 9.956 0 012.293-3.95"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6.228 6.228A9.956 9.956 0 0112 5
                                 c4.478 0 8.268 2.943 9.542 7
                                 a9.97 9.97 0 01-4.293 5.774"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 3l18 18"/>
                    </svg>

                </button>

            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button>
                Confirmar
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>