<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;
use App\Models\Thesis\ThesisCommittees;
use Illuminate\Http\Request;

class ThesisCommitteessController extends Controller
{
    /**
     * Display a listing of the thesis committees.
     */
    public function index()
    {
        $committees = ThesisCommittees::with('thesis')->get();
        return response()->json($committees);
    }

    /**
     * Show the form for creating a new thesis committee.
     */
    public function create()
    {
        return view('thesis_committees.create');
    }

    /**
     * Store a newly created thesis committee in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'thesis_id' => 'required|exists:thesises,id',
            'lecturer_id' => 'required|string',
            'role' => 'required|string',
            'title' => 'nullable|string',
        ]);

        $committee = ThesisCommittees::create($validatedData);
        return response()->json($committee);
    }

    /**
     * Display the specified thesis committee.
     */
    public function show(ThesisCommittees $thesisCommittee)
    {
        return response()->json($thesisCommittee->load('thesis'));
    }

    /**
     * Show the form for editing the specified thesis committee.
     */
    public function edit(ThesisCommittees $thesisCommittee)
    {
        return view('thesis_committees.edit', compact('thesisCommittee'));
    }

    /**
     * Update the specified thesis committee in storage.
     */
    public function update(Request $request, ThesisCommittees $thesisCommittee)
    {
        $validatedData = $request->validate([
            'thesis_id' => 'required|exists:thesises,id',
            'lecturer_id' => 'required|string',
            'role' => 'required|string',
            'title' => 'nullable|string',
        ]);

        $thesisCommittee->update($validatedData);
        return response()->json($thesisCommittee);
    }

    /**
     * Remove the specified thesis committee from storage.
     */
    public function destroy(ThesisCommittees $thesisCommittee)
    {
        $thesisCommittee->delete();
        return response()->json(['message' => 'Thesis committee member deleted successfully.']);
    }
}
