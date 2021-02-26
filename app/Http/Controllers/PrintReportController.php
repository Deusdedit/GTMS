<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Auth;

use PDF;

class PrintReportController extends Controller
{
    
    public function activity() {

        $activities = Activity::all();
        $logged_id = Auth::user()->id;
        
        $pdf = PDF::loadView('Activity.print_activity', compact('activities','logged_id'));
        $pdf->setPaper('A4', 'landscape');
        
        return ($pdf->stream('Activity Report.pdf'));
    }
}
