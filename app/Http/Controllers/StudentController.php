<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class StudentController extends Controller
{
    public function addStudent(Request $r)
    {
        $userId =  Auth::user()->id;
        $courseId = $r->get('courseId');

        DB::table('coursesXusers')->insert(
            array(
                'userId'     =>   "$userId",
                'courseId'   =>   "$courseId"
            )
        );
        return redirect("/myCourses");
    }

    public function myCourses()
    {
        $user = Auth::user();
        $suscriptions = DB::table('coursesXusers')->get();
        $courses = array();

        foreach ($suscriptions as $s) {
            if ($s->userId == $user->id) {
                array_push($courses, Course::find($s->courseId));
            }
        }

        return view("course.show")->with("courses", $courses)->with("user",$user);
    }

}
