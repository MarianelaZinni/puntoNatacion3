<div class="p-4">
    <div class="mb-4 flex justify-between items-center">
        <input 
            type="text" 
            wire:model.debounce.300ms="search"
            placeholder="Buscar por nombre..."
            class="border rounded px-3 py-2 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
        >
        <button 
            wire:click="openForm()" 
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
        >
            Nuevo Alumno
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 dark:border-zinc-600">
            <thead class="bg-gray-100 dark:bg-zinc-800">
                <tr>
                    <th wire:click="sortBy('id')" class="px-4 py-2 text-center cursor-pointer">
                        ID
                        @if($sortField === 'id')
                            <x-heroicon-o-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} class="inline w-4 h-4" />
                        @endif
                    </th>
                    <th wire:click="sortBy('name')" class="px-4 py-2 text-center cursor-pointer">
                        Nombre
                        @if($sortField === 'name')
                            <x-heroicon-o-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} class="inline w-4 h-4" />
                        @endif
                    </th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $s)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                        <td class="text-center px-4 py-2">{{ $s->id }}</td>
                        <td class="text-center px-4 py-2">{{ $s->name }}</td>
                        <td class="text-center px-4 py-2">
                            <x-heroicon-o-pencil 
                                wire:click="openForm({{ $s->id }})"
                                class="inline w-5 h-5 text-amber-500 hover:text-amber-700 cursor-pointer"
                                title="Editar"
                            />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>
</div>
