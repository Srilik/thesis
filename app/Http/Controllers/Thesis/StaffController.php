<?php

namespace App\Http\Controllers;

use App\Http\HelperClass;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\StaffOnlineResource;
use App\Http\StaffAttendance;
use App\Http\Traits\Helper;
use App\Models\EmployeeAttendance;
use App\Models\PersonMain;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaffController extends Controller
{
    use Helper;

    public function dashboard(Request $request)
    {
        if ($request->wantsJson() && $request->has('attendance')) {
            EmployeeAttendance::where('staff_id', $this->staff()->staff_id)
                ->whereDate('a_date', '<', Carbon::now())
                ->orderByDesc('a_date')
                ->take(30)->get()
                ->each(function ($item, $key) {
                    // dump($item);

                    if ($item->start_time_s2 && $item->start_time && ($item->end_time == null) && ($item->end_time_s2 == null)) {
                        $item->update([
                            'end_time' => $this->staff()->time_out_s1,
                            'end_time_s2' => $this->staff()->time_out_s2,
                            'auto_checkout' => 1
                        ]);
                    }
                    if ($item->start_time && ($item->end_time == null)) {
                        $item->update([
                            'end_time' => $this->staff()->time_out_s1,
                            'auto_checkout' => 1
                        ]);
                    }
                    if ($item->start_time_s2 && ($item->end_time_s2 == null)) {
                        $item->update([
                            'end_time_s2' => $this->staff()->time_out_s2,
                            'auto_checkout' => 1
                        ]);
                    }
                });


            $attendance = EmployeeAttendance::where('staff_id', $this->staff()->staff_id)
                ->with('staff')
                ->whereDate('a_date', Carbon::now())
                ->first();
            if ($attendance == null) {
                $attendance = new EmployeeAttendance();
                $attendance->working_status = 'office';
            }
            return new AttendanceResource($attendance);
        }
        return Inertia::render('Staff/Dashboard');
    }


    public function profile($staffId)
    {
        $profile = function () use ($staffId) {
            $staff = PersonMain::select('Photo')->where('ShortName', $staffId)->first();
            try {
                if ($staffId && $staff->Photo) {
                    return HelperClass::imageStream($staff->Photo);
                } else { //
                    return HelperClass::imageStream(public_path('images/No-Image-Placeholder.png'));
                }
            } catch (\Exception $e) {
                return HelperClass::imageStream(public_path('images/No-Image-Placeholder_red.png'));
            }
        };
        return \Response::make($profile(), 200)->header('Content-Type', 'image/webp');
    }

    public function attendance()
    {
        $filterList = [];
        if (auth()->user()->hasAnyPermission('head office', 'Administration And Personnel Department')) {
            if (\request()->staff_id) {
                $staff_id = \request()->staff_id;
            } else {
                if ($this->staff()->check_attend) {
                    $staff_id = $this->staff()->staff_id;
                } else {
                    $staff = $this->staff()->department->staffs()->where(['check_attend' => true, 'active' => true])->first();
                    $staff_id = $staff ? $staff->staff_id : $this->staff()->staff_id;
                }
            }
            $filterList = [
                'staffs' => $this->staff()->department->staffs()->whereHas('personMain', fn ($q) => $q->where('Suspend', 'Working'))->where(['check_attend' => true, 'active' => true])->get()->map(fn ($item) => [
                    'id' => $item->staff_id,
                    'name' => $item->full_name,
                ]),
            ];
        } else {
            $staff_id = $this->staff()->staff_id;
        }
        $staff = Staff::with(['personMain', 'works'])
            ->whereHas('personMain', fn ($q) => $q->where('Suspend', 'Working'))
            ->when(
                $this->staff()->hasAnyPermission('head office'),
                fn ($q) => $q->whereHas('personMainMin.department', fn ($q) => $q->where('DepartmentName', $this->staff()->department->DepartmentName))
            )
            ->where('staff_id', $staff_id)->firstOrFail();
        $staff = new StaffOnlineResource($staff);
        $days = $this->allDaysInMonth(\request()->month, \request()->year);
        $staffAttendance = new StaffAttendance();
        $attendance = $staffAttendance->attendance($days, $staff_id);

        return Inertia::render('Staff/Attendance', [
            'staff' => $staff,
            'days' => $attendance->days,
            'filters' => \request()->all('month', 'year'),
            'filterList' => $filterList,
            'attendanceSummary' => $attendance->attendanceSummary
        ]);
    }

    private function staff()
    {
        return auth('staff')->user();
    }
}
