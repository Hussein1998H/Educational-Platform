<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
            $token = $user->createToken('token-name')->plainTextToken;
            return  $this->successResponse(true,'Register done',$token,200);
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

            $token = $user->createToken('token-name')->plainTextToken;
            return  $this->successResponse(true,'Register done',$token,200);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::findOrFail($id);
        return $this->successResponse(true,null,$user,null,200);
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

            $token = $student->createToken('token-name')->plainTextToken;

            return  $this->successResponse(true,'update done',$student,$token,200);
        }
        else{
            $student->update([
                'username'=>$request->input('username'),
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
            ]);
            $token = $student->createToken('token-name')->plainTextToken;

            return  $this->successResponse(true,'update done',$student,$token,200);
        }


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $student=User::findOrFail($id);
        $student->delete();
        return $this->deletedata(true,'delete done',200);
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
                $token = $user->createToken('token-name')->plainTextToken;
                return  $this->successResponse(true,'update Profile done',$token,200);
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
                $token = $user->createToken('token-name')->plainTextToken;
                return  $this->successResponse(true,'update Profile done',$token,200);
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

                $token = $user->createToken('token-name')->plainTextToken;
                return  $this->successResponse(true,'update Profile done',$token,200);
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

                $token = $user->createToken('token-name')->plainTextToken;
                return  $this->successResponse(true,'update Profile done',$token,200);
            }

        }
    }

    public function AddToCourse(Request $request, $id){
        $student=User::findOrFail($id);

        $courses=Course::where('title',$request->input('course'))->first();
        if ($courses){
            $student->courses()->syncWithoutDetaching([$courses->id]);
            return $this->successResponse(true,'تمت اضافة  بنجاح',null,null,200);

        }
        else{

            return $this->errorResponse(false,'تعذر  اضافة',null,400);
        }

    }

    public function addToAllCourse($id){

        $student=User::findOrFail($id);

        $courses=Course::all()->pluck('id');
        $student->courses()->syncWithoutDetaching($courses);

        return $this->successResponse(true,'تمت اضافة  بنجاح',null,null,200);
    }
}
