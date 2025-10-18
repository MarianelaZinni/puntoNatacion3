<x-layouts.app.sidebar title="Alumnos">

    <flux:main id="main-content" class="transition-all duration-300 p-6 relative overflow-hidden">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Alumnos</h1>
            <button id="btnNuevoAlumno"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Nuevo alumno
            </button>
        </div>

        {{-- Tabla --}}
        <div class="overflow-x-auto bg-white dark:bg-zinc-800 shadow rounded-lg p-4">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100 dark:bg-zinc-700">
                    <tr>
                        <th class="px-4 py-2 text-left">DNI</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Dirección</th>
                        <th class="px-4 py-2 text-left">Teléfono</th>
                        <th class="px-4 py-2 text-left">Email</th>
                    </tr>
                </thead>
                <tbody id="studentsTable">
                    @foreach ($students as $student)
                        <tr class="border-b border-gray-200 dark:border-zinc-700">
                            <td class="px-4 py-2">{{ $student->dni }}</td>
                            <td class="px-4 py-2">{{ $student->name }}</td>
                            <td class="px-4 py-2">{{ $student->address }}</td>
                            <td class="px-4 py-2">{{ $student->phone }}</td>
                            <td class="px-4 py-2">{{ $student->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Panel lateral (oculto al inicio) --}}
        <div id="sidePanel" 
            class="fixed top-0 right-0 h-full w-full sm:w-1/3 max-w-md bg-white dark:bg-zinc-900 shadow-2xl
                   transform translate-x-full transition-transform duration-300 ease-in-out z-50 hidden">

            <div class="p-4 border-b border-gray-300 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Nuevo Alumno</h2>
                <button id="btnCerrarPanel" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <div class="p-4 overflow-y-auto h-[calc(100%-60px)]">
                @include('students.partials.form')
            </div>
        </div>

    </flux:main>

    @push('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnNuevo = document.getElementById("btnNuevoAlumno");
        const btnCerrar = document.getElementById("btnCerrarPanel");
        const panel = document.getElementById("sidePanel");
        const form = document.getElementById("studentForm");

        btnNuevo.addEventListener("click", () => {
            panel.classList.remove("translate-x-full", "hidden");
        });

        btnCerrar.addEventListener("click", () => {
            panel.classList.add("translate-x-full");
            setTimeout(() => panel.classList.add("hidden"), 300); // oculta después de la animación
        });

        form.addEventListener("submit", async function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            const response = await fetch("{{ route('students.store') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: formData
            });

            if (response.ok) {
                panel.classList.add("translate-x-full");
                setTimeout(() => panel.classList.add("hidden"), 300);
                location.reload();
            } else {
                alert("Error al guardar el alumno");
            }
        });
    });
    </script>
    @endpush

</x-layouts.app.sidebar>

