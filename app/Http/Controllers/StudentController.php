<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $suscriptions = DB::table('coursesXusers')->get();
        $students = array();

        foreach ($suscriptions as $s) {
            $student['user'] = User::find($s->userId);

            if ($student && !in_array($student, $students)) {

                $student['courses'] = $this->getCoursesByUserId($s->userId);

                array_push($students, $student);
            }
        }

        return view("student.index", ['students' => $students]);
    }

    public function addStudent(Request $r)
    {
        $userId =  Auth::user()->id;
        $courseId = $r->get('courseId');

        $course = DB::table('coursesXusers')->get()->where("userId", $userId)->where("courseId", $courseId)->first();

        if (!$course) {
            DB::table('coursesXusers')->insert(
                array(
                    'userId'     =>   "$userId",
                    'courseId'   =>   "$courseId"
                )
            );
        }

        return redirect("/myCourses");
    }
    private function getCoursesByUserId($userId)
    {

        $suscriptions = DB::table('coursesXusers')->get();
        $courses = array();

        foreach ($suscriptions as $s) {
            if ($s->userId == $userId) {
                array_push($courses, Course::find($s->courseId));
            }
        }

        return $courses;
    }

    public function myCourses()
    {
        $user = Auth::user();
        $courses = $this->getCoursesByUserId($user->id);

        return view("course.show")->with("courses", $courses)->with("user", $user);
    }
}
