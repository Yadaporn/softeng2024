<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Infocontroller;
use App\Http\Controllers\PjController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ManageController;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('addroom', function () {
    return view('accounter.addroom');
});

// Route::get('upload', function () {
//     return view('upload');
// });

Route::get('/editroom/{crs_id}', [ClassroomController::class, 'editroom'])->name('editroom');
Route::post('/update/{crs_id}', [ClassroomController::class, 'updateroom'])->name('update');
Route::post('/upload/add',[ClassroomController::class,'storeroom'])->name('add');
Route::delete('/ลบห้อง/{crs_id}', [ClassroomController::class, 'deleteMethodroom'])->name('ลบห้อง');
Route::post('/upload-excel', [ClassroomController::class, 'importExcelroom'])->name('uploadExcel');
Route::get('/get_students_count/{room}', [ClassroomController::class, 'getStudentsroom']);
Route::get('/get_students_count/{room}', [ClassroomController::class, 'getStudentsroom'])->middleware('auth');
Route::get('/get_students_count/{room}', [ClassroomController::class, 'getStudentsCount'])
    ->middleware('auth');
Route::get('/subjects-form', [ClassroomController::class, 'showSubjectsFormroom'])->name('subjects.form');
Route::get('/show-subjects-form/{sbj_id}', 'ClassroomController@showSubjectsFormroom');
Route::get('/some-path/{sbj_id}', 'ClassroomController@showSubjectsFormroom');

// Route to handle the form submission and update the entity
Route::put('/items/{csr_id}', 'ItemController@update')->name('items.update');

Route::get('room-status', function () {
    return view('accounter.room-status');
})->name('สถานะ');

Route::get('choosebuild', function () {
    return view('teacher.choosebuild');
});

Route::get('build23', function () {
    return view('teacher.build23');
})->name('build23');

Route::get('build15', function () {
    return view('teacher.build15');
})->name('build15');

Route::get('build2', function () {
    return view('teacher.build2');
})->name('build2');

Route::get('statusbuild23', function () {
    return view('teacher.statusbuild23');
})->name('statusbuild23');

Route::get('statusbuild23name', function () {
    return view('teacher.statusbuild23name');
})->name('statusbuild23name');


Route::get('statusbuild15', function () {
    return view('teacher.statusbuild15');
})->name('statusbuild15');

Route::get('statusbuild15name', function () {
    return view('teacher.statusbuild15name');
})->name('statusbuild15name');

Route::get('statusbuild2', function () {
    return view('teacher.statusbuild2');
})->name('statusbuild2');

Route::get('statusbuild2name', function () {
    return view('teacher.statusbuild2name');
})->name('statusbuild2name');

Route::post('/classrooms/addst23',[ClassroomController::class,'storeroom23'])->name('classroom.add');
Route::post('/classrooms/addst15',[ClassroomController::class,'storeroom15'])->name('classroom.addd');
Route::post('/classrooms/addst2',[ClassroomController::class,'storeroom2'])->name('classroom.adddd');


Route::get('sand', function () {
    return view('sand');
});




//parm
Route::get('/test', function () {
    return view('test');
});

Route::get('/',[Infocontroller::class,'Info_index']);

Route::get('Info_blog',[Infocontroller::class,'Info_index'])->name('Info_blog');
Route::get('Info_create',[Infocontroller::class,'Info_create']);
Route::post('Info_insert',[Infocontroller::class,'Info_insert']);
Route::get('Info_delete/{id}',[Infocontroller::class,'Info_delete'])->name('Info_delete');
Route::get('Info_edit/{id}',[Infocontroller::class,'Info_edit'])->name('Info_edit');
Route::post('Info_update/{id}',[Infocontroller::class,'Info_update'])->name('Info_update');

// Route::get('/test',[Infocontroller::class,'test']);

// Route::get('/',[HomeController::class,'index']);
// Route::get('dropdown',[HomeController::class,'index'])->name('dropdown');

//champ
Route::get('result' , [PjController::class,'result_index']);

Route::get('editresult' , [PjController::class,'edit_result'])->name('edit_result');

Route::get('delete_subject/{id}', [PjController::class,'delete_subject'])->name('delete_subject');

// Route::get('editdetail' , [PjController::class,'edit_detail'])->name('edit_detail');

Route::post('update_detail/{id}' , [PjController::class,'update_detail'])->name('update_detail');

Route::get('edit_detail/{sbj_id}', [PjController::class, 'edit_detail'])->name('edit_detail');

//new
Route::get('/registerclass', [AdminController::class, 'sbj_index','getSbjNames']);
Route::post('/insert1',[AdminController::class,'sbj_insert']);
Route::get('/export' , [AdminController::class,'result_index']);
Route::get('/get-sbj-names', [AdminController::class, 'getSbjNames']); 
Route::get('/export-pdf', [AdminController::class, 'exportPDF'])->name('export.pdf');



//bew
Route::get('import_course60',[ImportController::class,'import_index60'])->name('course60');
Route::get('import_course55',[ImportController::class,'import_index55'])->name('course55');
Route::get('import_course65',[ImportController::class,'import_index65'])->name('course65');
// Route::get('cours',[AdminController::class,'index']);

// Route::get('/import', function () {
//     return view('import');
// });
// Route::get('/',[ImportController::class,'import_dropdown']);
Route::post('/import_course55',[ImportController::class,'importExcelCourse55'])->name('importExcelCourse55');

Route::get('import_delete60/{id}',[ImportController::class,'import_delete60'])->name('import_delete60');
Route::get('import_delete55/{id}',[ImportController::class,'import_delete55'])->name('import_delete55');
Route::get('import_delete65/{id}',[ImportController::class,'import_delete65'])->name('import_delete65');

Route::get('import_change/{id}',[ImportController::class,'import_change'])->name('import_change');

Route::get('import_edit60/{id}',[ImportController::class,'import_edit60'])->name('import_edit60');
Route::get('import_edit55/{id}',[ImportController::class,'import_edit55'])->name('import_edit55');
Route::get('import_edit65/{id}',[ImportController::class,'import_edit65'])->name('import_edit65');

Route::get('import_create60',[ImportController::class,'import_create60']);
Route::get('import_create55',[ImportController::class,'import_create55']);
Route::get('import_create65',[ImportController::class,'import_create65']);

Route::post('import_insert60',[ImportController::class,'import_insert60']);
Route::post('import_insert55',[ImportController::class,'import_insert55']);
Route::post('import_insert65',[ImportController::class,'import_insert65']);


Route::post('import_update60/{id}',[ImportController::class,'import_update60'])->name('import_update60');
Route::post('import_update55/{id}',[ImportController::class,'import_update55'])->name('import_update55');
Route::post('import_update65/{id}',[ImportController::class,'import_update65'])->name('import_update65');

// Route::get('import_dropdown',[ImportController::class,'import_index2'])->name('import_dropdown');
//Route::get('cours',[ImportController::class,'index3']);
Route::get('/search',[ImportController::class,'import_search']);

Route::get('import_dropdown',[ImportController::class,'import_dropdown']);
Route::get('import_welcome', function () {
    return view('accounter.import_welcome');
});


//ploy
Route::get('tablelast',[ManageController::class,'Manage_index_table'])->name('tablelast');

Route::get('managesbj',[ManageController::class,'Manage_index'])->name('managesbj');
// Route::get('managessuccess',[ManageController::class,'Manage_index'])->name('managesbj');
Route::get('Manage_delete/{id}',[ManageController::class,'Manage_delete'])->name('Manage_delete');
// Route::get('Info_edit/{id}',[Infocontroller::class,'Info_edit'])->name('Info_edit');
// Route::post('Info_update/{id}',[Infocontroller::class,'Info_update'])->name('Info_update');
Route::post('managessuccess',[ManageController::class,'Manage_success'])->name('managesuccess');


//Ying
Route::get('/', function () {
    return view('index');
});


?>


