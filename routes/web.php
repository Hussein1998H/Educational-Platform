<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::get('/', function () {
        return view('auth.login');
    });




    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('users',UserController::class);
    Route::post('student/{id}/addToCourse',[UserController::class,'AddToCourse'])->name('users.AddToCourse');
    Route::get('students/addToAllCourse/{id}',[UserController::class,'addToAllCourse'])->name('users.addToAllCourse');
    Route::get('teacher',[UserController::class,'indexTeacher'])->name('teacher.indexTeacher');
    Route::get('user/profile',[UserController::class,'profile'])->name('user.profile');
    Route::put('user/updateProfile/{id}',[UserController::class,'updateProfile'])->name('user.updateProfile');
    Route::get('user/profile/edite/{id}',[UserController::class,'editeProfile'])->name('user.profile.edite');
    Route::resource('courses',CourseController::class);
    Route::resource('Categories',CategoryController::class);
    Route::resource('lectures',SessionController::class);
    Route::post('storeLecture/{course}',[SessionController::class,'storeLecture'])->name('lectures.storeLecture');
    Route::get('alllectures/course/{course}',[SessionController::class,'alllectures'])->name('lectures.alllectures');
    Route::get('alllectures/course/lectures/{course}',[SessionController::class,'viewLec'])->name('lectures.viewLec');
    Route::get('alllectures/course/lectures/{course}/record',[SessionController::class,'record'])->name('lectures.record');
    Route::get('alllectures/markedone/{id}',[SessionController::class,'markedone'])->name('lectures.markedone');
    Route::resource('skills',SkillController::class);
    Route::resource('eductions',EducationController::class);
    Route::get('/{page}', function ($id){
            return view('admin.'.$id);
    });




});
Route::get('test/test',function (){

    $user=\App\Models\User::with(['roles'=>function($q){
        $q->select('name');
    }])->whereHas('roles', function($query){
        $query->whereIn('name',['admin','student']);
    })->get();
    return $user;
});
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
