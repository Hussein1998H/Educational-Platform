<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categorys= Category::paginate(10);
       return view('category.index',[
           'categorys'=>$categorys,
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('category.addCategory');
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

        return  redirect()->back()->with([
            'success'=>"تمت الاضافة بنجاح "
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::findOrFail($id);

        return view('category.updateCategory',[
            'category'=>$category,
        ]);
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

        return  redirect('/Categories')->with([
            'success'=>"تمت التعديل بنجاح "
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::findOrFail($id);
        $category->delete();

        return redirect()->back();
    }
}
