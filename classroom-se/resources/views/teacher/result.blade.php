@extends('teacher.layout')
@section('title', 'ผลการลงทะเบียนรายวิชาที่เปิดสอน')
@section('content') 
    <h1>ผลการลงทะเบียนรายวิชาที่เปิดสอน</h1>
    <table class="table table-bordered border-black table-active text-center">
        <thead>
            <tr>
                {{--<th scope="col">ลำดับ</th>--}}
                <th scope="col">รหัสวิชา/ชื่อวิชา</th>
                {{--<th scope="col">ชื่อวิชา</th>--}}
                {{--<th scope="col">หน่วยกิต</th>--}}
                <th scope="col">หมู่</th>
                <th scope="col">วัน</th>
                <th scope="col">เวลาเริ่ม</th>
                <th scope="col">เวลาสิ้นสุด</th>
                {{--<th scope="col">ห้อง</th>--}}
                <th scope="col">สาขา-ชั้นปี</th>
                <th scope="col">จำนวนนิสิต</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $item)
                <tr>
                    {{-- <td>{{ $item->id }}</td>
                    <td>{{ $item->subject_code }}</td>--}}
                    <td>{{ $item->sbj_name }}</td>
                    {{--<td>{{ $item->unit }}</td>--}}
                    <td>{{ $item->sbj_sec }}</td>
                    <td>{{ $item->sbj_day }}</td>
                    <td>{{ $item->sbj_start }}</td>
                    <td>{{ $item->sbj_end }}</td>
                    {{--<td>{{ $item->st_room }}</td>--}}
                    <td>{{ $item->sbj_major }}</td>
                    <td>{{ $item->sbj_number_of_students }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>  
   
    <a href="/editresult" class="btn btn-warning text-black" style="float:right;">
        <right>แก้ไข</right>
    </a>
    <a href="/registerclass"class="btn btn-light text-black ms-auto " style="float:right;">เพิ่มรายวิชา</a>

 @endsection
