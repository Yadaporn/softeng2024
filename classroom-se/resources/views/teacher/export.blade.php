

@extends('teacher.layout')
@section('title', 'ผลการลงทะเบียนรายวิชาที่เปิดสอน')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>ตรวจสอบผลการลงทะเบียน</h1>
        <a href="{{ route('export.pdf') }}" class="btn btn-success btn-sm ms-4">Export PDF</a>
    </div>
    <table class="table table-bordered border-black table-active text-center" id="export-table">
        <thead>
            <tr>
                <th scope="col">รหัสวิชา/ชื่อ</th>
                <th scope="col">หมู่</th>
                <th scope="col">วัน</th>
                <th scope="col">เวลาเริ่ม</th>
                <th scope="col">เวลาสิ้นสุด</th>
                <th scope="col">สาขา-ชั้นปี</th>
                <th scope="col">จำนวนนิสิต</th>
                <th scope="col">อาจารย์</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $item)
                <tr>
                    <td>{{ $item->sbj_name }}</td>
                    <td>{{ $item->sbj_sec }}</td>
                    <td>{{ $item->sbj_day }}</td>
                    <td>{{ $item->sbj_start }}</td>
                    <td>{{ $item->sbj_end }}</td>
                    <td>{{ $item->sbj_major }}</td>
                    <td>{{ $item->sbj_number_of_students }}</td>
                    <td>{{ $item->sbj_teacher_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
