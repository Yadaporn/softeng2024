<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PjController extends Controller
{
    function result_index(){
        $subjects=DB::table('subjects')->get();
        return view('teacher.result',compact('subjects'));
    }

    /*function result_index() {
        $subjects = DB::table('subjects')
                        ->join('status_build23 as sbj1', 'subjects.sbj_name', '=', 'sbj1.st_subjects')
                        ->join('status_build23 as sbj2', 'subjects.sbj_day', '=', 'sbj2.st_day')
                        ->join('status_build23 as sbj3', 'subjects.sbj_start', '=', 'sbj3.st_start')
                        ->join('status_build15', function($join) {
                            $join->on('subjects.sbj_name', '=', 'status_build15.st_subjects')
                                ->on('subjects.sbj_day', '=', 'status_build15.st_day')
                                ->on('subjects.sbj_start', '=', 'status_build15.st_start');
                        })
                        ->join('status_build2', function($join) {
                            $join->on('subjects.sbj_name', '=', 'status_build2.st_subjects')
                                ->on('subjects.sbj_day', '=', 'status_build2.st_day')
                                ->on('subjects.sbj_start', '=', 'status_build2.st_start');
                        })
                        ->select('subjects.*', 'sbj1.*', 'sbj2.*', 'sbj3.*', 'status_build15.*', 'status_build2.*')
                        ->get();
    
        return view('result', compact('subjects'));
    }*/
    
    /*function result_index() {
        $subjects = DB::table('subjects')
                        ->join('status_build23', 'subjects.sbj_name', '=', 'status_build23.st_subjects')
                        ->join('status_build23', 'subjects.sbj_day', '=', 'status_build23.st_day')
                        ->join('status_build23', 'subjects.sbj_start', '=', 'status_build23.st_start')
                        ->join('status_build23', 'subjects.sbj_end', '=', 'status_build23.st_end')
                        ->select('subjects.*', 'status_build23.*')
                        ->get();
    
        return view('result', compact('subjects'));
    }*/
    
    /*function result_index() {
        $subjects = DB::table('subjects')
                        ->join('status_build23 as sbj1', 'subjects.sbj_name', '=', 'sbj1.st_subjects')
                        ->join('status_build23 as sbj2', 'subjects.sbj_day', '=', 'sbj2.st_day')
                        ->join('status_build23 as sbj3', 'subjects.sbj_start', '=', 'sbj3.st_start')
                        ->join('status_build23 as sbj4', 'subjects.sbj_end', '=', 'sbj4.st_end')
                        ->select('subjects.*', 'sbj1.*', 'sbj2.*', 'sbj3.*', 'sbj4.*')
                        ->get();
    
        return view('result', compact('subjects'));
    }*/   

    function edit_result(){
        $subjects=DB::table('subjects')->get();
        return view('teacher.editresult',compact('subjects'));
    }

    function delete_subject($id){
        DB::table('subjects')->where('sbj_id',$id)->delete();
        return redirect('teacher.editresult');
    }

    function edit_detail($id){
        $subjects=DB::table('subjects')->where('sbj_id',$id)->first();
        return view('teacher.editdetail',compact('subjects'));
    }

    function update_detail(Request $request,$id){
        $request->validate(
            [
                'sbj_day'=>'required',
                'sbj_start'=>'required',
                'sbj_end'=>'required',
                'sbj_number_of_students'=>'required',
                'sbj_major'=>'required'
            ],
            [
                'sbj_number_of_students.required'=>'กรุณาป้อนจำนวนนิสิต',
                'sbj_major.required'=>'กรุณาป้อนสาขา-ชั้นปี'
            ]
        );
        $data=([
            'sbj_day'=>$request->sbj_day,
            'sbj_start'=>$request->sbj_start,
            'sbj_end'=>$request->sbj_end,
            'sbj_number_of_students'=>$request->sbj_number_of_students,
            'sbj_major'=>$request->sbj_major
        ]);
        DB::table('subjects')->where('sbj_id',$id)->update($data);
        return redirect('editresult');
    }
}