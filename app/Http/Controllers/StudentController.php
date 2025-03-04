<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\College;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $colleges = College::all(); // Get all colleges for the dropdown
        $query = Student::query(); // Start with a base query
    
        if ($request->has('college_id') && $request->college_id != '') {
            $query->where('college_id', $request->college_id);
        }
    
        $students = $query->with('college')->get(); // Fetch filtered students
    
        return view('students.index', compact('students', 'colleges'));
    }    

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $colleges = College::all(); // ✅ Fetch colleges for dropdown
        return view('students.create', compact('colleges')); // ✅ Create student form
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|digits:8',
            'dob' => 'required|date',
            'college_id' => 'required|exists:colleges,id',
        ]);

        // ✅ Create student
        Student::create($request->all());

        // ✅ Redirect with success message
        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    /**
     * Show the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $colleges = College::all(); // ✅ Fetch colleges for dropdown
        return view('students.edit', compact('student', 'colleges'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:8',
            'dob' => 'required|date',
            'college_id' => 'required|exists:colleges,id',
        ]);
    
        $student->update($request->all());
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }
    

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
