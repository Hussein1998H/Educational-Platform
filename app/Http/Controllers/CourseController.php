<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses=Course::with('category')->paginate(10);

        $myCourse = Course::with('category')->whereHas('users', function ($query) {
            $query->where('user_id', \auth()->id());
        })->get();


        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('course.index',[
                    'courses'=>$courses,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.allCourse',[
                    'courses'=>$myCourse,
                ]);

            }
            elseif ($role->name==='student'){
                return view('student.my-course',[
                    'courses'=>$myCourse,
                ]);

            }
            else{
                return view('auth.login');
            }
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys=Category::all();
        return view('course.addCourse',[
            'categorys'=>$categorys,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        'category_id',
//         'title',
//         'description',
//         'start_date',
//         'end_date',
        $vaidator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'start_date' =>'required',
            'end_date' =>'required',
        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }
        $cat=Category::where('title',$request->Category)->first();
        $cousre=Course::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'category_id'=>$cat->id,
            'start_date' =>$request->input('start_date'),
            'end_date' =>$request->input('end_date'),
        ]);
        return  redirect()->back()->with([
            'success'=>"تمت الاضافة بنجاح "
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categorys=Category::all();
        return view('course.updateCourse',[
            'course'=>$course,
            'categorys'=>$categorys,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $vaidator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'start_date' =>'required',
            'end_date' =>'required',
        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }
        $cat=Category::where('title',$request->Category)->first();
        $course->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'category_id'=>$cat->id,
            'start_date' =>$request->input('start_date'),
            'end_date' =>$request->input('end_date'),
        ]);
        return  redirect()->back()->with([
            'success'=>"تمت التعديل  بنجاح "
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back();
    }
}
