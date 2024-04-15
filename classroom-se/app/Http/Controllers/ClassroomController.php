<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Classroom;
use App\Models\Subjects;

class ClassroomController extends Controller
{
    // Assuming 'tb_build' is the table associated with this model
    protected $table = 'tb_build';

    // Tell Eloquent not to maintain timestamps for this model
    public $timestamps = false;

    public function deleteMethodroom($crs_id)
    {
        $ClassroomController = Classroom::findOrFail($crs_id);
        $ClassroomController->delete();

        //Redirect back to a page of your choosing with a success message
        return redirect()->route('สถานะ')->with('success', 'Record deleted successfully');
    }
    public function editroom($crs_id)
    {
        $classroom = Classroom::find($crs_id);

        // If you need to pass more data to your view, you can retrieve them here based on the found department
        // For example:
        $crs_id = $classroom->id;
        $crs_room = $classroom->room;
        $crs_build = $classroom->build;
        $crs_Number_of_students = $classroom->Number_of_students;

        return view('accounter.editroom', compact('classroom'));
    }

    public function updateroom(Request $request, $crs_id)
{

    // Find the Classroom by $id and update it with the new 'crs_room' value
    Classroom::find($crs_id)->update([
        'crs_id' => $request->crs_id,
        'crs_room' => $request->crs_room,
        'crs_build' => $request->crs_build,
        'crs_Number_of_students' => $request->crs_Number_of_students,
    ]);

    // Redirect back to a page with a success message
    return redirect()->route('สถานะ')->with('success', "อัพเดตข้อมูลเรียบร้อย");
}

    public function storeroom(Request $request){
        
        $data = array();
        $data["crs_room"] = $request->crs_room;
        $data["crs_build"] = $request->crs_build;
        $data["crs_Number_of_students"] = $request->crs_Number_of_students;
        //query builder
        DB::table('tb_build')->insert($data);

        return redirect()->route('สถานะ')->with('success', "อัพเดตข้อมูลเรียบร้อย");
    }
    public function importExcelroom(Request $request)
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
                $classroomData = [
                    'crs_build' => $data[0] ?? null,
                    'crs_room' => $data[1] ?? null,
                    'crs_Number_of_students' => $data[2] ?? null,
                ];

                // Validate your data here (example validation step is skipped for brevity)
                // If validation passes, create the Classroom
                Classroom::create($classroomData);
            }

            return redirect()->route('สถานะ')
                ->with('success', 'Data has been successfully imported into the system.');
        }
    } else {
        return redirect()->route('สถานะ')
            ->with('fail', 'Please upload a file.');
    }
}
public function getStudentsroom($room)
    {
        // Your logic to get students count
        $studentsCount = DB::table('students')->where('room_id', $room)->count();

        return response()->json([
            'get_students_count' => $studentsCount
        ]);
    }
    public function show($sbj_id)
    {
        $subjects = Subjects::find($sbj_id); // or however you are retrieving the data
        return view('teacher.build15', ['subjects' => $subjects]);
    }
public function showSubjectsFormroom($sbj_id) // Make sure you're accepting the right parameter
{
    $subjects = Subjects::find($sbj_id);
        // If you need to pass more data to your view, you can retrieve them here based on the found department
        // For example:
        $sbj_course = $subjects->sbj_course;
        $sbj_year = $subjects->sbj_year;
        $sbj_semester = $subjects->sbj_semester;
        $sbj_name = $subjects->sbj_name;
        $sbj_number_of_students = $subjects->sbj_number_of_students;
        $sbj_teacher_name = $subjects->sbj_teacher_name;
        $sbj_day = $subjects->sbj_day;
        $sbj_start = $subjects->sbj_start;
        $sbj_end = $subjects->sbj_end;
    return view('teacher.build2', ['subjects' => $sbj_name]);
}
public function storeroom23(Request $request){
    // First, check for duplicate entries
    $duplicate = DB::table('status_build23')
        ->where('st_room', $request->crs_room)
        ->where('st_day', $request->sbj_day)
        ->where(function($query) use ($request) {
            // เช็คว่ามีช่วงเวลาใดช่วงเวลาหนึ่งที่ซ้อนทับกันหรือไม่
            $query->where(function($q) use ($request) {
                $q->where('st_start', '<', $request->sbj_end)
                  ->where('st_end', '>', $request->sbj_start);
            })
            // เพิ่มเงื่อนไขเช็คว่าเวลาเริ่มต้นหรือสิ้นสุดตรงกันพอดีหรือไม่
            ->orWhere('st_start', $request->sbj_start)
            ->orWhere('st_end', $request->sbj_end);
        })
        ->exists(); // Check if any records exist that match these conditions

    if ($duplicate) {
        // If a duplicate exists, redirect back with an error message
        return redirect()->back()->withErrors(['duplicate' => 'ไม่สามารถใช้ห้องซ้ำในช่วงเวลานี้ได้เนื่องจากมีการลงทะเบียนแล้ว']);
    }

    // If no duplicates, proceed to insert the data
    $data = array();
    $data["st_room"] = $request->crs_room;
    $data["st_Number_of_students"] = $request->crs_Number_of_students;
    $data["st_day"] = $request->sbj_day;
    $data["st_start"] = $request->sbj_start;
    $data["st_end"] = $request->sbj_end;
    $data["st_subjects"] = $request->sbj_name;
    $data["st_teacher_name"] = $request->sbj_teacher_name;

    // Use the Query Builder to insert the data
    DB::table('status_build23')->insert($data);

    // Redirect back to the 'build23' route with a success message
    return redirect()->route('build23')->with('success', "อัพเดตข้อมูลเรียบร้อย");
}

public function storeroom15(Request $request){
    // First, check for duplicate entries
    $duplicate = DB::table('status_build15')
        ->where('st_room', $request->crs_room)
        ->where('st_day', $request->sbj_day)
        ->where(function($query) use ($request) {
            // เช็คว่ามีช่วงเวลาใดช่วงเวลาหนึ่งที่ซ้อนทับกันหรือไม่
            $query->where(function($q) use ($request) {
                $q->where('st_start', '<', $request->sbj_end)
                  ->where('st_end', '>', $request->sbj_start);
            })
            // เพิ่มเงื่อนไขเช็คว่าเวลาเริ่มต้นหรือสิ้นสุดตรงกันพอดีหรือไม่
            ->orWhere('st_start', $request->sbj_start)
            ->orWhere('st_end', $request->sbj_end);
        })
        ->exists(); // Check if any records exist that match these conditions

    if ($duplicate) {
        // If a duplicate exists, redirect back with an error message
        return redirect()->back()->withErrors(['duplicate' => 'ไม่สามารถใช้ห้องซ้ำในช่วงเวลานี้ได้เนื่องจากมีการลงทะเบียนแล้ว']);
    }

    // If no duplicates, proceed to insert the data
    $data = array();
    $data["st_room"] = $request->crs_room;
    $data["st_Number_of_students"] = $request->crs_Number_of_students;
    $data["st_day"] = $request->sbj_day;
    $data["st_start"] = $request->sbj_start;
    $data["st_end"] = $request->sbj_end;
    $data["st_subjects"] = $request->sbj_name;
    $data["st_teacher_name"] = $request->sbj_teacher_name;

    // Use the Query Builder to insert the data
    DB::table('status_build15')->insert($data);

    // Redirect back to the 'build23' route with a success message
    return redirect()->route('build15')->with('success', "อัพเดตข้อมูลเรียบร้อย");
}
public function storeroom2(Request $request){
    // First, check for duplicate entries
    $duplicate = DB::table('status_build2')
        ->where('st_room', $request->crs_room)
        ->where('st_day', $request->sbj_day)
        ->where(function($query) use ($request) {
            // เช็คว่ามีช่วงเวลาใดช่วงเวลาหนึ่งที่ซ้อนทับกันหรือไม่
            $query->where(function($q) use ($request) {
                $q->where('st_start', '<', $request->sbj_end)
                  ->where('st_end', '>', $request->sbj_start);
            })
            // เพิ่มเงื่อนไขเช็คว่าเวลาเริ่มต้นหรือสิ้นสุดตรงกันพอดีหรือไม่
            ->orWhere('st_start', $request->sbj_start)
            ->orWhere('st_end', $request->sbj_end);
        })
        ->exists(); // Check if any records exist that match these conditions

    if ($duplicate) {
        // If a duplicate exists, redirect back with an error message
        return redirect()->back()->withErrors(['duplicate' => 'ไม่สามารถใช้ห้องซ้ำในช่วงเวลานี้ได้เนื่องจากมีการลงทะเบียนแล้ว']);
    }

    // If no duplicates, proceed to insert the data
    $data = array();
    $data["st_room"] = $request->crs_room;
    $data["st_Number_of_students"] = $request->crs_Number_of_students;
    $data["st_day"] = $request->sbj_day;
    $data["st_start"] = $request->sbj_start;
    $data["st_end"] = $request->sbj_end;
    $data["st_subjects"] = $request->sbj_name;
    $data["st_teacher_name"] = $request->sbj_teacher_name;

    // Use the Query Builder to insert the data
    DB::table('status_build2')->insert($data);

    // Redirect back to the 'build23' route with a success message
    return redirect()->route('build2')->with('success', "อัพเดตข้อมูลเรียบร้อย");
}
}
