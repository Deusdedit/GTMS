<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
Use \Carbon\Carbon;  
use Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::orderBy('start_date', 'asc')->get();
        $logged_id = Auth::user()->id;
        
        return view('Activity.index',compact('activities', 'logged_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'details' => 'required',
            'resources' => 'required',            
        ]);
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');

        $activity = new Activity();
        $activity->name = $request['name'];
        $activity->client = $request['client'];
        $activity->details = $request['details'];
        $activity->colaborators = $request['colaborators'];
        $activity->output = $request['output'];
        $activity->resources = $request['resources'];
        $activity->start_date = $now_date;
        $activity->status = "On going";
        $activity->user_id = Auth::user()->id;
        $activity->save();
        return redirect()->route('activity.index')->with('success','Activity added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        $users = User::all();
        return view('activity.show',compact('activity', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);

        return view('Activity.edit',compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);
        $activity->name = $request['name'];
        $activity->client = $request['client'];
        $activity->details = $request['details'];
        $activity->colaborators = $request['colaborators'];
        $activity->output = $request['output'];
        $activity->resources = $request['resources'];
        $activity->save();
        return redirect()->route('activity.index')->with('success','Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $activity = Activity::find($id);
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Activity Deleted successfully');
    }

    public function finish(Request $request, $id)
    {
        $activity = Activity::find($id);
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $activity->recommendations = $request['recommendations'];
        $activity->end_date = $now_date;
        $activity->status = "Finished";
        $activity->save();
        return redirect()->route('activity.index')->with('success','Congrats activity finished successfully.');
    }

    public function cancel(Request $request, $id)
    {
        $validatedData = $request->validate([
            'recommendations' => 'required',           
        ]);

        $activity = Activity::find($id);
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $activity->recommendations = $request['recommendations'];
        $activity->end_date = $now_date;
        $activity->status = "Incomplete";
        $activity->save();
        return redirect()->route('activity.index')->with('success','Congrats activity finished successfully.');
    }

    public function start(Request $request, $id)
    {
        $activity = Activity::find($id);
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $activity->start_date = $now_date;
        $activity->status = "On going";
        $activity->save();
        return redirect()->route('activity.index')->with('success','Congrats you started activity successfully.');
    }
}

