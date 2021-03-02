<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Department;
use App\Models\Section;
use Auth;
Use \Carbon\Carbon;  

class AssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::orderBy('start_date', 'asc')->get();
        $users = User::all();
        $departments = Department::all();
        $sections = Section::all();
        $logged_id = Auth::user()->id;
        
        return view('assign.index',compact('activities', 'logged_id','users','departments','sections'));
        
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
            'user_id' => 'required',
            'duration' => 'required',
            'resources' => 'required',   
            'start_assign_date' => 'required',         
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

        $activity->user_id = $request['user_id'];
        $activity->duration = $request['duration'];
        $activity->start_assign_date = $request['start_assign_date'];
        $activity->assigned_date = $now_date;
        $activity->status = "Not Started";
        $activity->activity_from_user_id = Auth::user()->id;
        $activity->save();
        return redirect()->route('assign.index')->with('success','Activity assigned successfully.');
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
        $departments = Department::all();
        $sections = Section::all();
        $logged_id = Auth::user()->id;
        
        return view('assign.show',compact('activity', 'logged_id','users','departments','sections'));
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
        $users = User::all();
        $departments = Department::all();
        $sections = Section::all();
        return view('assign.edit',compact('activity','users','departments','sections'));
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
        $validatedData = $request->validate([
            'name' => 'required',
            'details' => 'required',
            'user_id' => 'required',
            'duration' => 'required',
            'resources' => 'required',   
            'start_assign_date' => 'required',         
        ]);
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');

        $activity = Activity::find($id);

        $activity->name = $request['name'];
        $activity->client = $request['client'];
        $activity->details = $request['details'];
        $activity->colaborators = $request['colaborators'];
        $activity->output = $request['output'];
        $activity->resources = $request['resources'];

        $activity->user_id = $request['user_id'];
        $activity->duration = $request['duration'];
        $activity->start_assign_date = $request['start_assign_date'];
        $activity->save();
        return redirect()->route('assign.index')->with('success','assigned activity updated successfully.');
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
        return redirect()->route('assign.index')->with('success', 'Activity assigned Deleted successfully');
    }
}
