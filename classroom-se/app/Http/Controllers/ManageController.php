<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class ManageController extends Controller
{
    // function Manage_index(){
    //     $sbjs=DB::table('subjects')
    //     ->select( 'sbj_day', 'sbj_start', 'sbj_end', 'sbj_name', 'sbj_teacher_name')
    //     ->groupBy( 'sbj_day', 'sbj_start', 'sbj_end', 'sbj_name', 'sbj_teacher_name')
    //     ->havingRaw('COUNT(*) > 1')
    //     ->get();
    //     dd($sbjs);
    //     return view('accounter.managesbj',['sbjs' => $sbjs]);
    // }
    function Manage_index(){
        $sbjs=DB::table('subjects')->paginate(10);
        return view('accounter.managesbj',compact('sbjs'));
    }
    function Manage_index_table(){
        $sbjs=DB::table('subjects')->paginate(10);
        return view('teacher.tablelast',compact('sbjs'));
        dd($sbjs);
    }

    function Info_insert(Request $request){
        $request->validate(
            [
                'email'=>'required',
                'name'=>'required',
                'duty'=>'required'
            ],
            [
                'email.required'=>'กรุณาใส่ อีเมล',
                'name.required'=>'กรุณาใส่ ชื่อ - สกุล',
                'duty.required'=>'กรุณาใส่ หน้าที่'
            ]
        );
        $data=([
            'info_email'=>$request->email,
            'info_name'=>$request->name,
            'info_duty'=>$request->duty
        ]);
        // dd($data);
        DB::table('information')->insert($data);
        return redirect('/Info_blog');
        // return redirect()->route('members.create');
    }

    function Manage_delete($sbj_id){
        DB::table('subjects')->where('sbj_id',$sbj_id)->delete();
        return redirect('accounter.managesbj');
    }

    public function Manage_success(Request $request){
        
        $data = array();
        $data["sbj_day"] = $request->sbj_day;
        $data["sbj_start"] = $request->sbj_start;
        $data["sbj_end"] = $request->sbj_end;
        $data["sbj_name"] = $request->sbj_name;
        $data["sbj_Teacher_Name"] = $request->sbj_Teacher_Name;
        //query builder
        DB::table('classcreated')->insert($data);

        return redirect()->route('accounter.managesbj')->with('success', "อัพเดตข้อมูลเรียบร้อย");
    }

   
}
