<?php
namespace App\Http\Controllers\Attendance;
use App\Http\Controllers\Controller;
use App\Models\Attendance\Attendance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $attendances = Attendance::all();
        return view('admin.dashboard', compact('attendances'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        Attendance::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Attendance record added.');
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Attendance record updated.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Attendance record deleted.');
    }
}
