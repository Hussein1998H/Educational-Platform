<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Session;
use App\Models\User;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    use  HTTP_ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        return response()->json([
            'status'=>true,
            'students'=>$students,
            'studentswithSession'=>$studentswithSession,
        ]);
    }

    public function viewLec($id){

        $lecture=Session::findOrFail($id);
        return $this->successResponse(true,null,$lecture,null,200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

            return $this->successResponse(true,'update done',$session,null,200);

        }

        $session->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        return $this->successResponse(true,'update done',$session,null,200);



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
            return $this->successResponse(true,'all lectures',$lecture,null,200);

        }
        $lecture=Session::create([
            'course_id'=>$course,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),

        ]);
        return $this->successResponse(true,'all lectures',$lecture,null,200);

    }

    public function alllectures( $id){

        $lectures= Session::whereIn('course_id',[$id])->get();
        return $this->successResponse(true,'all lectures',$lectures,null,200);

    }

    public function markedone(string $id){

        $user=User::findOrFail(\auth()->id());

        $user->sessions()->syncWithoutDetaching($id);

        return $this->successResponse(true,'marked done',null,null,200);
    }
}
