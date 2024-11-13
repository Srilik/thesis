<?php

namespace App\Http\Controllers\Thesis\ThesisManagement;
use App\Http\Controllers\Controller;
use App\Models\Thesis\ThesisCommittees;
use App\Models\Thesis\Thesises;
use App\Models\Thesis\ThesisStudents;
use Inertia\Inertia;

class ManagementController extends Controller
{
    public function index()
    {

        // Fetch thesisCommittee with thesis.
        $thesisCommittees = ThesisCommittees::with(['thesises'])
            ->select(
                'id',
                'thesis_id',
                'lecturer_id',
                'role',
                'title',
                'created_at'
            )
            ->orderBy('created_at', 'desc')
            ->when(
                request()->input('keyword'),
                fn($query) =>
                $query->where('name', 'like', '%' . request()->input('keyword') . '%')
            )
            ->when(
                request()->input('thesis_id'),
                fn($query) =>
                $query->where('thesis_id', request()->input('thesis_id'))
            )
            ->paginate(5, ['*'], 'page');  // Specify 'page' for thesisCommittees

        // Fetch thesisStudent with thesis.
        $thesisStudents = ThesisStudents::with(['thesises'])
            ->select(
                'thesis_id',
                'student_id',
                'phone',
                'email',
                'remark',
            )
            ->orderBy('created_at', 'desc')
            ->when(
                request()->input('keyword'),
                fn($query) =>
                $query->where('name', 'like', '%' . request()->input('keyword') . '%')
            )
            ->when(
                request()->input('thesis_id'),
                fn($query) =>
                $query->where('thesis_id', request()->input('thesis_id'))
            )
            ->paginate(5, ['*'], 'pageThesis');  // Specify 'page' for thesisCommittees


        //Brand and Category query
        $thesises = Thesises::query()
            ->withCount('thesisCommittees', 'thesisStudents')
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'ThesisPage');  // Specify 'brandPage' for brands

        return Inertia::render('Thesises/Management/Index', [
            'thesisCommittees' => $thesisCommittees,
            'thesisStudents' => $thesisStudents,
            'thesises' => $thesises,
            'filters' => request()->all('keyword', 'thesis_id'),
        ]);
    }
}
