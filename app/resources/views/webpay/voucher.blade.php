{{-- resources/views/webpay/voucher.blade.php --}}

<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">
            Comprobante de pago Webpay
        </h1>

        <div class="bg-white shadow rounded-lg p-6 space-y-3">
            @if($success ?? false)
                <p class="text-green-700 font-semibold">
                    ✅ Transacción aprobada
                </p>
            @else
                <p class="text-red-700 font-semibold">
                    ❌ Transacción rechazada
                </p>
            @endif

            <p>
                <span class="font-semibold">Curso:</span>
                {{ $order->course->title ?? 'Curso' }}
            </p>

            <p>
                <span class="font-semibold">Monto:</span>
                ${{ number_format($order->amount, 0, ',', '.') }}
            </p>

            <p>
                <span class="font-semibold">Orden interna:</span>
                {{ $order->buy_order }}
            </p>

            <p>
                <span class="font-semibold">Token Webpay:</span>
                {{ $order->token }}
            </p>

            <p>
                <span class="font-semibold">Fecha:</span>
                {{ $order->updated_at->format('d-m-Y H:i') }}
            </p>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('curso.detalle', $order->course->slug) }}"
               class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm">
                Ir al curso
            </a>

            <a href="{{ route('dashboard') }}"
               class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm">
                Volver al dashboard
            </a>
        </div>
    </div>
</x-app-layout>
