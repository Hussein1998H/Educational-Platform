<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $permissions = $user->roles;
        foreach ($permissions as $per){
            if ($per->name==='admin'){
                return view('admin.dashbord');
            }
            elseif ($per->name==='teacher'){
                return view('teacher.dashbord') ;
            }
            elseif ($per->name==='student'){
                return view('student.dashbord') ;
            }
            else{
                return 'error';
            }
        }




    }
}
