<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use App\Traits\UploadImageTrait;
use http\Exception\BadUrlException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->get();

        $courses=Course::all();

        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('student.index',[
                    'students'=>$students,
                    'courses'=>$courses,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.student-index',[
                    'students'=>$students,
                    'courses'=>$courses,
                ]);

            }
            else{
                return view('auth.login');
            }
        }

//        return view('student.index',[
//            'students'=>$students,
//            'courses'=>$courses,
//        ]);
         //  return $students;

    }


    public function profile(){
        $user=Auth::user();
        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('admin.profile',[
                   'user'=>$user,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.profile',[
                    'user'=>$user,
                ]);

            }
            elseif ($role->name==='student'){
                return view('student.profile',[
                    'user'=>$user,
                ]);

            }
            else{
                return view('auth.login');
            }
        }

    }
    public function editeProfile($id){
        $user=User::findOrFail($id);
        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('admin.update-profile',[
                    'user'=>$user,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.update-profile',[
                'user'=>$user,
                ]);

            }
            elseif ($role->name==='student'){
                return view('student.update-profile',[
                'user'=>$user,
                ]);

            }
            else{
                return view('auth.login');
            }
        }
    }
    public function indexTeacher()
    {

        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $courses=Course::all();
        return view('teacher.index',[
            'teachers'=>$teachers,
            'courses'=>$courses,
        ]);
        //  return $students;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('admin.addUser');

            }
            elseif ($role->name==='teacher'){
                return view('teacher.addStudent');

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
            'username'=>'required',
            'firstName'=>'required',
            'lastName'=>'required',
            'gender'=>'nullable',
            'avatar'=>'nullable',
            'address'=>'required',
            'about'=>'nullable',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'phone'=>'required|digits_between:8,20',


        ]);



        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

//        $image=$request->file('photo')->getClientOriginalName();
//        $imageName=$request->file('photo')->storeAs('posts',$image,'images');

        $image=$request->avatar;
        if ($image){
            $path=$this->UploadImage($request,'profile','avatar');
            $user=User::create([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'gender'=>$request->input('gender'),
                'avatar'=>$path,
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ]);

            $social=Social::create([

                'user_id'=>$user->id,
                'phone'=>$request->input('phone'),
            ]);
            $role= Role::where('name',$request->input('role'))->first();
            $user->roles()->syncWithoutDetaching($role->id);
            return  redirect()->back()->with([
                'success'=>"تمت الاضافة بنجاح "
            ]);
        }
        else{
            $user=User::create([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'gender'=>$request->input('gender'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ]);

            $social=Social::create([

                'user_id'=>$user->id,
                'phone'=>$request->input('phone'),
            ]);
            $role= Role::where('name',$request->input('role'))->first();
            $user->roles()->syncWithoutDetaching($role->id);
            return  redirect()->back()->with([
                'success'=>"تمت الاضافة بنجاح "
            ]);
        }

//        $user= User::create([
//            'username'=>'teacher',
//            'firstName'=>'teacher',
//            'lastName'=>'teacher',
        //gender
        //avatar
//            'address'=>'Syria',
//            'about'=>'teacher',
//            'email'=>'teacher@gmail.com',
//            'email_verified_at'=>now(),
//            'password'=>Hash::make('123456789'),
//        ]);
//        $roleID=[];
//        $role=Role::all();
//        foreach ($role as $r){
//            $roleID[]=$r->id;
//        }
//
//
//        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student=User::findOrFail($id);

        foreach (Auth::user()->roles as $role){
            if ($role->name ==='admin'){
                return view('student.updateStudent',[
                    'student'=>$student,
                ]);

            }
            elseif ($role->name==='teacher'){
                return view('teacher.updateStudent',[
                    'student'=>$student,
                ]);

            }
            else{
                return view('auth.login');
            }
        }

    }

    public function updateProfile(Request $request ,string $id){


        $vaidator=Validator::make($request->all(),[
            'username'=>'nullable',
            'firstName'=>'nullable',
            'lastName'=>'nullable',
            'avatar'=>'nullable',
            'address'=>'nullable',
            'about'=>'nullable',
            'email'=>'nullable|email',
            'password'=>'nullable|min:8',
            'phone'=>'nullable|digits_between:8,20',
            'Whatsapp'=>'nullable',
            'linkein'=>'nullable',
            'facebook'=>'nullable',
            'gitHub'=>'nullable',



        ]);



        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }

//        $image=$request->file('photo')->getClientOriginalName();
//        $imageName=$request->file('photo')->storeAs('posts',$image,'images');

        $image=$request->avatar;
        $password=$request->input('password');
        $user=User::findOrFail($id);
        $social=Social::where('user_id',$id)->first();

        if ($image){
            if ($user->image) {
                Storage::delete('public/images/' . basename($user->image));
            }
            $path=$this->UploadImage($request,'profile','avatar');
            if ($password){
            $user->update([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'about'=>$request->input('about'),
                'avatar'=>$path,
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($password),
            ]);

            $social->update([

                'user_id'=>$user->id,
                'phone'=>$request->input('phone'),
                'Whatsapp'=>$request->input('Whatsapp'),
                'linkein'=>$request->input('linkein'),
                'gitHub'=>$request->input('gitHub'),
                'facebook'=>$request->input('facebook'),
            ]);
            return  redirect()->route('user.profile')->with([
                'success'=>"تمت الاضافة بنجاح "
            ]);
        }
            else{
                $user->update([
                    'username'=>$request->input('username'),
                    'firstName'=>$request->input('firstName'),
                    'lastName'=>$request->input('lastName'),
                    'about'=>$request->input('about'),
                    'avatar'=>$path,
                    'address'=>$request->input('address'),
                    'email'=>$request->input('email'),
                ]);

                $social->update([

                    'user_id'=>$user->id,
                    'phone'=>$request->input('phone'),
                    'Whatsapp'=>$request->input('Whatsapp'),
                    'linkein'=>$request->input('linkein'),
                    'gitHub'=>$request->input('gitHub'),
                    'facebook'=>$request->input('facebook'),
                ]);
                return  redirect()->route('user.profile')->with([
                    'success'=>"تمت الاضافة بنجاح "
                ]);
            }
        }
        else{
            if ($password){
            $user->update([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'about'=>$request->input('about'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($password),
            ]);

            $social->update([

                'user_id'=>$user->id,
                'phone'=>$request->input('phone'),
                'Whatsapp'=>$request->input('Whatsapp'),
                'linkein'=>$request->input('linkein'),
                'gitHub'=>$request->input('gitHub'),
                'facebook'=>$request->input('facebook'),
            ]);

            return  redirect()->route('user.profile')->with([
                'success'=>"تمت الاضافة بنجاح "
            ]);
        }
            else{
                $user->update([
                    'username'=>$request->input('username'),
                    'firstName'=>$request->input('firstName'),
                    'lastName'=>$request->input('lastName'),
                    'about'=>$request->input('about'),
                    'address'=>$request->input('address'),
                    'email'=>$request->input('email'),

                ]);

                $social->update([

                    'user_id'=>$user->id,
                    'phone'=>$request->input('phone'),
                    'Whatsapp'=>$request->input('Whatsapp'),
                    'linkein'=>$request->input('linkein'),
                    'gitHub'=>$request->input('gitHub'),
                    'facebook'=>$request->input('facebook'),
                ]);

                return  redirect()->route('user.profile')->with([
                    'success'=>"تمت الاضافة بنجاح "
                ]);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vaidator=Validator::make($request->all(),[
            'username'=>'nullable',
            'firstName'=>'nullable',
            'lastName'=>'nullable',
            'gender'=>'nullable',
            'avatar'=>'nullable',
            'address'=>'nullable',
            'about'=>'nullable',
            'email'=>'nullable|email',
            'password'=>'nullable|min:8',
            'phone'=>'nullable|digits_between:8,20',


        ]);


        if ($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInputs($request->all());
        }
        $password=$request->input('password');
        $student=User::findOrFail($id);

        if ($password) {

            $student->update([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ]);

            return  redirect()->route('users.index')->with([
                'success'=>"تمت التعديل بنجاح "
            ]);
        }
        else{
            $student->update([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
            ]);

            return  redirect()->route('users.index')->with([
                'success'=>"تمت التعديل بنجاح "
            ]);
        }



//            $social=Social::update([
//
//                'user_id'=>$student->id,
//                'phone'=>$request->input('phone'),
//            ]);
//
//            $checkrole=$request->input('role');
//            if($checkrole)
//            {
//                $role= Role::where('name',$request->input('role'))->first();
//                $student->roles()->syncWithoutDetaching($role->id);
//            }








    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $student=User::findOrFail($id);
        $student->delete();
        return redirect()->back();
    }


    public function AddToCourse(Request $request, $id){
        $student=User::findOrFail($id);

        $courses=Course::where('title',$request->input('course'))->first();
        if ($courses){
            $student->courses()->syncWithoutDetaching([$courses->id]);
            return  redirect()->back()->with([
                'success'=>"تمت اضفافة  بنجاح "
            ]);
        }
        else{
            return  redirect()->back()->with([
                'failed'=>"تعذر  اضفافة   "
            ]);
        }

    }

    public function addToAllCourse($id){

        $student=User::findOrFail($id);

        $courses=Course::all()->pluck('id');
        $student->courses()->syncWithoutDetaching($courses);
        return  redirect()->back()->with([
            'success'=>"تمت اضفافة  بنجاح "
        ]);
    }
}
