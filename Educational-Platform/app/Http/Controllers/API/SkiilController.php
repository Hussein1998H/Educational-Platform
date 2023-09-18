<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkiilController extends Controller
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

            'title'=>'nullable',
            'description'=>'nullable',


        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

        $skill=Skill::create([
            'user_id'=>\auth()->id(),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
        ]);

        return  $this->successResponse(true,'created done',$skill,null,200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skill=Skill::findOrFail($id);
        return  $this->successResponse(true,'created done',$skill,null,200);

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
        $skill=Skill::findOrFail($id);
        $skill->delete();
        return $this->deletedata(true,'deleted done',200);
    }
}
