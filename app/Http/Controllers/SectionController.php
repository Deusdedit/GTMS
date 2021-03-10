<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department; 
use App\Models\Section; 

class SectionController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $departments = Department::all();
        return view('Sections.index',compact('departments','sections'));
    }
    public function indexing()
    {
        $sections = Section::all();
        $departments = Department::all();
        return view('Sections.indexing',compact('departments','sections'));
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
    { $validatedData = $request->validate([
            'name' => 'required',
            'name_abbreviation' => 'required',
            
            ]);
       
        $section = new Section();
        $section->name = $request['name'];
        $section->name_abbreviation = $request['name_abbreviation'];
        $section->department_id = $request['department_id'];
        $section->save();
        return redirect()->route('sectioning')->with('success','Section added successfully.');
   
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
        $section = Section::find($id);
        $section_dept_id = $section->department_id;
        $section_dept = Section::find($section_dept_id);
        $departments = Department::all();
        return view('Sections.edit',compact('section','section_dept', 'departments'));
    
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
            'name_abbreviation' => 'required',

           
        ]);
        $section = Section::find($id);
        $section_dept_id = $section->department_id;
        $section_dept = Section::find($section_dept_id);
        $departments = Department::all();

        $section->name = $request['name'];
        $section_dept_id = $request['department_id'];
        $section->name_abbreviation = $request['name_abbreviation'];
        $section->save();
        $section_dept -> save();
        return redirect()->route('sectioning')->with('success', 'section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return redirect()->route('sectioning')->with('success', 'Section Deleted successfully');
  
    }
}
