<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $users=User::with('roles')->get();
      return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $user= User::create([
//            'username'=>'teacher',
//            'firstName'=>'teacher',
//            'lastName'=>'teacher',
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
//        $user->roles()->syncWithoutDetaching($roleID[1]);
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
        //
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
    public function destroy(string $id)
    {
        //
    }
}
