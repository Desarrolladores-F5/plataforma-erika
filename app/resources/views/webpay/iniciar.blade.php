{{-- resources/views/webpay/iniciar.blade.php --}}

<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">
            Confirmar pago del curso
        </h1>

        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div>
                <p class="text-gray-600 text-sm">Curso seleccionado:</p>
                <p class="text-lg font-semibold">
                    {{ $course->title ?? 'Curso sin título' }}
                </p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Monto a pagar:</p>
                <p class="text-xl font-bold">
                    ${{ number_format($order->amount, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Orden interna:</p>
                <p class="font-mono text-sm">
                    {{ $order->buy_order }}
                </p>
            </div>

            <hr>

            <p class="text-gray-700">
                Cuando integremos Webpay REST aquí aparecerá el botón para ir a la pasarela
                de pago real. Por ahora esto es solo una pantalla de prueba que confirma
                que la orden se está creando correctamente.
            </p>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('curso.detalle', $course->slug) }}"
                   class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm">
                    Volver al curso
                </a>

                <button
                    type="button"
                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm"
                    disabled
                >
                    Pagar con Webpay (pronto)
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
