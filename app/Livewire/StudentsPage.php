<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class StudentsPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedStudentId = null; // alumno seleccionado
    public $showPanel = false;        // controla apertura del panel lateral

    protected $listeners = ['studentSaved' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectStudent($id)
    {
        $this->selectedStudentId = $id;
        $this->showPanel = true;
    }

    public function closePanel()
    {
        $this->showPanel = false;
        $this->selectedStudentId = null;
    }

    public function render()
    {
        $students = Student::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('livewire.students-page', compact('students'));
    }
}
