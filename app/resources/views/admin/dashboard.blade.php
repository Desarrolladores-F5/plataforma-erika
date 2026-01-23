<x-app-layout :hideNav="false">

    {{-- FONDO --}}
    <div class="py-12 bg-[#FFF7EF]">
        {{-- CONTENEDOR REAL --}}
        <div class="max-w-6xl mx-auto px-6 space-y-12">

        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="brand-title">
                        🧑‍💼 Panel Administrativo
                    </h1>
                    <p class="brand-subtitle mt-1">
                        Gestión general de la plataforma
                    </p>
                </div>

                <span class="text-sm text-gray-500">
                    {{ now()->format('d-m-Y H:i') }}
                </span>
            </div>
        </div>


            {{-- CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100">
                    <p class="text-sm text-gray-500">Total ventas (pagadas)</p>
                    <p class="text-2xl font-bold mt-2 text-orange-700">
                        ${{ number_format($totalVentas ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100">
                    <p class="text-sm text-gray-500">Órdenes pagadas</p>
                    <p class="text-2xl font-bold mt-2 text-orange-700">
                        {{ $totalOrdenes ?? 0 }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100">
                    <p class="text-sm text-gray-500">Alumnos registrados</p>
                    <p class="text-2xl font-bold mt-2 text-orange-700">
                        {{ $totalAlumnos ?? 0 }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100">
                    <p class="text-sm text-gray-500">Cursos en la plataforma</p>
                    <p class="text-2xl font-bold mt-2 text-orange-700">
                        {{ $totalCursos ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- ACCIONES ADMIN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 mb-12">

                <a href="{{ route('admin.orders.index') }}"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-white border border-orange-300 text-orange-700 font-semibold shadow hover:bg-orange-50 transition">
                    🧾 Gestionar órdenes
                </a>

                <a href="{{ route('admin.students.index') }}"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-white border border-orange-300 text-orange-700 font-semibold shadow hover:bg-orange-50 transition">
                    👥 Ver alumnos
                </a>

                <a href="{{ route('admin.courses.index') }}"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-white border border-orange-300 text-orange-700 font-semibold shadow hover:bg-orange-50 transition">
                    📚 Gestionar cursos
                </a>

            </div>


            <div class="h-px bg-orange-200/60"></div>
            
            {{-- VENTAS POR CURSO --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100 mt-12">
                <h3 class="text-lg font-semibold text-orange-800 mb-4">
                    📈 Ventas por curso (Top)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($ventasPorCurso as $row)
                        <div class="flex justify-between items-center bg-orange-50 border border-orange-100 rounded-lg p-4">
                            <div>
                                <p class="font-semibold">
                                    {{ $row->course->title }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Compras: {{ $row->compras }} • Total:
                                    ${{ number_format($row->total, 0, ',', '.') }}
                                </p>
                            </div>

                            <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold">
                                Top
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>


            {{-- 📊 Ventas por día --}}
            <div class="bg-white rounded-xl shadow-sm border border-orange-100 p-6 mt-8">
                <h3 class="text-lg font-semibold text-orange-800 mb-4">
                    📊 Ventas por día (últimos 7 días)
                </h3>

                @if($ventasPorDia->isEmpty())
                    <p class="text-sm text-gray-500">
                        Aún no hay ventas registradas.
                    </p>
                @else
                    <table class="min-w-full text-sm">
                        <thead class="bg-orange-50 text-gray-700 uppercase">
                            <tr>
                                <th class="px-4 py-2 text-left">Fecha</th>
                                <th class="px-4 py-2 text-right">Total vendido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventasPorDia as $venta)
                                <tr class="border-t">
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($venta->fecha)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-4 py-2 text-right font-semibold text-green-700">
                                        ${{ number_format($venta->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>


            {{-- 📊 Ventas por mes --}}
            <div class="bg-white rounded-xl shadow-sm border border-orange-100 p-6 mt-8">
                <h3 class="text-lg font-semibold text-orange-800 mb-4">
                    📆 Ventas por mes
                </h3>

                @if($ventasPorMes->isEmpty())
                    <p class="text-sm text-gray-500">
                        Aún no hay ventas mensuales.
                    </p>
                @else
                    <div class="w-full">
                        <canvas id="chartVentasPorMes" height="90"></canvas>
                    </div>
                @endif
            </div>

            {{-- Alumnos Activos --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-orange-100">
                <p class="text-sm text-gray-500">Alumnos activos</p>
                <p class="text-2xl font-bold mt-2 text-green-700">
                    {{ $alumnosActivos ?? 0 }}
                </p>
            </div>

            <div class="h-px bg-orange-200/60"></div>

            {{-- ÚLTIMAS ÓRDENES --}}
            <div class="bg-white rounded-xl shadow border border-orange-100 overflow-hidden mt-12">
                <div class="p-6 border-b bg-orange-50">
                    <h3 class="text-lg font-semibold text-orange-800">
                        🧾 Últimas órdenes
                    </h3>
                    <p class="text-sm text-gray-600">
                        Últimos 10 movimientos (pagadas/pendientes/rechazadas).
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase">
                            <tr>
                                <th class="px-4 py-3 text-left">Fecha</th>
                                <th class="px-4 py-3 text-left">Usuario</th>
                                <th class="px-4 py-3 text-left">Curso</th>
                                <th class="px-4 py-3 text-center">Monto</th>
                                <th class="px-4 py-3 text-center">Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ultimasOrdenes as $order)
                                <tr class="border-t">
                                    <td class="px-4 py-3">
                                        {{ $order->created_at->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $order->user->name }}
                                        <div class="text-xs text-gray-500">
                                            {{ $order->user->email }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $order->course->title }}
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ventasMesLabels = @json($ventasPorMes->pluck('mes'));
            const ventasMesTotales = @json($ventasPorMes->pluck('total'));

            // Si tus meses vienen como "2025-12", los mostramos bonito:
            const prettyLabels = ventasMesLabels.map(m => {
                const [y, mm] = m.split('-');
                return `${mm}/${y}`;
            });

            const ctx = document.getElementById('chartVentasPorMes');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: prettyLabels,
                        datasets: [{
                            label: 'Total vendido',
                            data: ventasMesTotales
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: (value) => '$' + value.toLocaleString('es-CL')
                                }
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
