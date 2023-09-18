<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    use HTTP_ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaidator=Validator::make($request->all(),[

            'university'=>'nullable',
            'description'=>'nullable',
            'degree'=>'nullable',
            'start_date'=>'nullable',
            'end_date'=>'nullable',


        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

       $education= Education::create([
            'user_id'=>\auth()->id(),
            'university'=>$request->input('university'),
            'description'=>$request->input('description'),
            'degree'=>$request->input('degree'),
            'start_date'=>$request->input('start_date'),
            'end_date'=>$request->input('end_date'),
        ]);

        return  $this->successResponse(true,'created done',$education,null,200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $education=Education::findOrFail($id);
        return  $this->successResponse(true,null,$education,null,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $education=Education::findOrFail($id);
        $education->delete();
        return  $this->deletedata(true,'deleted done',200);
    }
}
