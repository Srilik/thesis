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
<<<<<<< HEAD
            // ->with(['status', 'room'])

            ->when($request->input('keyword'), fn ($query)
            => $query->where('Student_ID', 'like', '%' . $request->input('keyword') . '%'))

            // ->when($request->input('room_id'), fn ($query)
            // => $query->where('room_id', $request->input('room_id')))

            // ->when($request->input('status_id'), fn ($query)
            // => $query->where('status_id', $request->input('status_id')))

            ->paginate(20)
            ->withQueryString();

        // $rooms = Room::query()
        //     ->select('room_id', 'name')
        //     ->orderBy('name')
        //     ->get();
        // // staus
        // $statuses = Status::query()
        //     ->select('id', 'name')
        //     ->orderBy('name')
        //     ->get();
        // return $thesisDetails;
        return Inertia::render('ThesisDetail/Index', [
            // 'rooms' => $rooms,
            // 'statuses' => $statuses,
            'thesisDetails' => $thesisDetails,
            'filters' => $request->all(
                // 'room_id',
                // 'status_id',
                'keyword'
            )
        ]);
    }
    public function create()
    {
        // // rooms
        // $rooms = Room::query()
        //     ->select('room_id', 'name')
        //     ->orderBy('name')
        //     ->get();
        // // staus
        // $statuses = Status::query()
        //     ->select('id', 'name')
        //     ->orderBy('name')
        //     ->get();
        return Inertia::render('ThesisDetail/Create', [
            // 'rooms' => $rooms,
            // 'statuses' => $statuses
        ]);
=======
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
>>>>>>> main
    }
    public function store(Request $request, $id=null)
    {
        $validatedData = $request->validate([
<<<<<<< HEAD
            'id' => 'nullable',
            // 'name' => [
            //     'required',
            //     function ($attribute, $value, $fail) use ($request) {
            //         // true = validation fail
            //         $isThesisDetailNameExist = ThesisDetail::where('name', $value)
            //             ->where('room_id', $request->input('room_id'))
            //             ->exists();
            //         if ($isThesisDetailNameExist && !$request->input('id')) {
            //             $fail('This thesisDetail name already exists in this room');
            //         }
            //     }
            // ],

=======
>>>>>>> main
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
<<<<<<< HEAD


            // 'room_id' => 'required|exists:rooms,room_id',
            // 'status_id' => 'required|exists:status,id',
        ]);
        if ($request->input('id')) {
            $request->validate([
                // 'name' => 'unique:thesisDetails,name,' . $request->input('id') . ',id'
            ]);
            $thesisDetail = ThesisDetail::findOrFail($request->input('id'));
            $thesisDetail->update($validatedData);
        } else {
            ThesisDetail::create($validatedData);
        }
=======
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
>>>>>>> main

        return redirect()->route('thesisDetail.index');
    }

    public function show(ThesisDetail $thesisDetail)
    {
        //
    }

    public function edit($id)
    // ThesisDetail $thesisDetail 
    {
<<<<<<< HEAD
        // $rooms = Room::query()
        //     ->select('room_id', 'name')
        //     ->orderBy('name')
        //     ->get();
        // // staus
        // $statuses = Status::query()
        //     ->select('id', 'name')
        //     ->orderBy('name')
        //     ->get();

        return Inertia::render('ThesisDetail/Create', [
            // 'rooms' => $rooms,
            // 'statuses' => $statuses,
            'thesisDetail' => $thesisDetail
        ]);
=======
        return ThesisDetail::findOrFail($id);

        // return Inertia::render('ThesisDetail/Create', [
        //     'thesisDetail' =>$thesisDetail
        // ]);    
>>>>>>> main
    }

    public function update(Request $request, ThesisDetail $thesisDetail)
    {
        //
    }

    public function destroy(ThesisDetail $thesisDetail)
    {
        $thesisDetail->delete();
        return redirect()->back();
<<<<<<< HEAD
    }    
=======
    }
>>>>>>> main

}
