<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
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
                return view('admin.add-eduction');

            }
            elseif ($role->name==='teacher'){
                return view('teacher.add-eduction');

            }
            elseif ($role->name==='student'){
                return view('student.add-eduction');

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

            'university'=>'nullable',
            'description'=>'nullable',
            'degree'=>'nullable',
            'start_date'=>'nullable',
            'end_date'=>'nullable',


        ]);

        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

        Education::create([
            'user_id'=>\auth()->id(),
            'university'=>$request->input('university'),
            'description'=>$request->input('description'),
            'degree'=>$request->input('degree'),
            'start_date'=>$request->input('start_date'),
            'end_date'=>$request->input('end_date'),
        ]);

        return  redirect()->route('user.profile')->with([
            'success'=>"تمت الاضافة بنجاح "
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
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
        return  redirect()->route('user.profile')->with([
            'success'=>"تمت الحذف  بنجاح "
        ]);
    }
}
