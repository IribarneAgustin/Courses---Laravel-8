<?php

namespace App\Http\Controllers;
use App\Models\Course;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function show(Request $r){
        
        $course = Course::find($r->get('courseId'));
        return view("course.content")->with("course",$course);
    }
}
