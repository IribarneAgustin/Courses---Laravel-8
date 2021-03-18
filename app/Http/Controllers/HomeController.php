<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->isAdmin == 0) {
            $courses = Course::all();
            return view('index')->with("courses",$courses);
        } else {
            return redirect('/courses');
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    /* Metodo para enviar emails */

    public function contact(Request $request)
    {
        $correo = new ContactMailable($request->all());
        Mail::to("agusiri96@yahoo.com")->send($correo);
        return redirect('/')->with('message', 'Mensaje enviado');
    }
}
