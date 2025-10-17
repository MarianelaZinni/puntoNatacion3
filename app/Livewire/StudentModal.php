<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentModal extends Component
{
    public $studentId;
    public $student;
    public $tab = 'info';
    public $mode = 'view';

    public function mount($studentId = null)
    {
        $this->student = $studentId ? Student::with(['classes', 'payments'])->find($studentId) : new Student();
        $this->mode = $studentId ? 'view' : 'create';
    }

    public function save()
    {
        $this->validate([
            'student.firstname' => 'required|string|max:255',
            'student.lastname'  => 'required|string|max:255',
            'student.dni'       => 'required|string|max:20|unique:students,dni,' . $this->student->id,
            'student.email'     => 'nullable|email',
            'student.phone'     => 'nullable|string|max:20',
        ]);

        $this->student->save();

        $this->dispatch('studentUpdated');
        $this->dispatchBrowserEvent('notify', ['message' => 'Alumno guardado correctamente']);
    }

    public function render()
    {
        return view('livewire.student-modal');
    }
}
