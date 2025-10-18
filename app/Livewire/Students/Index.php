<?php

namespace App\Livewire\Students;

use Livewire\Component;
use App\Models\Student;

class Index extends Component
{
    public $showForm = false;
    public $name, $email;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
    ];

    public function openForm()
    {
        $this->resetValidation();
        $this->reset(['name', 'email']);
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function save()
    {
        $this->validate();
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->closeForm();
        $this->dispatch('student-created');
    }

    public function render()
    {
        return view('livewire.students.index', [
            'students' => Student::all(),
        ]);
    }
}
