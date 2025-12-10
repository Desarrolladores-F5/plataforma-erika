<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-red-600 mb-6">Pago rechazado ❌</h1>

        <p>Hubo un problema con tu transacción.</p>

        <p class="mt-4">
            <strong>Orden:</strong> {{ $order->buy_order }}
        </p>

        <a href="/dashboard" class="mt-6 inline-block bg-gray-600 text-white px-4 py-2 rounded">
            Volver al Dashboard
        </a>
    </div>
</x-app-layout>
