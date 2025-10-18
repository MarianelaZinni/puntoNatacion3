<div class="p-4">

    {{-- Filtro --}}
    <div class="mb-4 flex items-center justify-between">
        <input 
            type="text" 
            placeholder="Buscar por nombre..." 
            wire:model.debounce.300ms="search"
            class="border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
        />
        <button wire:click="openModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Nuevo Alumno</button>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 dark:border-zinc-600">
            <thead class="bg-gray-100 dark:bg-zinc-800">
                <tr>
                    <th wire:click="sortBy('id')" class="px-4 py-2 cursor-pointer text-center">
                        ID
                        @if($sortField === 'id')
                            @if($sortDirection === 'asc')
                                <x-heroicon-o-chevron-up class="inline w-4 h-4"/>
                            @else
                                <x-heroicon-o-chevron-down class="inline w-4 h-4"/>
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('dni')" class="px-4 py-2 cursor-pointer text-center">
                        DNI
                        @if($sortField === 'dni')
                            @if($sortDirection === 'asc')
                                <x-heroicon-o-chevron-up class="inline w-4 h-4"/>
                            @else
                                <x-heroicon-o-chevron-down class="inline w-4 h-4"/>
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('name')" class="px-4 py-2 cursor-pointer text-center">
                        Nombre
                        @if($sortField === 'name')
                            @if($sortDirection === 'asc')
                                <x-heroicon-o-chevron-up class="inline w-4 h-4"/>
                            @else
                                <x-heroicon-o-chevron-down class="inline w-4 h-4"/>
                            @endif
                        @endif
                    </th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-zinc-600">
                @foreach($students as $s)
                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                    <td class="px-4 py-2 text-center">{{ $s->id }}</td>
                    <td class="px-4 py-2 text-center">{{ $s->dni }}</td>
                    <td class="px-4 py-2 text-center">{{ $s->name }}</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <x-heroicon-o-eye wire:click="openModal({{ $s->id }})" class="inline w-5 h-5 text-blue-500 hover:text-blue-700 cursor-pointer" title="Ver Detalle"/>
                        <x-heroicon-o-pencil wire:click="openModal({{ $s->id }})" class="inline w-5 h-5 text-amber-500 hover:text-amber-700 cursor-pointer" title="Editar"/>
                        <x-heroicon-o-trash wire:click="confirmDelete({{ $s->id }})" class="inline w-5 h-5 text-red-500 hover:text-red-700 cursor-pointer" title="Eliminar"/>
                        <x-heroicon-o-academic-cap wire:click="openEnrollModal({{ $s->id }})" class="inline w-5 h-5 text-green-500 hover:text-green-700 cursor-pointer" title="Inscribir a Clase"/>
                        <x-heroicon-o-banknotes wire:click="openPaymentModal({{ $s->id }})" class="inline w-5 h-5 text-emerald-500 hover:text-emerald-700 cursor-pointer" title="Registrar Pago"/>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">{{ $students->links() }}</div>

    {{-- Modal --}}
    @if($showModal)
        <livewire:student-modal :studentId="$selectedStudentId" wire:key="student-modal-{{ $selectedStudentId }}"/>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('livewire:load', function () {

    Livewire.on('confirm-delete', data => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('students-table', 'delete', data.id);
            }
        });
    });

    setInterval(() => {
        Livewire.emitTo('students-table', 'refreshTable');
    }, 10000);

});
</script>
@endpush
