<div wire:poll.10s>
    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar por nombre..." class="input input-bordered" />
        <button class="btn btn-primary" wire:click="openModal">Nuevo Alumno</button>
    </div>

    <table class="table w-full">
        <thead>
            <tr>
                <th wire:click="sortBy('id')" class="cursor-pointer">
                    ID @if($sortField === 'id') ({{ strtoupper($sortDirection) }}) @endif
                </th>
                <th wire:click="sortBy('dni')" class="cursor-pointer">
                    DNI @if($sortField === 'dni') ({{ strtoupper($sortDirection) }}) @endif
                </th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->dni }}</td>
                <td>{{ $s->name }}</td>
                <td class="space-x-1">
                    <button class="btn btn-xs" wire:click="openModal({{ $s->id }})">Ver</button>
                    <button class="btn btn-xs btn-warning" wire:click="openModal({{ $s->id }})">Editar</button>
                    <button class="btn btn-xs btn-error" wire:click="confirmDelete({{ $s->id }})">Eliminar</button>
                    <button class="btn btn-xs btn-info">Inscribir</button>
                    <button class="btn btn-xs btn-accent">Pagos</button>
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
