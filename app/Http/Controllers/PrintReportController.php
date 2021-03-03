<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Section;
use App\Models\Department;
use Auth;

use PDF;

class PrintReportController extends Controller
{
    
    public function activity() {

        $activities = Activity::all();
        $logged_id = Auth::user()->id;
        
        $usern = User::find($logged_id);
        $section =Section::find($usern->section_id);
        $depertment = Department::find($section->department_id);

        $pdf = PDF::loadView('Activity.print_activity', compact('activities','logged_id','usern','section','depertment'));
        $pdf->setPaper('A4', 'landscape');
        
        return ($pdf->stream('Activity Report.pdf'));
    }


    public function activityFinished() {

        $activities = Activity::all()->where('status','Finished');
        $logged_id = Auth::user()->id;
        $usern = User::find($logged_id);
        $section =Section::find($usern->section_id);
        $depertment = Department::find($section->department_id);
        
        $pdf = PDF::loadView('Activity_finished.print_activity', compact('usern','activities','logged_id','section','depertment'));
        $pdf->setPaper('A4', 'landscape');
        
        return ($pdf->stream('Activity_finished Report.pdf'));
    }

    public function activityOngoing() {

        $activities = Activity::all()->where('status','On going');
        $logged_id = Auth::user()->id;
        $usern = User::find($logged_id);
        $section =Section::find($usern->section_id);
        $depertment = Department::find($section->department_id);
        
        $pdf = PDF::loadView('Activity_ongoing.print_activity', compact('usern','activities','logged_id','section','depertment'));
        $pdf->setPaper('A4', 'landscape');
        
        return ($pdf->stream('Activity_ongoing Report.pdf'));
    }
}
