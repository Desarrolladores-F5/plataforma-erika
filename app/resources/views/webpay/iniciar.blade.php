<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">
            Confirmar pago del curso
        </h1>

        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div>
                <p class="text-gray-600 text-sm">Curso seleccionado:</p>
                <p class="text-lg font-semibold">
                    {{ $course->title }}
                </p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Monto a pagar:</p>
                <p class="text-xl font-bold">
                    ${{ number_format($course->price ?? 0, 0, ',', '.') }}
                </p>
            </div>

            <hr>

            <p class="text-gray-700">
                Haz clic en el botón para procesar el pago a través de Webpay.
                La orden se generará en el siguiente paso.
            </p>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('curso.detalle', $course->slug) }}"
                   class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm">
                    Volver al curso
                </a>

                <form action="{{ route('webpay.iniciar', $course->slug) }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm">
                        Pagar con Webpay
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
