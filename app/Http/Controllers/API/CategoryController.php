<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            'title'=>'required',
            'description'=>'required',


        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

        $category=Category::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
        ]);

        return $this->successResponse(true,'created done',$category,null,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=Category::findOrFail($id);
        return $this->successResponse(true,null,$category,null,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $vaidator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required',


        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }
        $category=Category::findOrFail($id);
        $category->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
        ]);

        return $this->successResponse(true,'updated done',$category,null,200);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::findOrFail($id);
        $category->delete();

        return $this->deletedata(true,'deleted done',200);
    }
}
