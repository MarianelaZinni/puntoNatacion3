<table class="min-w-full border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden">
    <thead class="bg-zinc-100 dark:bg-zinc-700 text-zinc-900 dark:text-white">
        <tr>
            <th class="p-2 text-left">ID</th>
            <th class="p-2 text-left">DNI</th>
            <th class="p-2 text-left">Nombre</th>
            <th class="p-2 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
        @foreach ($students as $student)
            <tr class="border-b border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                <td class="p-2">{{ $student->id }}</td>
                <td class="p-2">{{ $student->dni }}</td>
                <td class="p-2">{{ $student->nombre }}</td>
                <td class="p-2 space-x-1">
                    <button onclick="openFormPanel('view', {{ $student->id }})" title="Ver">👁️</button>
                    <button onclick="openFormPanel('edit', {{ $student->id }})" title="Editar">✏️</button>
                    <button onclick="deleteStudent({{ $student->id }})" title="Eliminar">🗑️</button>
                    <button onclick="enrollClass({{ $student->id }})" title="Inscribir a clase">🎓</button>
                    <button onclick="registerPayment({{ $student->id }})" title="Registrar pago">💰</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
