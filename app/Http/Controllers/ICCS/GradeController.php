<?php

namespace App\Http\Controllers\ICCS;

use App\Models\ICCS\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
	    return view('users.listgrade', ['grades' => $grades]);
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
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);        
        $grades = Grade::find($decrypted);
        return view('users.grade', ['grades' => $grades]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([            
            
            'grade' => ['required','unique:grades,grade,except,id']        

        ]);
        $grade = grade::find($id);  
        //get old value
        $oldgrade = $grade->grade;  

        //save process
        $grade->grade = $request->grade;          
        $grade->update(); 
        
             
        $check = $grade->wasChanged(); 
        if ($check==True){
            //add to AuditUsers Table
            if ($grade->waschanged('grade')==True){
                DB::table('auditusers')->insert([
               
                    'change_by' => Auth::user()->username,        
                    'activity' => 'Audit Change',
                    'recordid' => $grade->grade,
                    'sourcetable' => 'grades',
                    'sourcefield' => 'grade',
                    'beforevalue' => $oldgrade,
                    'aftervalue' => $request->grade,
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                ]);
            }
            return redirect('/grade')->with('success','Data edited successfully!');
        }else{
            return back()->with('info','Nothing Changed');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userlogin = Auth::user()->id;
        $levellogin = Auth::user()->level;   
        $decrypted = Crypt::decryptString($id);
        $grade = grade::find($decrypted);       
        $grade->delete();
            //add to auditusers table            
                DB::table('auditusers')->insert([
            
                    'change_by' => Auth::user()->username,        
                    'activity' => 'Delete Grade',
                    'recordid' => $grade->grade,
                    'sourcetable' => 'grades',
                    'sourcefield' => 'deleted_date',
                    'beforevalue' => '',
                    'aftervalue' => '',
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                ]);
                     
                return back()->with('success','Grade has been deleted!'); 
        
    }
}
