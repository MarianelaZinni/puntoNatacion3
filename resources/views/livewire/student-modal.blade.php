<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-zinc-800 w-full max-w-3xl rounded-lg shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-zinc-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                @if($student) {{ $student->name }} @endif
            </h2>
            <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">&times;</button>
        </div>

        {{-- Tabs --}}
        <div class="flex border-b border-gray-200 dark:border-zinc-700">
            @foreach($tabs as $key => $label)
                <button wire:click="setTab('{{ $key }}')" 
                        class="px-4 py-2 -mb-px font-medium border-b-2"
                        :class="$activeTab === '{{ $key }}' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white'">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Content --}}
        <div class="p-4 max-h-[70vh] overflow-y-auto">

            {{-- Detalle --}}
            @if($activeTab === 'detalle' && $student)
                <div class="space-y-2">
                    <p><strong>ID:</strong> {{ $student->id }}</p>
                    <p><strong>DNI:</strong> {{ $student->dni }}</p>
                    <p><strong>Nombre:</strong> {{ $student->name }}</p>
                    <p><strong>Apellido:</strong> {{ $student->lastname }}</p>
                    <p><strong>Teléfono:</strong> {{ $student->phone }}</p>
                    <p><strong>Dirección:</strong> {{ $student->address }}</p>
                </div>
            @endif

            {{-- Clases --}}
            @if($activeTab === 'clases')
                @if(count($classes))
                    <table class="min-w-full border border-gray-200 dark:border-zinc-600">
                        <thead class="bg-gray-100 dark:bg-zinc-700">
                            <tr>
                                <th class="px-4 py-2 text-center">ID</th>
                                <th class="px-4 py-2 text-center">Nombre Clase</th>
                                <th class="px-4 py-2 text-center">Horario</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                            @foreach($classes as $c)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-600">
                                    <td class="px-4 py-2 text-center">{{ $c->id }}</td>
                                    <td class="px-4 py-2 text-center">{{ $c->name }}</td>
                                    <td class="px-4 py-2 text-center">{{ $c->schedule }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600 dark:text-gray-300">No hay clases registradas</p>
                @endif
            @endif

            {{-- Pagos --}}
            @if($activeTab === 'pagos')
                @if(count($payments))
                    <table class="min-w-full border border-gray-200 dark:border-zinc-600">
                        <thead class="bg-gray-100 dark:bg-zinc-700">
                            <tr>
                                <th class="px-4 py-2 text-center">ID</th>
                                <th class="px-4 py-2 text-center">Monto</th>
                                <th class="px-4 py-2 text-center">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                            @foreach($payments as $p)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-600">
                                    <td class="px-4 py-2 text-center">{{ $p->id }}</td>
                                    <td class="px-4 py-2 text-center">{{ $p->amount }}</td>
                                    <td class="px-4 py-2 text-center">{{ $p->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600 dark:text-gray-300">No hay pagos registrados</p>
                @endif
            @endif

        </div>
    </div>
</div>
