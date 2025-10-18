<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentForm extends Component
{
    public $studentId;
    public $name;
    public $dni;
    public $phone;
    public $address;

    public function mount($studentId = null)
    {
        if ($studentId) {
            $student = Student::find($studentId);
            if ($student) {
                $this->studentId = $student->id;
                $this->name = $student->name;
                $this->dni = $student->dni;
                $this->phone = $student->phone;
                $this->address = $student->address;
            }
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'dni' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Student::updateOrCreate(['id' => $this->studentId], [
            'name' => $this->name,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->dispatch('studentSaved');
        $this->dispatch('closeStudentForm');
    }

    public function close()
    {
        $this->dispatch('closeStudentForm');
    }

    public function render()
    {
        return view('livewire.student-form');
    }
}
