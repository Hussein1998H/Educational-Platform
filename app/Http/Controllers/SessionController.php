<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Session;
use App\Models\User;
use App\Traits\UploadImageTrait;
use App\Traits\UploadVideoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    use UploadVideoTrait,UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



    }

    public  function record(string $id){

        $session=Session::findOrFail($id);
       $course=Course::where('id',$session->course_id)->first();

        $course_id=$course->id;
        $session_id=$session->id;

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->whereHas('courses', function ($query) use ($course_id) {
            $query->where('course_id', $course_id);
        })->get();

        $studentswithSession = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->whereHas('sessions', function ($query) use ($session_id) {
            $query->where('session_id', $session_id);
        })->get();
//
        return view('teacher.lectures.lecture-recourd',[
            'students'=>$students,
            'studentswithSession'=>$studentswithSession,
        ]);
    }

    public function viewLec($id){

        $lecture=Session::findOrFail($id);


        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('lectures.showLecture',[
                    'lecture'=>$lecture,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.lectures.showLecture',[
                    'lecture'=>$lecture,
                ]);

            }

            elseif ($role->name==='student'){
                return view('student.lectures.showLecture',[
                    'lecture'=>$lecture,
                ]);

            }
            else{
                return view('auth.login');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $course=Course::findOrFail($id);

        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('lectures.addLectures',[
                    'course'=>$course,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.lectures.addLectures',[
                    'course'=>$course,
                ]);

            }

            else{
                return view('auth.login');
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lecture=Session::findOrFail($id);

        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('lectures.updateLectures',[
                    'lecture'=>$lecture,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.lectures.updateLectures',[
                    'lecture'=>$lecture,
                ]);

            }
            else{
                return view('auth.login');
            }
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $vaidator=Validator::make($request->all(),[
            'title'=>'required',
            'content'=>'nullable',
            'video'=> 'nullable',

        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }
        $session=Session::findOrFail($id);

        $video=$request->video;
        if($video) {

            $path = $this->UploadVideo($request, 'videos', 'video');

            $session->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'video'=>$path,
            ]);

            return  redirect()->back()->with([
                'success'=>"تمت الاضافة بنجاح "
            ]);
        }

        $session->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        return  redirect()->back()->with([
            'success'=>"تمت الاضافة بنجاح "
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $session=Session::findOrFail($id);
        $session->delete();
        return redirect()->back();
    }

    public function storeLecture(Request $request,$course)
    {
//        course_id
        $vaidator=Validator::make($request->all(),[
            'title'=>'required',
            'content'=>'nullable',
            'video'=> 'nullable|max:1999',


        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

        $video=$request->video;
        if($video){
//            $video = $request->file('video');
//            $videoName = time(). '.'. $video->extension();
//         dd($videoName);
//            $video->move(public_path('videos'), $videoName);

            $path=$this->UploadVideo($request,'videos','video');
            $lecture=Session::create([
                'course_id'=>$course,
                'title'=>$request->input('title'),
                'content'=>$request->input('content'),
                'video'=>$path,

            ]);
            return  redirect()->route('courses.index')->with([
                'success'=>"تمت الاضافة بنجاح "
            ]);
        }
        $lecture=Session::create([
            'course_id'=>$course,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),

        ]);
        return  redirect()->route('courses.index')->with([
            'success'=>"تمت الاضافة بنجاح "
        ]);
    }

    public function alllectures( $id){

      $lectures= Session::whereIn('course_id',[$id])->get();

        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('lectures.index',[
                    'lectures'=>$lectures,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.lectures.index',[
                    'lectures'=>$lectures,
                ]);

            }

            elseif ($role->name==='student'){
                return view('student.lectures.index',[
                    'lectures'=>$lectures,
                ]);

            }
        }

    }

    public function markedone(string $id){

        $user=User::findOrFail(\auth()->id());

        $user->sessions()->syncWithoutDetaching($id);

        return redirect()->back()->with([
            'success'=>"تمت العملية  بنجاح "
        ]);
    }
}
