<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Alert;

class Infocontroller extends Controller
{
    function Info_index(){
        $blogs=DB::table('information')->paginate(10);
        return view('Info_blog',compact('blogs'));
    }
    // function index(){
    //     $data = DB::table('dbclassrooms')->get();
    //     return view('dropdown',compact('data'));
    // }

    function Info_create(){
        // Alert::success('บันทึก','ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว');
        return view('admin.Info_about');
        
    }

    // function Info_insert(Request $request){
    //     $request->validate([
    //         'email'=>'required',
    //         'name'=>'required',
    //         'duty'=>'required'
    //     ], [
    //         'email.required'=>'กรุณาใส่ อีเมล',
    //         'name.required'=>'กรุณาใส่ ชื่อ - สกุล',
    //         'duty.required'=>'กรุณาใส่ หน้าที่'
    //     ]);
        
    //     $data = [
    //         'info_email' => $request->email,
    //         'info_name' => $request->name,
    //         'info_duty' => $request->duty
    //     ];
        
    //     // dd($data);
    //     DB::table('information')->insert($data);
    //     return redirect('/Info_blog');
    //     // return redirect()->route('members.create');
    // }

    function Info_insert(Request $request){
        $request->validate([
            'info_email' => 'required|email',
            'info_name' => 'required',
            'info_duty' => [
                'required',
                'max:12',
                Rule::unique('information', 'info_duty')->where(function ($query) use ($request) {
                    return $query->where('info_email', $request->info_email);
                }),
            ],
        ], [
            'info_email.required' => 'กรุณาใส่ อีเมล',
            'info_name.required' => 'กรุณาใส่ ชื่อ - สกุล',
            'info_duty.required' => 'กรุณาใส่ หน้าที่',
            'info_duty.max' => 'หน้าที่ต้องมีความยาวไม่เกิน 12 ตัวอักษร',
            'info_duty.unique' => 'หน้าที่นี้ถูกบันทึกแล้ว กรุณาเลือกหน้าที่อื่น',
        ]);

        if ($request->info_duty === "admin") {
            return redirect()->back()->withErrors(['info_duty' => 'หน้าที่นี้ถูกบันทึกแล้ว กรุณาเลือกหน้าที่อื่น']);
        }
    
        $data = [
            'info_email' => $request->info_email,
            'info_name' => $request->info_name,
            'info_duty' => $request->info_duty
        ];
    
        // บันทึกข้อมูลลงในตารางข้อมูล
        DB::table('information')->insert($data);
        return redirect('/Info_blog');
        // $request->validate([
        //     'info_email'=>'required',
        //     'info_name'=>'required',
        //     'info_duty'=>'required|max:12|unique:information'
        // ], [
        //     'info_email.required'=>'กรุณาใส่ อีเมล',
        //     'info_name.required'=>'กรุณาใส่ ชื่อ - สกุล',
        //     'info_duty.required'=>'กรุณาใส่ หน้าที่',
        //     'info_duty.max'=>'ห้ามใส่ตัวอักษรเกิน 12 ตัว',
        //     'info_duty.unique'=>'ห้ามใส่ข้อความที่ซ้ำกัน'
        // ]);
        
        // $data = [
        //     'info_email' => $request->info_email,
        //     'info_name' => $request->info_name,
        //     'info_duty' => $request->info_duty
        // ];
        
        // // บันทึกข้อมูลลงในตารางข้อมูล
        // DB::table('information')->insert($data);
        // return redirect('/Info_blog');

        // $request->validate(
        //     [
        //         'email'=>'required',
        //         'name'=>'required',
        //         'duty'=>'required'
        //     ],
        //     [
        //         'email.required'=>'กรุณาใส่ อีเมล',
        //         'name.required'=>'กรุณาใส่ ชื่อ - สกุล',
        //         'duty.required'=>'กรุณาใส่ หน้าที่'
        //     ]
        // );
        // $data=([
        //     'info_email'=>$request->email,
        //     'info_name'=>$request->name,
        //     'info_duty'=>$request->duty
        // ]);
        
        // // บันทึกข้อมูลลงในตารางข้อมูล
        // DB::table('information')->insert($data);
        // return redirect('/Info_blog');
    }

    function Info_delete($info_id){
        DB::table('information')->where('info_id',$info_id)->delete();
        return redirect('/Info_blog')->with('success', 'บันทึกข้อมูลสำเร็จแล้ว');;
    }

    function Info_edit($info_id){
        $member = DB::table('information')->where('info_id',$info_id)->first();
        return view('admin.Info_edit',compact('member'));
    }

    function Info_update(Request $request,$info_id){
        $request->validate([
            'info_email' => 'required|email',
            'info_name' => 'required',
            'info_duty' => [
                'required',
                'max:12',
                // Rule::unique('information', 'info_duty')->where(function ($query) use ($request) {
                //     return $query->where('info_email', $request->info_email);
                // }),
            ],
        ], [
            'info_email.required' => 'กรุณาใส่ อีเมล',
            'info_name.required' => 'กรุณาใส่ ชื่อ - สกุล',
            'info_duty.required' => 'กรุณาใส่ หน้าที่',
            'info_duty.max' => 'หน้าที่ต้องมีความยาวไม่เกิน 12 ตัวอักษร',
            // 'info_duty.unique' => 'หน้าที่นี้ถูกบันทึกแล้ว กรุณาเลือกหน้าที่อื่น',
        ]);

        // if ($request->info_duty === "admin") {
        //     return redirect()->back()->withErrors(['info_duty' => 'หน้าที่นี้ถูกบันทึกแล้ว กรุณาเลือกหน้าที่อื่น']);
        // }
    
        $data = [
            'info_email' => $request->info_email,
            'info_name' => $request->info_name,
            'info_duty' => $request->info_duty
        ];
        // dd($data);
        DB::table('information')->where('info_id',$info_id)->update($data);
        return redirect('/Info_blog');
    }

    function view_pdf(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>สวัสดี</h1>');
        $mpdf->Output();
    }
}
