<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\EducationController;
use App\Http\Controllers\API\SessionController;
use App\Http\Controllers\API\SkiilController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login',[AuthController::class,'login']);


Route::group(
    [
        'middleware' => [ 'auth:sanctum' ]
    ], function() {

    Route::get('logout',[AuthController::class,'logout']);
    Route::apiResource('users', UserController::class);
    Route::post('user/addToCourse/{id}',[UserController::class,'AddToCourse']);
    Route::get('user/addToAllCourse/{id}',[UserController::class,'addToAllCourse']);
    Route::put('user/updateProfile/{id}',[UserController::class,'updateProfile']);

    Route::apiResource('users',UserController::class);
    Route::apiResource('courses',CourseController::class);
    Route::apiResource('Categories',CategoryController::class);
    Route::apiResource('lectures',SessionController::class);
    Route::post('storeLecture/{course}',[SessionController::class,'storeLecture']);
    Route::get('alllectures/course/{course}',[SessionController::class,'alllectures']);
    Route::get('alllectures/course/lectures/{course}',[SessionController::class,'viewLec']);
    Route::get('alllectures/course/lectures/{course}/record',[SessionController::class,'record']);
    Route::get('alllectures/markedone/{id}',[SessionController::class,'markedone']);
    Route::apiResource('skills',SkiilController::class);
    Route::apiResource('eductions',EducationController::class);

});


