<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentForm extends Component
{
    public $studentId;
    public $student;

    protected $rules = [
        'student.name' => 'required|string|max:255',
        'student.dni' => 'required|string|max:20',
        'student.lastname' => 'nullable|string|max:255',
        'student.phone' => 'nullable|string|max:50',
        'student.address' => 'nullable|string|max:255',
    ];

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->student = Student::find($studentId);
    }

    public function save()
    {
        $this->validate();
        $this->student->save();
        $this->emitUp('studentSaved');
    }

    public function render()
    {
        return view('livewire.student-form');
    }
}
