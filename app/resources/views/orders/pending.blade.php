<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-800">
                ⏳ Orden pendiente
            </h2>

            <p class="mt-4 text-gray-700">
                Esta compra aún no ha sido confirmada por Webpay.
            </p>

            <p class="mt-2 text-sm text-gray-500">
                Orden: {{ $order->buy_order }}
            </p>

            <div class="mt-6">
                <a href="{{ route('orders.index') }}"
                   class="text-indigo-600 hover:underline">
                    ← Volver al historial
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
