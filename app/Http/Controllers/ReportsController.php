<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;

class ReportsController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Reports_Individual.index',compact( 'users'));
    }

    public function individual(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'dates' => 'required',
        ]);

        $user = $request['user_id'];
        $dates = $request['dates'];

        $activities = Activity::where('user_id', '=', $user)->get();
        $users = User::all();
        return view('Reports_Individual.displayIndividual',compact( 'activities'));
    }
}
