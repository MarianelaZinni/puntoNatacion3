<div class="flex transition-all duration-500 ease-in-out">
    {{-- Tabla de alumnos --}}
    <div class="{{ $showForm ? 'w-2/3' : 'w-full' }} transition-all duration-500">
        <livewire:students-table />
    </div>

    {{-- Panel de formulario --}}
    <div class="{{ $showForm ? 'w-1/3' : 'w-0 overflow-hidden' }} transition-all duration-500">
        @if ($showForm)
            <livewire:student-form :studentId="$selectedStudentId" />
        @endif
    </div>
</div>
