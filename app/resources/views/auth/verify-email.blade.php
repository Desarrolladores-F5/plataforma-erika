<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600 leading-relaxed">
        ¡Gracias por registrarte!

        <br><br>

        Antes de comenzar a disfrutar de la plataforma, necesitamos verificar tu dirección de correo electrónico.

        Revisa tu bandeja de entrada y haz clic en el enlace de verificación que acabamos de enviarte.

        Si no encuentras el correo, puedes solicitar uno nuevo utilizando el botón que aparece más abajo.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-sm font-medium text-green-700">
            ✅ Hemos enviado un nuevo enlace de verificación al correo electrónico registrado.
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>
                Reenviar correo de verificación
            </x-primary-button>

        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Cerrar sesión
            </button>

        </form>

    </div>

</x-guest-layout>