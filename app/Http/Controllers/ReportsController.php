<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Section;
use App\Models\Department;
use App\Models\User;

class ReportsController extends Controller
{
    public function index() 
    {
        $users = User::all();
        $sections = Section::all();
        $departments = Department::all();
        return view('Reports_Individual.index',compact( 'users', 'sections', 'departments'));
    }

    public function individual(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'dates' => 'required',
        ]);
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');

        $today = Carbon::today();

        $user = $request['user_id'];
        $dates = $request['dates'];

        if($dates == 'today'){
            
        }

        $activities = Activity::where('user_id', '=', $user)->get();
        $users = User::all();
        return view('Reports_Individual.displayIndividual',compact( 'activities'));
    }
}
