<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;
use App\Models\Thesis\ThesisCommittees;
use Illuminate\Http\Request;

class ThesisCommitteessController extends Controller
{

    /**
     * Store a newly created thesis committee in storage.
     */
    public function storeThesisCommittee(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'thesis_id' => 'required|exists:thesises,id',
            'lecturer_id' => 'required|string',
            'role' => 'required|string',
            'title' => 'nullable|string',
        ]);
        if ($id) {
            // Update the existing thesisCommittes
            $thesisCommittes = ThesisCommittees::findOrFail($id);
            $thesisCommittes->update($validatedData);
            return redirect()->back()->with('success', 'ThesisCommittee updated successfully.');
        } else {
            // Create a new thesisCommittes
            ThesisCommittees::create($validatedData);
            return redirect()->back()->with('success', 'ThesisCommittee created successfully.');
        }
    }

    /**
     * Show the form for editing the specified thesis committee.
     */
    public function editThesisCommittee($id)
    {
        $thesisCommittees = ThesisCommittees::with('thesis_id')->findOrFail($id);
        $thesises = $thesisCommittees->thesises;

        return response()->json([
            'thesisCommittees' => $thesisCommittees,
            'thesises' => $thesises,
        ]);
    }

    /**
     * Remove the specified thesis committee from storage.
     */
    public function deleteThesisCommittee($id)
    {
        $thesisCommittees = ThesisCommittees::findOrFail($id);
        $thesisCommittees->delete();
        return redirect()->back()->with('success', 'ThesisCommittee deleted successfully.');

    }
}
