<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\ThesisAdvisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ThesisController extends Controller
{
    public function index(Request $request){
        $thesis = Thesis::query()
            ->orderBy('Thesis_No')
            ->when($request->input('keyword'), fn($query)
            =>$query->where('Thesis_No', 'like', "%" . $request->input('keyword') . "%"))
            ->get();

            return Inertia::render("Thesis/Index",[
                "thesis"=>$thesis,
                'filters' => $request->all
                (
                    'keyword'
                )
            ]);
    }
    public function create(){
        return Inertia::render('Thesis/Create');
    }
    public function edit($id){
        return Thesis::findOrFail($id);
    }
    public  function store(Request $request, $id = null){
        $validatedData= $request->validate([
            'Thesis_No' => 'required',
            'Thesis_Group' => 'nullable',
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
            'Teacher_id' => 'required',
            'Defend_Date' => 'nullable',
            'Book_Score' => 'nullable',
            'Defend_time' => 'nullable',
            'Submit_book' => 'nullable',
            'Building' => 'nullable',
            'Room' => 'nullable',
        ]);
        if($id){
            $thesis = Thesis::find($id);
            $thesis -> update($validatedData);
        }else{
            $request->validate([
                'Thesis_No' => 'required',
                'Thesis_Group' => 'nullable',
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
                'Teacher_id' => 'required',
                'Defend_Date' => 'nullable',
                'Book_Score' => 'nullable',
                'Defend_time' => 'nullable',
                'Submit_book' => 'nullable',
                'Building' => 'nullable',
                'Room' => 'nullable',
            ]);
            Thesis::create($validatedData);
        }
        return  redirect()->back();
    }
    public  function destroy($id) {
        Thesis::findOrFail($id)->delete();
        return redirect()->back();
    }
}
