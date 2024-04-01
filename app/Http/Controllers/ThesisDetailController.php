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
            // ->when($request->input('keyword'), fn ($query)
            // =>$query->where('Thesis_No', 'like', "%" . $request->input('keyword') . "%"))
            // ->paginate(5)
            // ->withQueryString();

            ->orderBy('Thesis_No')
            ->get();
            
        return Inertia::render("ThesisDetail/Index",[
            "thesisDetails"=>$thesisDetails,
            'filters' => $request->all('keyword'),
        ]);
  
    }

    public function create()
    {
        return Inertia::render('ThesisDetail/Create');
    }
    public function store(Request $request, $id=null)
    {
        $validatedData = $request->validate([
            "Thesis_No" => "required",
            "Student_ID" => "required",
            "Phone" => "required",
            "Defend" => "required",
            "Pass_State" => "required",
            "Issue_Tem_Certificate" => "required",
            "Other" => "required",
            "Hardwork" => "required",
            "Charateristic" => "required",
            "Remark" => "required",
            "Result" => "required",
        ]);
        if($id){
            $thesisDetails = ThesisDetail::findOrFail($id);
            $thesisDetails->update($validatedData);
        // if($request->input('id')){
        //     $thesisDetails = ThesisDetail::findOrFail($request->input("id"));
        //     $thesisDetails->update($validatedData);
        }else{
            $request->validate([
                "Thesis_No" => "required",
                "Student_ID" => "required",
                "Phone" => "required",
                "Defend" => "required",
                "Pass_State" => "required",
                "Issue_Tem_Certificate" => "required",
                "Other" => "required",
                "Hardwork" => "required",
                "Charateristic" => "required",
                "Remark" => "required",
                "Result" => "required",
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
