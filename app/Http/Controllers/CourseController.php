<?php

namespace App\Http\Controllers;

use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $courses = Course::all();
        return view('course.index', ['courses' => $courses]);
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

        $course->file = 0;
        $course->name = $request->get('name');
        $course->price = $request->get('price');
        $course->link = $request->get('link');
        $course->description = $request->get('description');
        $course->duration = $request->get('duration');
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
