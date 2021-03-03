<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Section;
use App\Models\Department;
Use \Carbon\Carbon;  
use App\Models\User;
Use \Carbon\CarbonImmutable;
use PDF;
use DB;

class ReportsController extends Controller
{
    public function index() 
    {
        $users = User::all();
        $sections = Section::all();
        $departments = Department::all();
        return view('Reports_Individual.index',compact( 'users', 'sections', 'departments'));
    }

    public function individual(Request $request, $id, $days)
    {
        $user = User::find($id);
        $users = User::all();
        $sections = Section::all();
        $departments = Department::all();
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $activities = DB::table('activities')->whereDate('start_date', '=', $today)
                            ->where('user_id', '=', $user->id)->get(); 
                            
            $activitiesTo = DB::table('activities')->whereDate('start_assign_date', '=', $today)
            ->where('user_id', '=', $user->id)->get();  
            $pdf = PDF::loadView('Reports_Individual.today_individual', compact('activities', 'activitiesTo', 'user', 'today', 'users', 'sections', 'departments'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $activities = DB::table('activities')->whereDate('start_date', '=', $yesterday)
                            ->where('user_id', '=', $user->id)->get(); 
                            
            $activitiesTo = DB::table('activities')->whereDate('start_assign_date', '=', $yesterday)
                             ->where('user_id', '=', $user->id)->get();  
            $pdf = PDF::loadView('Reports_Individual.yesterday_individual', compact('activities', 'activitiesTo', 'user', 'yesterday', 'users', 'sections', 'departments', 'today'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            
            $activities = DB::table('activities')->whereDate('start_date', '>=', $weekStartDate)
                            ->whereDate('start_date', '<=', $weekEndDate)
                            ->where('user_id', '=', $user->id)->get(); 
                            
            $activitiesTo = DB::table('activities')->whereDate('start_assign_date', '>=', $weekStartDate)
                            ->whereDate('start_assign_date', '<=', $weekEndDate)
                            ->where('user_id', '=', $user->id)->get();  
            $pdf = PDF::loadView('Reports_Individual.week_individual', compact('activities', 'activitiesTo', 'user', 'weekStartDate', 'weekEndDate', 'users', 'sections', 'departments', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');

            $activities = DB::table('activities')->whereDate('start_date', '>=', $monthStartDate)
                            ->whereDate('start_date', '<=', $monthEndDate)
                            ->where('user_id', '=', $user->id)->get(); 
                            
            $activitiesTo = DB::table('activities')->whereDate('start_assign_date', '>=', $monthStartDate)
                            ->whereDate('start_assign_date', '<=', $monthEndDate)
                            ->where('user_id', '=', $user->id)->get();  
            $pdf = PDF::loadView('Reports_Individual.month_individual', compact('activities', 'activitiesTo', 'user', 'monthStartDate', 'monthEndDate', 'users', 'sections', 'departments', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d');

            $activities = DB::table('activities')->whereDate('start_date', '>=', $yearStartDate)
                            ->whereDate('start_date', '<=', $yearEndDate)
                            ->where('user_id', '=', $user->id)->get(); 
                            
            $activitiesTo = DB::table('activities')->whereDate('start_assign_date', '>=', $yearStartDate)
                            ->whereDate('start_assign_date', '<=', $yearEndDate)
                            ->where('user_id', '=', $user->id)->get();  
            $pdf = PDF::loadView('Reports_Individual.year_individual', compact('activities', 'activitiesTo', 'user', 'yearStartDate', 'yearEndDate', 'users', 'sections', 'departments', 'today'));

        }else{

        }
        
        $pdf->setPaper('A4', 'landscape');
        return ($pdf->stream('Activity Report.pdf'));
    }

    public function individuals(Request $request, $id, $days)
    {
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $user = User::find($id);
        $users = User::all();
        $sections = Section::all();
        $departments = Department::all();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'custom'){

            $activities = DB::table('activities')->whereDate('start_date', '>=', $startingDateformated)
                            ->whereDate('start_date', '<=', $endingDateformated)
                            ->where('user_id', '=', $user->id)->get(); 
                            
            $activitiesTo = DB::table('activities')->whereDate('start_assign_date', '>=', $startingDateformated)
                            ->whereDate('start_assign_date', '<=', $endingDateformated)
                            ->where('user_id', '=', $user->id)->get();  
            $pdf = PDF::loadView('Reports_Individual.custom_individual', compact('activities', 'activitiesTo', 'startingDateformated', 'endingDateformated', 'user', 'users', 'sections', 'departments', 'today'));
        }else{

        }
        
        $pdf->setPaper('A4', 'landscape');
        return ($pdf->stream('Activity Report.pdf'));
    }
}
