<?php

namespace App\Http\Controllers\ICCS;

use Illuminate\Http\Request;
use App\Models\ICCS\Department;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


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
	    return view('users.listdepartment', ['departments' => $departments]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);        
        $departments = Department::find($decrypted);        
            return view('users.department', ['departments' => $departments        
        ]);        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([            
            
            'department' => ['required','unique:departments,department,except,id']        

        ]);
        $department = Department::find($id);  
        //get old value
        $olddepartment = $department->department;  

        //save process
        $department->department = $request->department;          
        $department->update(); 
        
             
        $check = $department->wasChanged(); 
        if ($check==True){
            //add to AuditUsers Table
            if ($department->waschanged('department')==True){
                DB::table('auditusers')->insert([
               
                    'change_by' => Auth::user()->username,        
                    'activity' => 'Audit Change',
                    'recordid' => $department->department,
                    'sourcetable' => 'departments',
                    'sourcefield' => 'department',
                    'beforevalue' => $olddepartment,
                    'aftervalue' => $request->department,
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                ]);
            }
            return redirect('/department')->with('success','Data edited successfully!');
        }else{
            return back()->with('info','Nothing Changed');
        }
               
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
