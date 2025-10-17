<div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
    <div class="bg-base-200 rounded-lg w-full max-w-3xl shadow-lg relative">
        <div class="flex justify-between p-4 border-b">
            <h3 class="font-bold text-lg">
                @if($mode === 'create') Nuevo Alumno
                @elseif($mode === 'edit') Editar Alumno
                @else Ver Alumno
                @endif
            </h3>
            <button class="btn btn-sm btn-ghost" wire:click="$parent.showModal = false">✕</button>
        </div>

        <div class="tabs tabs-bordered px-4">
            <a class="tab {{ $tab==='info'?'tab-active':'' }}" wire:click="$set('tab', 'info')">Datos</a>
            <a class="tab {{ $tab==='classes'?'tab-active':'' }}" wire:click="$set('tab', 'classes')">Clases</a>
            <a class="tab {{ $tab==='payments'?'tab-active':'' }}" wire:click="$set('tab', 'payments')">Pagos</a>
        </div>

        <div class="p-4">
            @if ($tab === 'info')
                <form wire:submit.prevent="save" class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label">Nombre</label>
                        <input type="text" class="input input-bordered w-full" wire:model="student.firstname" {{ $mode==='view'?'readonly':'' }}>
                        @error('student.firstname') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label">Apellido</label>
                        <input type="text" class="input input-bordered w-full" wire:model="student.lastname" {{ $mode==='view'?'readonly':'' }}>
                        @error('student.lastname') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label">DNI</label>
                        <input type="text" class="input input-bordered w-full" wire:model="student.dni" {{ $mode==='view'?'readonly':'' }}>
                        @error('student.dni') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label">Email</label>
                        <input type="email" class="input input-bordered w-full" wire:model="student.email" {{ $mode==='view'?'readonly':'' }}>
                        @error('student.email') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label">Teléfono</label>
                        <input type="text" class="input input-bordered w-full" wire:model="student.phone" {{ $mode==='view'?'readonly':'' }}>
                        @error('student.phone') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    @if ($mode !== 'view')
                        <div class="col-span-2 text-right mt-4">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    @endif
                </form>

            @elseif ($tab === 'classes')
                <ul>
                    @forelse ($student->classes as $class)
                        <li>{{ $class->name }} ({{ $class->day }} - {{ $class->time }})</li>
                    @empty
                        <li>No hay clases registradas.</li>
                    @endforelse
                </ul>

            @elseif ($tab === 'payments')
                <ul>
                    @forelse ($student->payments as $payment)
                        <li>${{ $payment->amount }} - {{ $payment->created_at->format('d/m/Y') }}</li>
                    @empty
                        <li>No hay pagos registrados.</li>
                    @endforelse
                </ul>
            @endif
        </div>
    </div>
</div>
