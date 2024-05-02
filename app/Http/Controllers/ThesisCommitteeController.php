<?php

namespace App\Http\Controllers;

use App\Models\ThesisCommittee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisCommitteeController extends Controller
{
    public function index()
    {
        $thesisCommittees = ThesisCommittee::query()
            ->orderBy('Academic_Year', 'desc')
            ->when(
                request()->input('academic_year'),
                fn ($query) =>
                $query->where('Academic_Year', request()->input('academic_year'))
            )
            ->when(
                request()->input('major'),
                fn ($query) =>
                $query->where('Major', request()->input('major'))
            )
            // ->when(
            //     request()->input('committee'),
            //     fn ($query) =>
            //     $query->where('Committee', request()->input('committee'))
            // )
            ->when(
                request()->input('department'),
                fn ($query) =>
                $query->where('Department', request()->input('department'))
            )
            ->when(
                request()->input('subject'),
                fn ($query) =>
                $query->where('Subject', request()->input('subject'))
            )->paginate(5);

        $academic_years = ThesisCommittee::query()
            ->selectRaw('Academic_Year')
            ->distinct()
            ->orderBy('Academic_Year', 'desc')
            ->pluck('Academic_Year');

        $majors = ThesisCommittee::query()
            ->selectRaw('Major')
            ->distinct()
            ->orderBy('Major', 'desc')
            ->pluck('Major');            

        // $committees = ThesisCommittee::query()
        //     ->selectRaw('Committee')
        //     ->distinct()
        //     ->orderBy('Committee', 'asc')
        //     ->pluck('Committee');

        $departments = ThesisCommittee::query()
            ->selectRaw('Department')
            ->distinct()
            ->orderBy('Department', 'asc')
            ->pluck('Department');
        
        $subjects = ThesisCommittee::query()
            ->selectRaw('Subject')
            ->distinct()
            ->orderBy('Subject', 'desc')
            ->pluck('Subject');

        return Inertia::render('ThesisCommittee/Index', [
            'thesisCommittees' => $thesisCommittees,
            'academic_options' => $academic_years,
            'major_options' => $majors,
            // 'committee_options' => $committees,
            'department_options' => $departments,
            'subject_options' => $subjects,
            'filters' => request()->all('academic_year', 'major', 'committee', 'department', 'subject'),
        ]);
    }


    public function create()
    {
        return Inertia::render('ThesisCommittee/Index');
    }

    public function store(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            "Academic_Year" => "required",
            "Major" => "required",
            "Committee" => "required",
            "Department" => "required",
            "Subject" => "required",
        ]);

        $data = [
            "Academic_Year" => $request->input('Academic_Year'),
            "Major" => $request->input('Major'),
            "Committee" => $request->input('Committee'),
            "Department" => $request->input('Department'),
            "Subject" => $request->input('Subject'),
        ];
        $thesisCommittee = ThesisCommittee::updateOrCreate(['id' => $id], $data);

        return redirect()->route('thesisCommittee.index');
    }

    public function edit(string $id)
    {
        return ThesisCommittee::findOrFail($id);
    }

    public function destroy(string $id)
    {
        $thesisCommittee = ThesisCommittee::findOrFail($id);
        $thesisCommittee->delete();
        return redirect()->back();
    }
}
