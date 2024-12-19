<?php

namespace App\Http\Controllers;

use App\Http\HelperClass;
use App\Http\Resources\StudentResource;
use App\Models\Schedule\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function profile($id)
    {
        $profile = function () use ($id) {

            // check old student photo without id prefix

            $isNumeric = is_numeric($id);
            if ($isNumeric) {
                // old student
                if (Storage::disk('sftp')->get('old_student_photos/' . $id . '.jpg')) {
                    $image = Storage::disk('sftp')->get('old_student_photos/' . $id . '.jpg');
                    return HelperClass::imageStream($image);
                } else { //
                    return HelperClass::imageStream(public_path('images/No-Image-Placeholder.png'));
                }
            }


            $student = Student::select('Photo')->where('ID', $id)->first();
            try {
                //            Cache Data from database
                if ($id && $student->Photo) {
                    return HelperClass::imageStream($student->Photo);
                } elseif (Storage::disk('sftp')->get('old_student_photos/' . substr($id, 1) . '.jpg')) {
                    $image = Storage::disk('sftp')->get('old_student_photos/' . substr($id, 1) . '.jpg');
                    return HelperClass::imageStream($image);
                } else { //
                    return HelperClass::imageStream(public_path('images/No-Image-Placeholder.png'));
                }
            } catch (\Exception $e) {
                return HelperClass::imageStream(public_path('images/No-Image-Placeholder_red.png'));
            }
        };

        return Response::make($profile())->header('Content-Type', 'image/webp');
    }

    public function masterProfile($id)
    {
        $profile = function () use ($id) {
            $student = \App\Models\Master\Student::select('photo')->where('GSuperID', $id)->first();
            try {
                // Cache Data from database
                if ($id && $student->photo) {
                    return HelperClass::imageStream($student->photo);
                } else { //
                    return HelperClass::imageStream(public_path('images/No-Image-Placeholder.png'));
                }
            } catch (\Exception $e) {
                return HelperClass::imageStream(public_path('images/No-Image-Placeholder_red.png'));
            }
        };
        return Response::make($profile())->header('Content-Type', 'image/webp');
    }
}
