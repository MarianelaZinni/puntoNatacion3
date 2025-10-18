<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        // Si la solicitud es AJAX (fetch), devolvemos JSON
        if (request()->wantsJson()) {
            return response()->json($students);
        }

        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|numeric|unique:students',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Alumno creado correctamente',
            'student' => $student,
        ]);
    }

    public function show(Student $student)
    {
        return response()->json($student);
    }

    public function edit(Student $student)
    {
        return response()->json($student);
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'dni' => 'required|numeric|unique:students,dni,' . $student->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Alumno actualizado correctamente',
            'student' => $student,
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Alumno eliminado correctamente',
        ]);
    }
}
