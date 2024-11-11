<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;

use App\Models\Thesis\ThesisStudents;
use Illuminate\Http\Request;

class ThesisStudentssController extends Controller
{
    /**
     * Display a listing of the thesis students.
     */
    public function index()
    {
        $students = ThesisStudents::with('thesis')->get();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new thesis student.
     */
    public function create()
    {
        return view('thesis_students.create');
    }

    /**
     * Store a newly created thesis student in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'thesis_id' => 'required|exists:thesises,id',
            'student_id' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'remark' => 'nullable|string',
        ]);

        $student = ThesisStudents::create($validatedData);
        return response()->json($student);
    }

    /**
     * Display the specified thesis student.
     */
    public function show(ThesisStudents $thesisStudent)
    {
        return response()->json($thesisStudent->load('thesis'));
    }

    /**
     * Show the form for editing the specified thesis student.
     */
    public function edit(ThesisStudents $thesisStudent)
    {
        return view('thesis_students.edit', compact('thesisStudent'));
    }

    /**
     * Update the specified thesis student in storage.
     */
    public function update(Request $request, ThesisStudents $thesisStudent)
    {
        $validatedData = $request->validate([
            'thesis_id' => 'required|exists:thesises,id',
            'student_id' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'remark' => 'nullable|string',
        ]);

        $thesisStudent->update($validatedData);
        return response()->json($thesisStudent);
    }

    /**
     * Remove the specified thesis student from storage.
     */
    public function destroy(ThesisStudents $thesisStudent)
    {
        $thesisStudent->delete();
        return response()->json(['message' => 'Thesis student deleted successfully.']);
    }
}
