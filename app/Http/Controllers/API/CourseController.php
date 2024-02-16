<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use HTTP_ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


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
        return $this->successResponse(true,'created done',$cousre,null,200);


    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course=Course::findOrFail($id);
        return $this->successResponse(true,null,$course,null,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $course=Course::findOrFail($id);
        $cat=Category::where('title',$request->Category)->first();
        $course->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'category_id'=>$cat->id,
            'start_date' =>$request->input('start_date'),
            'end_date' =>$request->input('end_date'),
        ]);
        return $this->successResponse(true,'updated done',$course,null,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
       return $this->deletedata(true,'deleted done',200);
    }
}
