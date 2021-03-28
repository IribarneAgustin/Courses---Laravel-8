<?php

namespace App\Http\Controllers;

use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::all();
        return view('course.index', ['courses' => $courses]);
    }
    public function inactiveCourses()
    {
        $courses = Course::all();
        return view('course.inactiveCourses', ['courses' => $courses]);
    }

    public function create()
    {
        return view('course.create');
    }
    public function store(Request $request)
    {
        $course = new Course();

        $request->validate(
            ['flyer' => 'required|image']
        );

        $img = $request->file('flyer')->store('public/images');

        //Con este método cambio el nombre de la ruta para guardarla en mi base de datos correctamente.
        $url = Storage::url($img);

        $course->file = 0; //Link del drive
        $course->name = $request->get('name');
        $course->price = $request->get('price');
        $course->link = $request->get('link'); //Link del meet
        $course->description = $request->get('description');
        $course->duration = $request->get('duration'); //Borrar
        $course->schedule = $request->get('schedule');
        $course->flyer = $url;
        $course->isActive = true;

        $course->save();

        return redirect("/courses");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $course = Course::find($id);

        return view("course.edit",['course' => $course]);

    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if ($request->file('flyer') != null) {
            $request->validate(
                ['flyer' => 'required|image']
            );

            $img = $request->file('flyer')->store('public/images');
            $url = Storage::url($img);
            $course->flyer = $url;
        }

        $course->file = $request->get('file'); //Link del drive
        $course->name = $request->get('name');
        $course->price = $request->get('price');
        $course->link = $request->get('link'); //Link del meet
        $course->description = $request->get('description'); //Borrar
        $course->schedule = $request->get('schedule');

        $course->save();

        return redirect("/courses");
    }

    public function activate(Request $r)
    {
        $course = Course::find($r->get('courseId'));
        $course->isActive = 1;
        $course->save();

        return redirect('/courses')->with('activate', 'ok');
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->isActive = 0;
        $course->save();

        return redirect('/courses')->with('delete', 'ok');
    }
}
