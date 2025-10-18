<div class="p-4 bg-white dark:bg-zinc-800 h-full shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Editar Alumno</h2>
        <button wire:click="$emitUp('closePanel')" class="text-gray-500 hover:text-gray-700">&times;</button>
    </div>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label>Nombre</label>
            <input type="text" wire:model.defer="student.name" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
        </div>
        <div>
            <label>DNI</label>
            <input type="text" wire:model.defer="student.dni" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
        </div>
        <div>
            <label>Apellido</label>
            <input type="text" wire:model.defer="student.lastname" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
        </div>
        <div>
            <label>Teléfono</label>
            <input type="text" wire:model.defer="student.phone" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
        </div>
        <div>
            <label>Dirección</label>
            <input type="text" wire:model.defer="student.address" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
    </form>
</div>
