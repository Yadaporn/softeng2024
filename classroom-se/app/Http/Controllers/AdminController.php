<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use TCPDF;
use Dompdf\Dompdf;
use Dompdf\Options;


class AdminController extends Controller
{
    function sbj_index(){
        $data = DB::table('fordropdown')->get();
        $data2 = DB::table('information')->get();
        $data3 = DB::table('information')
                    ->where('info_duty', '=', 'อาจารย์')
                    ->select('info_name')
                    ->distinct()
                    ->get();
        $data4 = DB::table('course55s')
                    ->select('course_name')
                    ->distinct()
                    ->get();
        
        return view('teacher.registerclass', compact('data', 'data2','data3','data4'));  
    }
    
    

    function sbj_insert(Request $request){
        $request->validate([
            'sbj_name' => 'required',
        ]);

        $sbj_major = serialize($request->sbj_major);
        $sbj_major = implode(',', $request->sbj_major);

        $data=[
            'sbj_course' => $request->sbj_course,
            'sbj_year' => $request->sbj_year,
            'sbj_semester' => $request->sbj_semester,
            'sbj_name' => $request->sbj_name, // รวมรหัสรายวิชาและชื่อรายวิชาก่อนส่ง
            'sbj_number_of_students' => $request->sbj_number_of_students,
            'sbj_day' => $request->sbj_day,
            'sbj_start' => $request->sbj_start,
            'sbj_end' => $request->sbj_end,
            'sbj_sec' => $request->sbj_sec,
            'sbj_major' => $sbj_major,
            'sbj_teacher_name' => $request->sbj_teacher_name
        ];
        
        
        
        // ส่งข้อมูลไปยังฐานข้อมูล
        DB::table('subjects')->insert($data);
        
        
        //     // ตรวจสอบค่าของ sbj_sec และทำการ redirect ไปยังหน้าที่ต้องการ
        // if (in_array($request->sbj_sec, ['830', '831', '832', '833'])) {
        //     // Redirect ไปยังหน้าที่ต้องการ
        //     return redirect()->route('choosebuild');
        // } else {
        //     // Redirect ไปยังหน้าที่ต้องการ
        //     return redirect()->route('result');
        // }
        
        
        
    }

    function result_index(){
        $subjects = DB::table('subjects')->get();
        return view('teacher.export', compact('subjects'));
    }

    

    public function getSbjNames(Request $request){
        $sbj_course = $request->sbj_course;
        switch ($sbj_course) {
            case '2555':
                $data5 = DB::table('course55s')->select(DB::raw("CONCAT(sbj_code, ' - ', sbj_name) AS full_sbj_name"), 'sbj_code')->pluck('full_sbj_name', 'sbj_code');
                break;
            case '2560':
                $data5 = DB::table('course60s')->select(DB::raw("CONCAT(sbj_code, ' - ', sbj_name) AS full_sbj_name"), 'sbj_code')->pluck('full_sbj_name', 'sbj_code');
                break;
            case '2565':
                $data5 = DB::table('course65s')->select(DB::raw("CONCAT(sbj_code, ' - ', sbj_name) AS full_sbj_name"), 'sbj_code')->pluck('full_sbj_name', 'sbj_code');
                break;
            default:
                $data5 = [];
                break;
        }
        return response()->json($data5);
    }


    public function exportPDF()
    {
        $subjects = DB::table('subjects')->get();

        // สร้างเอกสาร PDF
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // กำหนดฟอนต์ที่ใช้ใน PDF
        $dompdf->set_option('font', public_path('vendor/dompdf/dompdf/lib/fonts/THSarabun.ttf'));

        // โหลด HTML และแสดงผลในเอกสาร PDF
        $html = view('teacher.export', compact('subjects'))->render();
        $dompdf->loadHtml($html);

        // แสดงเอกสาร PDF ในเบราว์เซอร์ก่อน
        $dompdf->render();

        // ส่งคืนเอกสาร PDF โดยไม่มีการดาวน์โหลด
        return $dompdf->stream('subjects.pdf');
    }



    
}


