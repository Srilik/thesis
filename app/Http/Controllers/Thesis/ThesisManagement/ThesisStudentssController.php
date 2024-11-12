<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;

use App\Models\Thesis\ThesisStudents;
use Illuminate\Http\Request;

class ThesisStudentssController extends Controller
{
    /**
     * Store a newly created thesis student in storage.
     */
    public function storeThesisStudent(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'thesis_id' => 'required|exists:thesises,id',
            'student_id' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'remark' => 'nullable|string',
        ]);
        if ($id) {
            // Update the existing thesisStudent
            $thesisStudent = ThesisStudents::findOrFail($id);
            $thesisStudent->update($validatedData);
            return redirect()->back()->with('success', 'ThesisStudent updated successfully.');
        } else {
            // Create a new thesisStudent
            ThesisStudents::create($validatedData);
            return redirect()->back()->with('success', 'ThesisStudent created successfully.');
        }
    }

    /**
     * Show the form for editing the specified thesis student.
     */
    public function editThesisStudent($id)
    {
        $thesisStudents = ThesisStudents::with('thesis_id')->findOrFail($id);
        $thesises = $thesisStudents->thesises;

        return response()->json([
            'thesisStudents' => $thesisStudents,
            'thesises' => $thesises,
        ]);
    }

    /**
     * Remove the specified thesis student from storage.
     */
    public function deleteThesisStudent($id)
    {
        $thesisStudents = ThesisStudents::findOrFail($id);
        $thesisStudents->delete();
        return redirect()->back()->with('success', 'ThesisStudent delete successfully.');
    }
}
