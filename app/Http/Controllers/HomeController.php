<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

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

        // return view('home');
        if ($role->name_abbreviation == 'Admin') {

            return view('welcomes.admin_welcome');
        } elseif ($role->name_abbreviation == 'Manager') {
            
            return view('welcomes.manager_welcome');
        } 
            else {

            return view('welcomes.employee_welcome');
        }
    }
}
