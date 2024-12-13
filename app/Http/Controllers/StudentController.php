<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('index', compact('students'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name_Of_The_Student' => 'required',
            'Roll_no' => 'required|unique:students',
            'Branch' => 'required',
            'Year_Of_Study' => 'required|integer',
            'Title_Of_Course' => 'required',
            'Organizing_Body' => 'required',
            'Duration' => 'required',
        ]);

        Student::create($request->all());
        return redirect()->route('index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        return view('show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'Name_Of_The_Student' => 'required',
            'Roll_no' => 'required|unique:students,Roll_no,' . $student->id,
            'Branch' => 'required',
            'Year_Of_Study' => 'required|integer',
            'Title_Of_Course' => 'required',
            'Organizing_Body' => 'required',
            'Duration' => 'required',
        ]);

        $student->update($request->all());
        return redirect()->route('index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('index')->with('success', 'Student deleted successfully.');
    }
}