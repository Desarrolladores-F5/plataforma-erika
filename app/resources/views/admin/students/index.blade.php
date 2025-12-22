<x-app-layout>   

    {{-- 🔧 ESPACIADOR REAL ENTRE HEADER Y CONTENIDO --}}    

    <div class="py-6 bg-[#FFF7EF]">
        <div class="max-w-6xl mx-auto px-6 mt-4">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-orange-800 flex items-center gap-2">
                    👥 Alumnos registrados
                </h2>

                <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold
                        rounded-md bg-orange-600 text-white
                        hover:bg-orange-700 transition">
                    ⬅ Volver al Panel Admin
                </a>
            </div>

            <div class="bg-white rounded-xl shadow border border-orange-100 overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-orange-50 text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Nombre</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-center">Fecha registro</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($students as $student)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $student->name }}</td>
                                <td class="px-4 py-3">{{ $student->email }}</td>
                                <td class="px-4 py-3 text-center">
                                    {{ $student->created_at->format('d-m-Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                    No hay alumnos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $students->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
