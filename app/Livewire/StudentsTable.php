<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class StudentsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $showModal = false;
    public $selectedStudentId = null;

    protected $listeners = ['studentUpdated' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function openModal($id = null)
    {
        $this->selectedStudentId = $id;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $id]);
    }

    public function delete($id)
    {
        Student::find($id)?->delete();
        $this->dispatchBrowserEvent('notify', ['message' => 'Alumno eliminado correctamente']);
    }

    public function render()
    {
        $students = Student::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.students-table', compact('students'))
            ->layout('components.layouts.app');
    }
}

