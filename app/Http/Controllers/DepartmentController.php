<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department; 

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $departments = Department::all();
        return view('Departments.index',compact('departments')); 
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
            'name_abbreviation' => 'required',
            'department_id' => 'required',
                    
        ]);
       

        $department = new Department();
        $department->name = $request['name'];
        $department->name_abbreviation = $request['name_abbreviation'];
        $department->department_id = $request['department_id'];
        $department->save();
        return redirect()->route('activity.index')->with('success','Department added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        return view('department.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::find($id);

        return view('Departments.edit',compact('departments'));
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
       
        $department = Department::find($id);
        $department->name = $request['name'];
        $department->name_abbreviation = $request['name_abbreviation'];
        $department->save();
        return redirect()->route('department.index')->with('success','Department updated successfully.');
    


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('department.index')->with('success', 'Department Deleted successfully');
  
    }
}
