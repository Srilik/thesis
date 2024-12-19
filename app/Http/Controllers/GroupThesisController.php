<?php

namespace App\Http\Controllers;

use App\Models\GroupThesis;
use Illuminate\Http\Request;

class GroupThesisController extends Controller
{
    public function index()
    {
        return response()->json(GroupThesis::all());
    }

    public function store(Request $request)
    {
        $request->validate(['group_name' => 'required|string|max:255']);

        GroupThesis::create(['group_name' => $request->input('group_name')]);

        return response()->json(['message' => 'Group created successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['group_name' => 'required|string|max:255']);

        $group = GroupThesis::findOrFail($id);
        $group->update(['group_name' => $request->input('group_name')]);

        return response()->json(['message' => 'Group updated successfully.']);
    }

    public function destroy($id)
    {
        $group = GroupThesis::findOrFail($id);
        $group->delete();

        return response()->json(['message' => 'Group deleted successfully.']);
    }
}
