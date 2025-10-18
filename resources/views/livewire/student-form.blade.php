<div class="p-6 bg-white dark:bg-zinc-800 h-full border-l border-gray-200 dark:border-zinc-700">
    <h2 class="text-lg font-semibold mb-4">
        {{ $studentId ? 'Editar Alumno' : 'Nuevo Alumno' }}
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Nombre</label>
            <input wire:model="name" type="text" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">DNI</label>
            <input wire:model="dni" type="text" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600">
        </div>

        <div>
            <label class="block text-sm font-medium">Teléfono</label>
            <input wire:model="phone" type="text" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600">
        </div>

        <div>
            <label class="block text-sm font-medium">Dirección</label>
            <input wire:model="address" type="text" class="w-full border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600">
        </div>

        <div class="flex justify-end space-x-2 mt-4">
            <button type="button" wire:click="close" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Guardar</button>
        </div>
    </form>
</div>
