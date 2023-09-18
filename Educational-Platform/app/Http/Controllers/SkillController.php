<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('admin.add-skill');

            }
            elseif ($role->name==='teacher'){
                return view('teacher.add-skill');

            }
            elseif ($role->name==='student'){
                return view('student.add-skill');

            }
            else{
                return view('auth.login');
            }
        }
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

        $category=Skill::create([
            'user_id'=>\auth()->id(),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
        ]);

        return  redirect()->route('user.profile')->with([
            'success'=>"تمت الاضافة بنجاح "
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
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
        return  redirect()->route('user.profile')->with([
            'success'=>"تمت الحذف بنجاح "
        ]);
    }
}
