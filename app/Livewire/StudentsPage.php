<?php

namespace App\Livewire;

use Livewire\Component;

class StudentsPage extends Component
{
    public $showForm = false;
    public $selectedStudentId = null;

    protected $listeners = [
        'openStudentForm' => 'openForm',
        'closeStudentForm' => 'closeForm',
        'studentSaved' => '$refresh',
    ];

    public function openForm($id = null)
    {
        $this->selectedStudentId = $id;
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->selectedStudentId = null;
    }

    public function render()
    {
        return view('livewire.students-page');
    }
}
