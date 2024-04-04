<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\ThesisAdvisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ThesisController extends Controller
{
    public function index(Request $request)
    {
        $thesises = Thesis::query()
            // ->with(['Teacher_id'])

            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Department', 'like', "%" . $request->input('keyword') . "%"))

            // ->when($request->input('Teacher_id'), fn($query)
            // =>$query->where('Teacher_id', $request->input('Teacher_id')))

            ->paginate(5)
            ->withQueryString();
            
            $thesisAdvisors = ThesisAdvisor::query()
            ->select("id", "Advisor")
            ->orderBy('Advisor')
            ->get(); 

        return Inertia::render('Thesis/Index', [
            'thesisAdvisors' => $thesisAdvisors,
            'thesises' => $thesises,
            'filters' => $request->all(
                'id',
                'keyword'
            ),
        ]);
    }
    
    public function create()
    {
        $thesisAdvisors = ThesisAdvisor::query()
            ->select("id", "Advisor")
            ->orderBy('Advisor')
            ->get(); 
        return Inertia::render('Thesis/Create', [
            'thesisAdvisors' => $thesisAdvisors,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Thesis_No' => 'required',
            'Thesis_Group' =>  'nullable',
            'Academic_Year' => 'nullable',
            'Department' => 'nullable',
            'Major' => 'nullable',
            'Year' => 'nullable',
            'Batch' => 'nullable',
            'Session' => 'nullable',
            'Organizaition' => 'nullable',
            'Organization_Type' => 'nullable',
            'Location' => 'nullable',
            'Organization_Phone' => 'nullable',
            'Title' => 'nullable',
            'Title_Khmer' => 'nullable',
            'Objective' => 'nullable',
            'Objective_Khmer' => 'nullable',
            'Summary' => 'nullable',
            'Submit_Date' => 'nullable',
            // 'Teacher_id' => 'nullable',
            "Teacher_id" => "required|exists:thesisAdvisors,id",
            'Defend_Date' => 'nullable',
            'Book_Score' => 'nullable',
            'Defend_time' => 'nullable',
            'Submit_book' => 'nullable',
            'Building' => 'nullable',
            'Room' => 'nullable',            
        ]);

        if($request->input('id')){
            $thesises = Thesis::findOrFail($request->input("id"));
            $thesises->update($validatedData);
        }else {      
            Thesis::create($validatedData);
        }
        return redirect()->route("thesis.index");
    }
    public function show(string $id)
    {
        //
    }
    public function edit(Thesis $thesis)
    {    
        $thesisAdvisors = ThesisAdvisor::query()
            ->select("id", "Advisor")
            ->orderBy('Advisor')
            ->get(); 
        return Inertia::render('Thesis/Create', [
            'thesisAdvisors' => $thesisAdvisors,
            'thesis' => $thesis, 
        ]);
    }
    public function update(Request $request, string $id)
    {  
    }
    public function destroy(Thesis $thesis, $id)
    {
        $thesis = Thesis::findOrFail($id);
        $thesis->delete();
        return redirect()->back();
    }
}
