<?php

namespace App\Http\Controllers;

use App\Imports\CourseImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Course55;



class ImportController extends Controller
{
    function import_index60(Request $request){
        if($request->has('search')){
            $course60=DB::table('course60s')->where('course_name','LIKE','%' .$request->search.'%')->paginate(10);
        }else{
            $course60=DB::table('course60s')->paginate(9);
    }
        // $data = DB::table('course60s')->get();
        return view('accounter.import_course60',compact('course60'));
    }

    function import_index55(Request $request){
        if($request->has('search')){
            $course55=DB::table('course55s')->where('course_name','LIKE','%' .$request->search.'%')->paginate(10);
        }else{
            $course55=DB::table('course55s')->paginate(9);
    }
        // $data = DB::table('course60s')->get();
        return view('accounter.import_course55',compact('course55'));
    }

    function import_index65(Request $request){
        if($request->has('search')){
            $course65=DB::table('course65s')->where('course_name','LIKE','%' .$request->search.'%')->paginate(10);
        }else{
            $course65=DB::table('course65s')->paginate(9);
    }
        // $data = DB::table('course60s')->get();
        return view('accounter.import_course65',compact('course65'));
    }

    function import_dropdown(){
        $dropdown = DB::table('dropdowns')->get();
        return view('accounter.import_welcome',compact('dropdown'));
        // return view('import_dropdown',compact('dropdown'));
    }
    

    //function import_index3(){
        //$search = Post::all();
        //return view('cours',compact('search'));
    //}

    function import_create60(){
        return view('accounter.import_form60');
        //return view('test');
    }

    function import_create55(){
        return view('accounter.import_form55');
        //return view('test');
    }

    function import_create65(){
        return view('accounter.import_form65');
        //return view('test');
    }
    
    function import_insert60(Request $request){
        $request->validate([
            'idr'=>'required',
            'code'=>'required',
            'name'=>'required',
            'lec'=>'required',
            'lab'=>'required',
            'year'=>'required'
        ],
        [
            'idr.required'=>'กรุณาป้อนรหัสวิชา',
            'code.required'=>'กรุณาป้อนรหัสวิชา-ปีหลักสูตร',
            'name.required'=>'กรุณาป้อนชื่อวิชา',
            'lec.required'=>'กรุณาป้อนรหัสบรรยาย',
            'lab.required'=>'กรุณาป้อนรหัสปฏิบัติ',
            'year.required'=>'กรุณาป้อนหลักสูตร'
        ]
    );
        $data=[
            'course_idr'=>$request->idr,
            'course_code'=>$request->code,
            'course_name'=>$request->name,
            'course_lec'=>$request->lec,
            'course_lab'=>$request->lab,
            'course_year'=>$request->lab
        ];
        //dd($data);
        DB::table('course60s')->insert($data);
        return redirect('/import_course60');
    }

    function import_insert55(Request $request){
        $request->validate([
            'idr'=>'required',
            'code'=>'required',
            'name'=>'required',
            'lec'=>'required',
            'lab'=>'required',
            'year'=>'required'
        ],
        [
            'idr.required'=>'กรุณาป้อนรหัสวิชา',
            'code.required'=>'กรุณาป้อนรหัสวิชา-ปีหลักสูตร',
            'name.required'=>'กรุณาป้อนชื่อวิชา',
            'lec.required'=>'กรุณาป้อนรหัสบรรยาย',
            'lab.required'=>'กรุณาป้อนรหัสปฏิบัติ',
            'year.required'=>'กรุณาป้อนหลักสูตร'
        ]
    );
        $data=[
            'course_idr'=>$request->idr,
            'course_code'=>$request->code,
            'course_name'=>$request->name,
            'course_lec'=>$request->lec,
            'course_lab'=>$request->lab,
            'course_year'=>$request->lab
        ];
        //dd($data);
        DB::table('course55s')->insert($data);
        return redirect('/import_course55');
    }

    function import_insert65(Request $request){
        $request->validate([
            'idr'=>'required',
            'code'=>'required',
            'name'=>'required',
            'lec'=>'required',
            'lab'=>'required',
            'year'=>'required'
        ],
        [
            'idr.required'=>'กรุณาป้อนรหัสวิชา',
            'code.required'=>'กรุณาป้อนรหัสวิชา-ปีหลักสูตร',
            'name.required'=>'กรุณาป้อนชื่อวิชา',
            'lec.required'=>'กรุณาป้อนรหัสบรรยาย',
            'lab.required'=>'กรุณาป้อนรหัสปฏิบัติ',
            'year.required'=>'กรุณาป้อนหลักสูตร'
        ]
    );
        $data=[
            'course_idr'=>$request->idr,
            'course_code'=>$request->code,
            'course_name'=>$request->name,
            'course_lec'=>$request->lec,
            'course_lab'=>$request->lab,
            'course_year'=>$request->lab
        ];
        //dd($data);
        DB::table('course65s')->insert($data);
        return redirect('/import_course65');
    }

    function import_delete60($course_id){
        DB::table('course60s')->where('course_id',$course_id)->delete();
        return redirect('/import_course60');
    }

    function import_delete55($course_id){
        DB::table('course55s')->where('course_id',$course_id)->delete();
        return redirect('/import_course55');
    }

    function import_delete65($course_id){
        DB::table('course65s')->where('course_id',$course_id)->delete();
        return redirect('/import_course65');
    }

    function import_update60(Request $request,$course_id){
        $request->validate([
            'idr'=>'required',
            'code'=>'required',
            'name'=>'required',
            'lec'=>'required',
            'lab'=>'required',
            'year'=>'required'
        ],
        [
            'idr.required'=>'กรุณาป้อนรหัสวิชา',
            'code.required'=>'กรุณาป้อนรหัสวิชา-ปีหลักสูตร',
            'name.required'=>'กรุณาป้อนชื่อวิชา',
            'lec.required'=>'กรุณาป้อนรหัสบรรยาย',
            'lab.required'=>'กรุณาป้อนรหัสปฏิบัติ',
            'year.required'=>'กรุณาป้อนหลักสูตร'
        ]
    );
        $data=[
            'course_idr'=>$request->idr,
            'course_code'=>$request->code,
            'course_name'=>$request->name,
            'course_lec'=>$request->lec,
            'course_lab'=>$request->lab,
            'course_year'=>$request->lab
        ];
        // dd($data);
        DB::table('course60s')->where('course_id',$course_id)->update($data);
        return redirect('/import_course60');
    }

    function import_update55(Request $request,$course_id){
        $request->validate([
            'idr'=>'required',
            'code'=>'required',
            'name'=>'required',
            'lec'=>'required',
            'lab'=>'required',
            'year'=>'required'
        ],
        [
            'idr.required'=>'กรุณาป้อนรหัสวิชา',
            'code.required'=>'กรุณาป้อนรหัสวิชา-ปีหลักสูตร',
            'name.required'=>'กรุณาป้อนชื่อวิชา',
            'lec.required'=>'กรุณาป้อนรหัสบรรยาย',
            'lab.required'=>'กรุณาป้อนรหัสปฏิบัติ',
            'year.required'=>'กรุณาป้อนหลักสูตร'
        ]
    );
        $data=[
            'course_idr'=>$request->idr,
            'course_code'=>$request->code,
            'course_name'=>$request->name,
            'course_lec'=>$request->lec,
            'course_lab'=>$request->lab,
            'course_year'=>$request->lab
        ];
        // dd($data);
        DB::table('course55s')->where('course_id',$course_id)->update($data);
        return redirect('/import_course55');
    }

    function import_update65(Request $request,$course_id){
        $request->validate([
            'idr'=>'required',
            'code'=>'required',
            'name'=>'required',
            'lec'=>'required',
            'lab'=>'required',
            'year'=>'required'
        ],
        [
            'idr.required'=>'กรุณาป้อนรหัสวิชา',
            'code.required'=>'กรุณาป้อนรหัสวิชา-ปีหลักสูตร',
            'name.required'=>'กรุณาป้อนชื่อวิชา',
            'lec.required'=>'กรุณาป้อนรหัสบรรยาย',
            'lab.required'=>'กรุณาป้อนรหัสปฏิบัติ',
            'year.required'=>'กรุณาป้อนหลักสูตร'
        ]
    );
        $data=[
            'course_idr'=>$request->idr,
            'course_code'=>$request->code,
            'course_name'=>$request->name,
            'course_lec'=>$request->lec,
            'course_lab'=>$request->lab,
            'course_year'=>$request->lab
        ];
        // dd($data);
        DB::table('course65s')->where('course_id',$course_id)->update($data);
        return redirect('/import_course65');
    }

    function import_edit60($course_id){
        $course60=DB::table('course60s')->where('course_id',$course_id)->first();
        return view('accounter.import_edit60', compact('course60'));
        // dd($course);
    }

    function import_edit55($course_id){
        $course55=DB::table('course55s')->where('course_id',$course_id)->first();
        return view('accounter.import_edit55', compact('course55'));
        // dd($course);
    }

    function import_edit65($course_id){
        $course65=DB::table('course65s')->where('course_id',$course_id)->first();
        return view('accounter.import_edit65', compact('course65'));
        // dd($course);
    }

    public function importExcelCourse55(Request $request)
    {
    if ($request->hasFile('excelFile')) {
        $file = $request->file('excelFile');

        if ($file->isValid()) {
            $spreadsheet = IOFactory::load($file->path());
            $worksheet = $spreadsheet->getActiveSheet();

            $errors = []; // To collect error messages

            foreach ($worksheet->getRowIterator() as $row) {
                if ($row->getRowIndex() < 2) {
                    continue; // Skip rows before the third one, assuming headers or empty rows
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Map $data to your Classroom model's attributes
                $CourseData = [
                    'course_id' => $data[0] ?? null,
                    'course_idr' => $data[1] ?? null,
                    'course_code' => $data[2] ?? null,
                    'course_name' => $data[3] ?? null,
                    'course_lec' => $data[4] ?? null,
                    'course_lab' => $data[5] ?? null,
                    'course_year' => $data[6] ?? null,
                ];

                // Validate your data here (example validation step is skipped for brevity)
                // If validation passes, create the Classroom
                Course55::create($CourseData);
            }
            // return redirect()->back();
            // return redirect()->back()->with('status','Imported Successfully');

            return redirect()->route('accounter.import_course55')
                ->with('success', 'Data has been successfully imported into the system.');
        }
    } 
}
}
