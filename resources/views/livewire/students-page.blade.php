<div class="flex h-full space-x-4">

    {{-- Tabla de alumnos --}}
    <div class="flex-1 transition-all duration-200" 
         :class="{'w-2/3': @entangle('showPanel'), 'w-full': !@entangle('showPanel')}">
        <div class="p-4">
            <input 
                type="text" 
                placeholder="Buscar por nombre..." 
                wire:model.debounce.300ms="search"
                class="border rounded px-3 py-2 w-full mb-4 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
            />

            <table class="min-w-full border border-gray-200 dark:border-zinc-600">
                <thead class="bg-gray-100 dark:bg-zinc-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">DNI</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                    @foreach($students as $s)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-600">
                        <td class="px-4 py-2">{{ $s->id }}</td>
                        <td class="px-4 py-2">{{ $s->dni }}</td>
                        <td class="px-4 py-2">{{ $s->name }}</td>
                        <td class="px-4 py-2">
                            <x-heroicon-o-pencil 
                                wire:click="selectStudent({{ $s->id }})"
                                class="w-5 h-5 text-blue-500 cursor-pointer"
                                title="Editar"
                            />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>

    {{-- Panel lateral --}}
    <div class="w-0 overflow-hidden transition-all duration-200"
         style="flex: none;"
         :class="{'w-1/3': @entangle('showPanel')}">
        @if($selectedStudentId)
            <livewire:student-form :studentId="$selectedStudentId" wire:key="student-form-{{ $selectedStudentId }}" />
        @endif
    </div>

</div>