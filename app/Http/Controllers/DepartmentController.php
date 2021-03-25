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
    public function indexing() 
    {
        $departments = Department::all();
        return view('Departments.indexing',compact('departments')); 
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
        ]);
       

        $department = new Department();
        $department->name = $request['name'];
        $department->name_abbreviation = $request['name_abbreviation'];

        $already_department_name = Department::where('name', $request['name'])->count();
        $already_department_abbr = Department::where('name_abbreviation', $request['name_abbreviation'])->count();
        
        if($already_department_name > 0){
            return redirect()->route('departmenting')->withErrors('Department name entered already exists.');
        }
        elseif($already_department_abbr >0){
            return redirect()->route('departmenting')->withErrors('Department abbreviation entered already exists.');
        }
         else {
            $department -> save();
        }

       /*  $department->save(); */
        return redirect()->route('departmenting')->with('success','Department added successfully.');
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
        return redirect()->route('departmenting')->with('success','Department updated successfully.');
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
        return redirect()->route('departmenting')->with('success', 'Department Deleted successfully');
  
    }
}
