@extends('teacher.layout')
@section('title', 'ห้องปฏิบัติการ')
@section('content') 
<body>
    <div class="top">
    <div class="head">
        ลงทะเบียนการขอใช้ห้องในการสอน
    </div>
    <div class="text-build">
        <a>ตึก 23</a>
        <a>ตึก 15</a>
        <a>ตึก 2</a>
    </div> 
    </div>
    <button onclick="window.location.href = 'build23';" class="b1-btn"></button><button onclick="window.location.href = 'build15';" class="b2-btn"></button><button onclick="window.location.href = 'build2';" class="b3-btn"></button>

    </body>
    @endsection