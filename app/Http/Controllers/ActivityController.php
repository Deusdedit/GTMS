<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
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
        $activities = Activity::all();
        
        return view('Activity.index',compact('activities'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function finish(Request $request, $id)
    {
        //
    }
}
