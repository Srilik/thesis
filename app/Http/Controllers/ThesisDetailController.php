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
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
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

        return redirect()->route('thesisDetail.index');
    }

    public function show(ThesisDetail $thesisDetail)
    {
        //
    }

    public function edit(ThesisDetail $thesisDetail)
    {
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
    }

    public function update(Request $request, ThesisDetail $thesisDetail)
    {
        //
    }

    public function destroy(ThesisDetail $thesisDetail)
    {
        $thesisDetail->delete();
        return redirect()->back();
    }    

}
