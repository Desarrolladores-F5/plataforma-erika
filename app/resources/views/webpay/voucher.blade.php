<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        {{-- TARJETA PRINCIPAL --}}
        <div class="bg-white shadow rounded-xl p-6 space-y-6">

            {{-- ENCABEZADO --}}
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold">Comprobante de pago</h1>

                @if($order->status === 'pagado')
                    <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                        ✔ Pagado
                    </span>
                @elseif($order->status === 'pendiente')
                    <span class="px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                        ⏳ Pendiente
                    </span>
                @else
                    <span class="px-4 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                        ✖ Rechazado
                    </span>
                @endif
            </div>

            {{-- CURSO --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Curso</h2>
                <p class="text-xl font-bold">
                    {{ $order->course->title }}
                </p>
            </div>

            <hr>

            {{-- DATOS DE PAGO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Monto pagado</p>
                    <p class="text-2xl font-bold">
                        ${{ number_format($order->amount, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Fecha</p>
                    <p class="font-medium">
                        {{ $order->created_at->format('d-m-Y H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Orden interna</p>
                    <p class="font-mono text-sm">
                        {{ $order->buy_order }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Token Webpay</p>
                    <p class="font-mono text-sm text-gray-600">
                        …{{ substr($order->token, -8) }}
                    </p>
                </div>
            </div>

            <hr>

            {{-- MENSAJE --}}
            <div class="text-sm text-gray-500">
                Este comprobante acredita el pago exitoso del curso a través de Webpay.
                Guárdalo para tus registros.
            </div>

            {{-- ACCIONES --}}
            <div class="flex flex-wrap gap-4 justify-between items-center pt-4 print:hidden">
                <a href="{{ route('orders.index') }}"
                   class="text-gray-600 hover:underline">
                    ← Volver al historial
                </a>

                <div class="flex gap-3">
                    {{-- IMPRIMIR --}}
                    <button onclick="window.print()"
                            class="px-4 py-2 border rounded-lg text-gray-700
                                hover:bg-gray-100
                                transition-all duration-300
                                hover:scale-105 hover:shadow-lg">
                        🖨 Imprimir
                    </button>

                    {{-- PDF (placeholder) --}}
                    <a href="{{ route('orders.pdf', $order) }}"
                        class="px-4 py-2 border rounded-lg
                            hover:bg-gray-100
                            transition-all duration-300
                            hover:scale-105 hover:shadow-lg">
                        📄 Descargar PDF
                    </a>

                    {{-- IR AL CURSO --}}
                    <a href="{{ route('curso.detalle', $order->course->slug) }}"
                        class="px-6 py-2 rounded-lg text-white
                            hover:text-white focus:text-white active:text-white
                            transition-all duration-300
                            hover:scale-105 hover:shadow-lg"
                        style="background: var(--brand);">
                        Ir al curso
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
