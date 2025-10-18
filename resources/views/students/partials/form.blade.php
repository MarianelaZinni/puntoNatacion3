<form id="studentForm" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">DNI</label>
        <input type="text" name="dni" class="w-full mt-1 p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
        <input type="text" name="name" class="w-full mt-1 p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
        <input type="text" name="address" class="w-full mt-1 p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
        <input type="text" name="phone" class="w-full mt-1 p-2 border rounded">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input type="email" name="email" class="w-full mt-1 p-2 border rounded">
    </div>

    <div class="flex justify-end pt-4">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar
        </button>
    </div>
</form>

