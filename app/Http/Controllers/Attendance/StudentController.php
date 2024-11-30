<?php
namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        $attendanceRecords = auth()->user()->attendances; // Assuming relationship is defined
        return view('student.dashboard', compact('attendanceRecords'));
    }
}
