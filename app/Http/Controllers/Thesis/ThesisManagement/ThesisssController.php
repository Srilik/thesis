<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;
use App\Models\Thesis\Thesises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\ExamAffair\Lecturer;
use App\Models\Student\Student;
class ThesisssController extends Controller
{
    /**
     * Store a newly created thesis in storage.
     */
    public function storeThesis(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|integer',
            'academic_year' => 'required|string',
            'major' => 'required|string',
            'year' => 'required|integer|min:1|max:5',
            'batch' => 'required|integer',
            'topic' => 'nullable|string',
            'topic_kh' => 'nullable|string',
            'objective' => 'nullable|string',
            'objective_kh' => 'nullable|string',
            'description' => 'nullable|string',
            'organization' => 'nullable|string',
            'organization_type' => 'nullable|string',
            'organization_address' => 'nullable|string',
            'organization_phone' => 'nullable|string',
            'organization_email' => 'nullable|email',
            'lecturer_id' => 'nullable|string',
        ]);
        // $validatedData['lecturer_id'] = Lecturer::where('name', $request->lecturer_id)->first()->lecturer_id;
        // $validatedData['student_id'] = Student::where('name_of_student', $request->group_id)->first()->student_id;
        // dd($validatedData);
        try {
            if ($id) {
                // Update existing thesis
                $thesis = Thesises::findOrFail($id);
                $thesis->update($validatedData);
                return redirect()->back()->with('success', 'Thesis updated successfully.');
            } else {
                // Create new thesis
                Thesises::create($validatedData);
                return redirect()->back()->with('success', 'Thesis created successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Error in storeThesis: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an issue saving the thesis. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified thesis.
     */
    public function editThesis($id)
    {
        return $thesis = Thesises::findOrFail($id);
    }

    /**
     * Remove the specified thesis from storage.
     */
    public function deleteThesis($id)
    {
        // Find the thesis by ID
        $thesis = Thesises::findOrFail($id);

        // Check if the thesis has associated products
        if ($thesis->products()->count() > 0) {
            // Throw a validation exception with a custom error message
            throw ValidationException::withMessages([
                'thesis' => 'Cannot delete thesis. Products are associated with this thesis.',
            ]);
        }

        // If no associated products, delete the thesis
        $thesis->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thesis deleted successfully.');
    }
}
