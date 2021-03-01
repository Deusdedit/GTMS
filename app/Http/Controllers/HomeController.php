<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Activity;

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
        $roleId = auth()->user()->role_id;
        $role = Role::find($roleId);

        $userId = auth()->user()->id;
        

        // return view('home');
        if ($role->name_abbreviation == 'Admin') {

           

            return view('welcomes.admin_welcome');

        } elseif ($role->name_abbreviation == 'MA') {
            
           
            return view('welcomes.manager_welcome');
        } 
        else {

            $fintask = Activity::where('user_id',$userId)->where('status','Finished')->count();
            $ongotask = Activity::where('user_id',$userId)->where('status','On going')->count();
            return view('welcomes.employee_welcome',compact('fintask','ongotask'));
        }
    }
}
