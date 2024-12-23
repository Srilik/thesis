<?php

namespace App\Http\Controllers;

use App\Models\ThesisDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisDetailController extends Controller
{
    public function index(Request $request)
    {
        $thesisDetails = ThesisDetail::query()
            ->orderBy('Thesis_No')
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Thesis_No', 'like', "%" . $request->input('keyword') . "%"))
            // ->get();
            
            ->paginate(5);
            // ->withQueryString();            
        return Inertia::render("ThesisDetail/Index",[
            "thesisDetails"=>$thesisDetails,
            'filters' => $request->all('keyword'),
        ]);
  
    }

    public function create()
    {
        return Inertia::render('ThesisDetail/Index');
    }
    public function store(Request $request, $id=null)
    {
        $validatedData = $request->validate([
            "Thesis_No" => "nullable",
            "Student_ID" => "nullable",
            "Phone" => "nullable",
            "Defend" => "nullable",
            "Pass_State" => "nullable",
            "Issue_Tem_Certificate" => "nullable",
            "Other" => "nullable",
            "Hardwork" => "nullable",
            "Charateristic" => "nullable",
            "Remark" => "nullable",
            "Result" => "nullable",
        ]);
        if($id){
            $thesisDetails = ThesisDetail::findOrFail($id);
            $thesisDetails->update($validatedData);
        // if($request->input('id')){
        //     $thesisDetails = ThesisDetail::findOrFail($request->input("id"));
        //     $thesisDetails->update($validatedData);
        }else{
            $request->validate([
                "Thesis_No" => "nullable",
                "Student_ID" => "nullable",
                "Phone" => "nullable",
                "Defend" => "nullable",
                "Pass_State" => "nullable",
                "Issue_Tem_Certificate" => "nullable",
                "Other" => "nullable",
                "Hardwork" => "nullable",
                "Charateristic" => "nullable",
                "Remark" => "nullable",
                "Result" => "nullable",
            ]);
            ThesisDetail::create($validatedData);
        }
        return  redirect()->back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    // ThesisDetail $thesisDetail 
    {
        return ThesisDetail::findOrFail($id);

        // return Inertia::render('ThesisDetail/Create', [
        //     'thesisDetail' =>$thesisDetail
        // ]);    
    }

    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy($id)
    {
        $thesisDetail = ThesisDetail::findOrFail($id);
        $thesisDetail->delete();
        return redirect()->back();
    }

}
