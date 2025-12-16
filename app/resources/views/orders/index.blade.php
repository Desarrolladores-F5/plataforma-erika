<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            🧾 Historial de compras
        </h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Curso</th>
                        <th class="px-4 py-3">Monto</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Comprobante</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-t">
                            <td class="px-4 py-3">
                                {{ $order->course->title ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                ${{ number_format($order->amount, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($order->status === 'pagado')
                                    <span class="text-green-600 font-semibold">✔ Pagado</span>
                                @elseif($order->status === 'rechazado')
                                    <span class="text-red-600 font-semibold">✖ Rechazado</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">⏳ Pendiente</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $order->created_at->format('d-m-Y H:i') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('webpay.retorno', ['token_ws' => $order->token]) }}"
                                   class="text-indigo-600 hover:underline">
                                    Ver voucher
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Aún no tienes compras registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
