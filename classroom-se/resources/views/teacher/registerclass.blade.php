@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<?php
session_start();
?>

<script>
    $(document).ready(function(){
        $('#sbj_course').change(function(){
            var selectedCourse = $(this).val();
            if(selectedCourse){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-sbj-names')}}?sbj_course="+selectedCourse,
                    success:function(res){
                        if(res){
                            $("#sbj_name").empty();
                            $.each(res,function(key,value){
                                $("#sbj_name").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#sbj_name").empty();
                        }
                    }
                });
            }else{
                $("#sbj_name").empty();
            }
        });
    });
</script>


{{--
    <?php
    // เริ่ม Session หรือใช้การตรวจสอบการเข้าสู่ระบบตามวิธีที่คุณใช้
    session_start();

    // ตรวจสอบว่ามีชื่อของอาจารย์ที่เข้าสู่ระบบอยู่ใน Session หรือไม่
    if(isset($_SESSION['teacher_name'])) {
        $teacher_name = $_SESSION['teacher_name'];
        // นำชื่อของอาจารย์ไปใช้ในการแสดงผลในฟอร์ม
    }
    ?>
--}}

@extends('teacher.layout')
@section('title', 'ลงทะเบียนรายวิชาที่จะเปิดสอน')
@section('content') 
<body>
    <div class="container py-2">
        <?php
        if(isset($_SESSION['status']))
        {
            echo "<h4>".$_SESSION['status']."</h4>";
            unset($_SSESSION['status']);
        }
        ?>
        
        <form method="POST" action="/insert1">
            @csrf 
            <h2>ลงทะเบียนรายวิชาที่จะเปิดสอน</h2>

            
            {{--Import จาก Database--}}
            <label for="sbj_course">หลักสูตร</label>
                <select name="sbj_course" id="sbj_course">
                    <option value="" selected disabled>เลือกหลักสูตร</option>
                    @foreach ($data as $row)
                        <option value="{{ $row->year }}">{{ $row->year }}</option>
                    @endforeach
                </select>
            
            {{--
            <label class="ms-3" for="sbj_year">หลักสูตร</label>
            <select name="sbj_course">
                <option>2555</option>
                <option>2560</option>
                <option>2565</option>
            </select>
            --}}

            <label class="ms-3" for="sbj_year">ปีการศึกษา</label>
            <select name="sbj_year">
                <option value="" selected disabled>เลือกปีการศึกษา</option>
                <option>2563</option>
                <option>2564</option>
                <option>2565</option>
                <option>2566</option>
            </select>
        
            <label class="ms-3" for="sbj_semester">ภาคการศึกษา</label>
            <select name="sbj_semester">
                <option value="" selected disabled>เลือกภาคการศึกษา</option>
                <option>ภาคต้น</option>
                <option>ภาคปลาย</option>
            </select>

            <br>
            <br>
            <label for="course_name">รหัสวิชา/ชื่อ</label>
            <select name="course_name" id="course_name">
            </select>




            <label class="ms-3" for="sbj_number_of_students">จำนวนนิสิต</label>
            <input type="text" name="sbj_number_of_students" placeholder="จำนวนนิสิต"> 
            <br>

            <br>
            <label class="ms-3" for="sbj_day">วัน</label>
            <select name="sbj_day">
                <option value="" selected disabled>เลือกวัน</option>
                <option>จันทร์</option>
                <option>อังคาร</option>
                <option>พุธ</option>
                <option>พฤหัสบดี</option>
                <option>ศุกร์</option>
                <option>เสาร์</option>
                <option>อาทิตย์</option>
            </select>

            <label class="ms-3" for="sbj_start">เวลาเริ่ม</label>
            <select name="sbj_start">
                <option value="" selected disabled>เลือกเวลาเริ่ม</option>
                <option>8:00</option>
                <option>8:30</option>
                <option>9:00</option>
                <option>9:30</option>
                <option>10:00</option>
                <option>10:30</option>
                <option>11:00</option>
                <option>11:30</option>
                <option>12:00</option>
                <option>12:30</option>
                <option>13:00</option>
                <option>13:30</option>
                <option>14:00</option>
                <option>14:30</option>
                <option>15:00</option>
                <option>15:30</option>
                <option>16:00</option>
                <option>16:30</option>
                <option>17:00</option>
                <option>17:30</option>
                <option>18:00</option>
                <option>18:30</option>
                <option>19:00</option>
                <option>19:30</option>
            </select>

            <label class="ms-3" for="sbj_end">เวลาสิ้นสุด</label>
            <select name="sbj_end">
                <option value="" selected disabled>เลือกเวลาสิ้นสุด</option>
                <option>8:00</option>
                <option>8:30</option>
                <option>9:00</option>
                <option>9:30</option>
                <option>10:00</option>
                <option>10:30</option>
                <option>11:00</option>
                <option>11:30</option>
                <option>12:00</option>
                <option>12:30</option>
                <option>13:00</option>
                <option>13:30</option>
                <option>14:00</option>
                <option>14:30</option>
                <option>15:00</option>
                <option>15:30</option>
                <option>16:00</option>
                <option>16:30</option>
                <option>17:00</option>
                <option>17:30</option>
                <option>18:00</option>
                <option>18:30</option>
                <option>19:00</option>
                <option>19:30</option>
            </select>

            
            <label class="ms-3" for="sbj_sec">หมู่เรียน</label>
            <select name="sbj_sec">
                <option value="" selected disabled>เลือกหมู่เรียน</option>
                <option>800</option>
                <option>801</option>
                <option>802</option>
                <option>803</option>
                <option>830</option>
                <option>831</option>
                <option>832</option>
                <option>833</option>
            </select>
            <br>
            <br>
        
                <label class="ms-3" for="sbj_major ">สาขา/ชั้นปี</label>
                <form method="post" id="multiple_select_form">
                    <div style="width: 20%">
                    <select name="sbj_major[]" id="sbj_major" class="form-control selectpicker" data-live-search="true" multiple>
                        <option value="" selected disabled>เลือกสาขา/ชั้นปี</option>
                        <option value="T12 (1)">T12 (1)</option>
                        <option value="T12 (2)">T12 (2)</option>
                        <option value="T12 (3)">T12 (3)</option>
                        <option value="T12 (4)">T12 (4)</option>
                        <option value="T12 (5+)">T12 (5+)</option>
                        <option value="T13 (1)">T13 (1)</option>
                        <option value="T13 (2)">T13 (2)</option>
                        <option value="T13 (3)">T13 (3)</option>
                        <option value="T13 (4)">T13 (4)</option>
                        <option value="T13 (5+)">T13 (5+)</option>
                        <option value="T14 (1)">T14 (1)</option>
                        <option value="T14 (2)">T14 (2)</option>
                        <option value="T14 (3)">T14 (3)</option>
                        <option value="T14 (4)">T14 (4)</option>
                        <option value="T14 (5+)">T14 (5+)</option>
                        <option value="T17 (1)">T17 (1)</option>
                        <option value="T17 (2)">T17 (2)</option>
                        <option value="T17 (3)">T17 (3)</option>
                        <option value="T17 (4)">T17 (4)</option>
                        <option value="T17 (5+)">T17 (5+)</option>
                        <option value="T18 (1)">T18 (1)</option>
                        <option value="T18 (2)">T18 (2)</option>
                        <option value="T18 (3)">T18 (3)</option>
                        <option value="T18 (4)">T18 (4)</option>
                        <option value="T18 (5+)">T18 (5+)</option>
                        <option value="T19 (1)">T19 (1)</option>
                        <option value="T19 (2)">T19 (2)</option>
                        <option value="T19 (3)">T19 (3)</option>
                        <option value="T19 (4)">T19 (4)</option>
                        <option value="T19 (5+)">T19 (5+)</option>
                        <option value="T20 (1)">T20 (1)</option>
                        <option value="T20 (2)">T20 (2)</option>
                        <option value="T20 (3)">T20 (3)</option>
                        <option value="T20 (4)">T20 (4)</option>
                        <option value="T20 (5+)">T20 (5+)</option>
                        <option value="T22 (1)">T22 (1)</option>
                        <option value="T22 (2)">T22 (2)</option>
                        <option value="T22 (3)">T22 (3)</option>
                        <option value="T22 (4)">T22 (4)</option>
                        <option value="T22 (5+)">T22 (5+)</option>
                        <option value="T23 (1)">T23 (1)</option>
                        <option value="T23 (2)">T23 (2)</option>
                        <option value="T23 (3)">T23 (3)</option>
                        <option value="T23 (34)">T23 (4)</option>
                        <option value="T23 (5+)">T23 (5+)</option>
                    </select>
                </form>
            <br>
            <br>
            {{--
            <label class="ms-3" for="sbj_teacher_name">อาจารย์ผู้สอน</label>
            <input type="text" name="sbj_teacher_name" placeholder="ชื่ออาจารย์">
            --}}
        
            <label for="sbj_teacher_name">อาจารย์ผู้สอน</label>
                <select name="sbj_teacher_name" id="sbj_teacher_name" class="form-select">
                    <option value="">เลือกอาจารย์ผู้สอน</option>
                    @foreach ($data3 as $item)
                        <option value="{{ $item->info_name }}">{{ $item->info_name }}</option>
                    @endforeach
                </select>
{{--
                <label for="sbj_course">หลักสูตร</label>
                <select name="sbj_course" id="sbj_course">
                    <option value="">เลือกหลักสูตร</option>
                    <option value="2555">2555</option>
                    <option value="2560">2560</option>
                    <option value="2565">2565</option>
                </select>

                <label for="sbj_name">ชื่อ/รหัสวิชา</label>
                <select name="sbj_name" id="sbj_name">
                </select>
--}}



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#sbj_course').change(function(){
            var selectedCourse = $(this).val();
            if(selectedCourse){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-sbj-names')}}?sbj_course="+selectedCourse,
                    success:function(res){
                        if(res){
                            $("#sbj_name").empty();
                            $.each(res,function(key,value){
                                // เพิ่มเฉพาะชื่อวิชา
                                $("#sbj_name").append('<option value="'+ value +'">'+ value +'</option>');
                            });
                        }else{
                            $("#sbj_name").empty();
                        }
                    }
                });
            }else{
                $("#sbj_name").empty();
            }
        });
    });
</script>




                
        

            <br>
            <br>
                    <div class="form-group mb-3">
                        <button type="submit" name="save_multiple_checkbox" class="btn btn-success btn-sm ms-4">ยืนยัน</button> <br>
                    </div>
                </div>
            </div>
            

    
    
            

</body>
@endsection