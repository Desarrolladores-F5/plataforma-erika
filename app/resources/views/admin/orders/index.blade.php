<x-app-layout>    

    <div class="py-6 bg-[#FFF7EF]">
        <div class="max-w-6xl mx-auto px-6 mt-4">

            {{-- HEADER INTERNO (TÍTULO + BOTÓN) --}}
            <div class="flex items-center justify-between mb-6 px-6">
                <h2 class="text-xl font-semibold text-orange-800">
                    🧾 Gestión de Órdenes
                </h2>

                <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold
                        rounded-md bg-orange-600 text-white
                        hover:bg-orange-700 transition">
                    ⬅ Volver al Panel Admin
                </a>
            </div>


            {{-- ✅ FILTROS ADMIN (AQUÍ VA) --}}
            <form method="GET" class="mb-6 flex flex-wrap gap-4 items-center">

                <input type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Buscar por alumno o curso..."
                    class="rounded-md border-gray-300 text-sm w-64
                        focus:ring-orange-500 focus:border-orange-500">

                <select name="status"
                    class="rounded-md border-gray-300 text-sm
                        focus:ring-orange-500 focus:border-orange-500">
                    <option value="">— Todos los estados —</option>
                    <option value="pendiente" {{ request('status') === 'pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                    <option value="pagado" {{ request('status') === 'pagado' ? 'selected' : '' }}>✔ Pagado</option>
                    <option value="rechazado" {{ request('status') === 'rechazado' ? 'selected' : '' }}>✖ Rechazado</option>
                </select>

                <button type="submit"
                    class="px-4 py-2 rounded-md text-sm font-semibold
                           bg-green-600 text-white shadow-sm
                           hover:bg-green-700 focus:outline-none focus:ring-2
                           focus:ring-green-400 focus:ring-offset-2 transition">
                    Filtrar
                </button>

                @if(request()->has('status') || request()->has('q'))
                    <a href="{{ route('admin.orders.index') }}"
                    class="text-sm text-gray-500 underline">
                        Limpiar filtros
                    </a>
                @endif
            </form>

            {{-- 👇 TABLA --}}
            <div class="bg-white rounded-xl shadow border border-orange-100 overflow-hidden">

                <table class="min-w-full text-sm">
                    <thead class="bg-orange-50 text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Fecha</th>
                            <th class="px-4 py-3 text-left">Usuario</th>
                            <th class="px-4 py-3 text-left">Curso</th>
                            <th class="px-4 py-3 text-center">Monto</th>
                            <th class="px-4 py-3 text-center">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
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
                                    {{ $order->course->title ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    ${{ number_format($order->amount, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 text-center align-middle">
                                    <form method="POST"
                                        action="{{ route('admin.orders.update', $order) }}"
                                        class="flex flex-col items-center gap-2">
                                        @csrf
                                        @method('PATCH')

                                        {{-- BADGE --}}
                                        @php
                                            $badgeClasses = match($order->status) {
                                                'pagado' => 'bg-green-100 text-green-700',
                                                'pendiente' => 'bg-yellow-100 text-yellow-700',
                                                'rechazado' => 'bg-red-100 text-red-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp

                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClasses }}">
                                            {{ ucfirst($order->status) }}
                                        </span>

                                        {{-- SELECT --}}
                                        <select name="status"
                                                onchange="this.form.submit()"
                                                class="w-40 text-sm rounded-md border-gray-300
                                                    focus:ring-orange-500 focus:border-orange-500">
                                            <option value="pendiente" {{ $order->status === 'pendiente' ? 'selected' : '' }}>
                                                ⏳ Pendiente
                                            </option>
                                            <option value="pagado" {{ $order->status === 'pagado' ? 'selected' : '' }}>
                                                ✔ Pagado
                                            </option>
                                            <option value="rechazado" {{ $order->status === 'rechazado' ? 'selected' : '' }}>
                                                ✖ Rechazado
                                            </option>
                                        </select>
                                    </form>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    No hay órdenes registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
