<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentModal extends Component
{
    public $studentId;
    public $student;
    public $activeTab = 'detalle';
    public $tabs = [
        'detalle' => 'Detalle',
        'clases' => 'Clases',
        'pagos' => 'Pagos',
    ];

    protected $listeners = ['refreshStudentModal' => '$refresh'];

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->loadStudent();
    }

    public function loadStudent()
    {
        $this->student = Student::find($this->studentId);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function closeModal()
    {
        $this->emit('studentUpdated'); // refresca tabla padre
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $classes = $this->activeTab === 'clases' ? $this->student->classes ?? [] : [];
        $payments = $this->activeTab === 'pagos' ? $this->student->payments ?? [] : [];

        return view('livewire.student-modal', compact('classes', 'payments'));
    }
}
