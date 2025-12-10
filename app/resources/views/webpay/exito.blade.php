<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-green-600 mb-6">Pago exitoso 🎉</h1>

        <p>Tu pago se procesó correctamente.</p>

        <p class="mt-4">
            <strong>Orden:</strong> {{ $order->buy_order }}
        </p>

        <a href="/dashboard" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded">
            Volver al Dashboard
        </a>
    </div>
</x-app-layout>
