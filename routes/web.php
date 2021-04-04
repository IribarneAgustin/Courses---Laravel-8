<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RepairController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;

Route::get('/activate', [CourseController::class, 'activate'])->middleware('admin');
Route::get('/inactiveCourses', [CourseController::class, 'inactiveCourses'])->middleware('admin');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/logout', [HomeController::class, 'logout']);
//Route::get('/addStudent', [StudentController::class, 'addStudent']);
Route::get('/myCourses', [StudentController::class, 'myCourses']);
Route::get('/showClass', [ClassController::class, 'show']);
Route::resource('courses', 'App\Http\Controllers\CourseController');
Route::resource('students', 'App\Http\Controllers\StudentController');

Route::get('/', function () {
    return view("auth.login");
});

Route::get('/paypal/pay',[PaymentController::class , 'payWithPayPal']);
Route::get('/paypal/status',[PaymentController::class , 'payPalStatus']);



Route::post('/repairs/changeStatus', [RepairController::class, 'changeStatus'])->name('changeStatus');
Route::get('/repairs/listInProcess', [RepairController::class, 'listInProcess'])->name('listInProcess');
Route::get('/repairs/listInTapestry', [RepairController::class, 'listInTapestry'])->name('listInTapestry');
Route::get('/repairs/listOnHold', [RepairController::class, 'listOnHold'])->name('listOnHold');
Route::resource('articles', 'App\Http\Controllers\ArticleController');
Route::resource('clients', 'App\Http\Controllers\ClientController');
Route::resource('repairs', 'App\Http\Controllers\RepairController');
Route::get('/galeria/muebles', [HomeController::class, 'furnitureGallery']);
Route::get('/galeria/sillas', [HomeController::class, 'chairsGallery']);
Route::get('/galeria/estanterías', [HomeController::class, 'shelvesGallery']);
Route::get('/galeria/racks', [HomeController::class, 'racksGallery']);
Route::get('/galeria/muebles metálicos', [HomeController::class, 'metalFurnitureGallery']);
Route::get('/galeria/seguridad', [HomeController::class, 'segurityGallery']);
Route::get('/galeria/accesorios', [HomeController::class, 'accesoriesGallery']);
Route::post('contact', [HomeController::class, 'contact']);

Route::get('storage-link', function () {

    if (file_exists(public_path('storage'))) {
        return "The public/storage link already exists.";
    }

    app('files')->link(storage_path('app/public'), public_path('storage'));

    return 'The links have been created.';
});
