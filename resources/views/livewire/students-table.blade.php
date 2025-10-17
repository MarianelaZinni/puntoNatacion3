<div wire:poll.10s>
    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar por nombre..." class="input input-bordered" />
        <button class="btn btn-primary" wire:click="openModal">Nuevo Alumno</button>
    </div>

    <table class="table w-full">
        <thead>
            <tr>
                <th wire:click="sortBy('id')" class="cursor-pointer px-4 py-2 text-center">
                    ID 
                    @if($sortField === 'id')
                        @if($sortDirection === 'asc')
                            <x-heroicon-o-chevron-up class="inline w-4 h-4 text-gray-600 dark:text-gray-300" />
                        @else
                            <x-heroicon-o-chevron-down class="inline w-4 h-4 text-gray-600 dark:text-gray-300" />
                        @endif
                    @endif
                </th>
                <th wire:click="sortBy('dni')" class="cursor-pointer px-4 py-2 text-center">
                    DNI  
                    @if($sortField === 'dni')
                        @if($sortDirection === 'asc')
                            <x-heroicon-o-chevron-up class="inline w-4 h-4 text-gray-600 dark:text-gray-300" />
                        @else
                            <x-heroicon-o-chevron-down class="inline w-4 h-4 text-gray-600 dark:text-gray-300" />
                        @endif
                    @endif
                </th>
                 <th wire:click="sortBy('name')" class="cursor-pointer px-4 py-2 text-center">
                    NOMBRE
                @if($sortField === 'name')
                    @if($sortDirection === 'asc')
                            <x-heroicon-o-chevron-up class="inline w-4 h-4 text-gray-600 dark:text-gray-300" />
                        @else
                            <x-heroicon-o-chevron-down class="inline w-4 h-4 text-gray-600 dark:text-gray-300" />
                        @endif
                    @endif
                </th>
                <th class = "px-4 py-2 text-center">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
    @foreach($students as $s)
        <tr>
            <td class="px-4 py-2 text-center">{{ $s->id }}</td>
            <td class="px-4 py-2 text-center">{{ $s->dni }}</td>
            <td class="px-4 py-2 text-center">{{ $s->name }}</td>
            <td class="px-4 py-2 text-center align-middle space-x-2">
                {{-- Ver Detalle --}}
                <x-heroicon-o-eye 
                    wire:click="openModal({{ $s->id }})"
                    class="inline w-5 h-5 text-blue-500 hover:text-blue-700 cursor-pointer"
                    title="Ver Detalle"
                />

                {{-- Editar --}}
                <x-heroicon-o-pencil 
                    wire:click="openModal({{ $s->id }})"
                    class="inline w-5 h-5 text-amber-500 hover:text-amber-700 cursor-pointer"
                    title="Editar"
                />

                {{-- Eliminar --}}
                <x-heroicon-o-trash 
                    wire:click="confirmDelete({{ $s->id }})"
                    class="inline w-5 h-5 text-red-500 hover:text-red-700 cursor-pointer"
                    title="Eliminar"
                />

                {{-- Inscribir a Clase --}}
                <x-heroicon-o-academic-cap 
                    wire:click="openEnrollModal({{ $s->id }})"
                    class="inline w-5 h-5 text-green-500 hover:text-green-700 cursor-pointer"
                    title="Inscribir a Clase"
                />

                {{-- Registrar Pago --}}
                <x-heroicon-o-banknotes 
                    wire:click="openPaymentModal({{ $s->id }})"
                    class="inline w-5 h-5 text-emerald-500 hover:text-emerald-700 cursor-pointer"
                    title="Registrar Pago"
                />
            </td>
        </tr>
    @endforeach
</tbody>
    </table>

    {{ $students->links() }}

    @if($showModal)
        <livewire:student-modal :studentId="$selectedStudentId" wire:key="student-modal-{{ $selectedStudentId }}" />
    @endif
</div>

<script>
document.addEventListener('confirm-delete', event => {
    Swal.fire({
        title: '¿Eliminar alumno?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then(result => {
        if (result.isConfirmed) {
            Livewire.dispatch('delete', { id: event.detail.id });
        }
    });
});

document.addEventListener('notify', event => {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: event.detail.message,
        showConfirmButton: false,
        timer: 2000
    });
});
</script>
