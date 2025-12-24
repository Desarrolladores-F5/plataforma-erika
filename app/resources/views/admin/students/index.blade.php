<x-app-layout>

    <div class="py-6 bg-[#FFF7EF]">
        <div class="max-w-6xl mx-auto px-6 mt-4">

            {{-- HEADER --}}
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

            {{-- 🔎 FILTROS --}}
            <form method="GET" class="mb-6 flex flex-wrap gap-4 items-end">

                {{-- Buscar --}}
                <div>
                    <label class="text-xs text-gray-500">Buscar</label>
                    <input type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Nombre o email"
                        class="w-48 rounded-md border-gray-300 text-sm
                            focus:ring-orange-500 focus:border-orange-500">
                </div>

                {{-- Género --}}
                <div>
                    <label class="text-xs text-gray-500">Género</label>
                    <select name="gender"
                        class="w-40 rounded-md border-gray-300 text-sm
                            focus:ring-orange-500 focus:border-orange-500">
                        <option value="">— Todos —</option>
                        <option value="femenino" {{ request('gender') === 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="masculino" {{ request('gender') === 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="otro" {{ request('gender') === 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                {{-- Comuna --}}
                <div>
                    <label class="text-xs text-gray-500">Comuna</label>
                    <input type="text"
                        name="comuna"
                        value="{{ request('comuna') }}"
                        placeholder="Ej: Quilpué"
                        class="w-40 rounded-md border-gray-300 text-sm
                            focus:ring-orange-500 focus:border-orange-500">
                </div>

                {{-- Nacimiento desde --}}
                <div>
                    <label class="text-xs text-gray-500">Nacimiento desde</label>
                    <input type="date"
                        name="birth_from"
                        value="{{ request('birth_from') }}"
                        class="rounded-md border-gray-300 text-sm
                            focus:ring-orange-500 focus:border-orange-500">
                </div>

                {{-- Nacimiento hasta --}}
                <div>
                    <label class="text-xs text-gray-500">Nacimiento hasta</label>
                    <input type="date"
                        name="birth_to"
                        value="{{ request('birth_to') }}"
                        class="rounded-md border-gray-300 text-sm
                            focus:ring-orange-500 focus:border-orange-500">
                </div>
                

                {{-- Botón --}}
                <div>
                    <button type="submit"
                        class="px-4 py-2 rounded-md text-sm font-semibold
                            bg-green-600 text-white
                            hover:bg-green-700 transition">
                        Filtrar
                    </button>
                </div>

                {{-- Limpiar --}}
                @if(request()->hasAny(['q', 'gender', 'comuna']))
                    <a href="{{ route('admin.students.index') }}"
                    class="text-sm text-gray-500 underline ml-2">
                        Limpiar filtros
                    </a>
                @endif
            </form>                
            

            {{-- TABLA --}}
            <div class="bg-white rounded-xl shadow border border-orange-100 overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-orange-50 text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Nombre</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Género</th>
                            <th class="px-4 py-3 text-left">Comuna</th>
                            <th class="px-4 py-3 text-center">Nacimiento</th>
                            <th class="px-4 py-3 text-center">Registro</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($students as $student)
                            <tr class="border-t">
                                <td class="px-4 py-3 font-medium">
                                    {{ $student->name }}
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ $student->email }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $student->gender ?? '—' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $student->comuna ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $student->birth_date
                                        ? \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y')
                                        : '—' }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $student->created_at->format('d-m-Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    No hay alumnos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-6">
                {{ $students->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
