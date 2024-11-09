<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\ThesisAdvisor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisAdvisorController extends Controller
{

    public function index()
    {
        // $thesisAdvisors = ThesisAdvisor::query()
        //     ->orderBy('Academic_Year', 'desc')
        //     ->when(request()->input('academic_year'), fn ($query) =>
        //     $query->where('Academic_Year', request()->input('academic_year')))
        //     ->when(request()->input('advisor'), fn ($query) =>
        //     $query->where('Advisor', request()->input('advisor')))
        //     ->when(request()->input('department'), fn ($query) =>
        //     $query->where('Department', request()->input('department')))
        //     ->paginate(2);
        $thesisAdvisors = ThesisAdvisor::query()
<<<<<<< HEAD
            ->orderBy('Advisor')
            ->when($request->input('keyword'), fn ($query)
            =>$query->where('Advisor', 'like', "%" . $request->input('keyword') . "%"))
            ->get();
            // ->paginate(5)
            // ->withQueryString();
=======
            ->orderBy('Academic_Year', 'desc')
            ->when(
                request()->input('academic_year'),
                fn ($query) =>
                $query->where('Academic_Year', request()->input('academic_year'))
            )
            ->when(
                request()->input('advisor'),
                fn ($query) =>
                $query->where('Advisor', request()->input('advisor'))
            )
            ->when(
                request()->input('department'),
                fn ($query) =>
                $query->where('Department', request()->input('department'))
            )->paginate(10);




        $academic_years = ThesisAdvisor::query()
            ->selectRaw('Academic_Year')
            ->distinct()
            ->orderBy('Academic_Year', 'desc')
            ->pluck('Academic_Year');

        $advisors = ThesisAdvisor::query()
            ->selectRaw('Advisor')
            ->distinct()
            ->orderBy('Advisor', 'asc')
            ->pluck('Advisor');

        $departments = ThesisAdvisor::query()
            ->selectRaw('Department')
            ->distinct()
            ->orderBy('Department', 'asc')
            ->pluck('Department');

        // return $thesisAdvisors;
>>>>>>> main

        return Inertia::render('ThesisAdvisor/Index', [
            'thesisAdvisors' => $thesisAdvisors,
            'academic_options' => $academic_years,
            'advisor_options' => $advisors,
            'department_options' => $departments,
            'filters' => request()->all('academic_year', 'advisor', 'department'),
        ]);
    }


    public function create()
<<<<<<< HEAD
    { 
        return Inertia::render('ThesisAdvisor/Create');
    }

    public function store(Request $request, $id=null)
=======
    {
        return Inertia::render('ThesisAdvisor/Index');
    }

    public function store(Request $request, $id = null)
>>>>>>> main
    {
        // try {
        // Validate the incoming request data
        $validatedData = $request->validate([
            "Academic_Year" => "required",
            "Advisor" => "required",
            "College" =>  "required",
            "Department" => "required",
        ]);

<<<<<<< HEAD

        // // // Create a new Thesis instance
        // $thesisAdvisor = new ThesisAdvisor();

        // // // Assign values from the validated data to the Thesis model instance
        // $thesisAdvisor->Academic_Year = $validatedData['Academic_Year'];
        // $thesisAdvisor->Advisor = $validatedData['Advisor'];
        // $thesisAdvisor->College = $validatedData['College'];
        // $thesisAdvisor->Department = $validatedData['Department'];

        // $thesisAdvisor->save();

        // if($request->input('id')){
        if ($id){
            // $thesisAdvisors = ThesisAdvisor::findOrFail($request->input("id"));
            $thesisAdvisors = ThesisAdvisor::findOrFail($id);
            $thesisAdvisors->update($validatedData);
        }else {   
            $request->validate([
                "Academic_Year" => "required",
                "Advisor" =>  "required",
                "College" =>  "required",
                "Department" => "required",
            ]);   
            ThesisAdvisor::create($validatedData);
        }
        // return redirect()->route('thesisAdvisor.index');
        return redirect()->back();
=======
        $data = [
            "Academic_Year" => $request->input('Academic_Year'),
            "Advisor" => $request->input('Advisor'),
            "College" => $request->input('College'),
            "Department" => $request->input('Department'),
        ];
        // If $id is provided, update the existing record; otherwise, create a new record
        $thesisAdvisor = ThesisAdvisor::updateOrCreate(['id' => $id], $data);

        return redirect()->route('thesisAdvisor.index');
        // } catch (QueryException $e) {
        //     if ($e->errorInfo[1] === 1062) { // 1062 is the MySQL error code for a duplicate entry
        //         return redirect()->back()->withErrors(['Advisor' => 'The Advisor already exists.'])->withInput();
        //     }
        //     throw $e;
        // }
>>>>>>> main
    }

    public function edit(string $id)
    {
        return ThesisAdvisor::findOrFail($id);
    }

<<<<<<< HEAD
    public function edit($id)
    {
        return ThesisAdvisor::findOrFail($id);
        // return Inertia::render('ThesisAdvisor/Index', [
        //     'thesisAdvisor' =>$thesisAdvisor
        // ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
=======
    public function destroy(string $id)
>>>>>>> main
    {
        $thesisAdvisor = ThesisAdvisor::findOrFail($id);
        $thesisAdvisor->delete();
        return redirect()->back();
    }
}
