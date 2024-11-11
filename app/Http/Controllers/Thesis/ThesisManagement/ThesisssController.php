<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;
use App\Models\Thesis\Thesises;
use Illuminate\Http\Request;

class ThesisssController extends Controller
{
    /**
     * Display a listing of the theses.
     */
    public function index()
    {
        $theses = Thesises::all();
        return response()->json($theses);
    }

    /**
     * Show the form for creating a new thesis.
     */
    public function create()
    {
        return view('theses.create');
    }

    /**
     * Store a newly created thesis in storage.
     */
    public function store(Request $request)
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

        $thesis = Thesises::create($validatedData);
        return response()->json($thesis);
    }

    /**
     * Display the specified thesis.
     */
    public function show(Thesises $thesis)
    {
        return response()->json($thesis);
    }

    /**
     * Show the form for editing the specified thesis.
     */
    public function edit(Thesises $thesis)
    {
        return view('theses.edit', compact('thesis'));
    }

    /**
     * Update the specified thesis in storage.
     */
    public function update(Request $request, Thesises $thesis)
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

        $thesis->update($validatedData);
        return response()->json($thesis);
    }

    /**
     * Remove the specified thesis from storage.
     */
    public function destroy(Thesises $thesis)
    {
        $thesis->delete();
        return response()->json(['message' => 'Thesis deleted successfully.']);
    }
}
