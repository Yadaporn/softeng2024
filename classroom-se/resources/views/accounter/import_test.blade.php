@extends('accounter.layout')
@section('title')
    Admin
@endsection
@section('content')
    <style>
        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 20px;
            font-size: 25px;
        }

        input[type="text"] {
            width: 400px;
            padding: 5px;
            border: 2px solid #ccc;
            border-radius: 12px;
            box-sizing: border-box;
            margin-bottom: 1px;
            font-size: 20px;
            background-color: #f1f1f1;
        }
    </style>

    <form method="POST" action="/insert">
        @csrf
        <div>
            <label for="course_idr">อีเมล</label>
            <input type="text" name="course_idr" ><br>
        </div>
        @error('course_idr')
            <div>
                <span class="text-danger">{{$message}}</span>
            </div>
        @enderror
        <div>
            <label for="course_code">ชื่อ - สกุล</label>
            <input type="text" name="course_code">
        </div>
        @error('course_code')
            <div>
                <span class="text-danger">{{$message}}</span>
            </div>
        @enderror
        <div>
            <label for="course_name">รหัส</label>
            <input type="text" name="course_name">
        </div>
        @error('course_name')
            <div>
                <span class="text-danger">{{$message}}</span>
            </div>
        @enderror
        <input type="submit" value="บันทึก" class="btn btn-success" style="float:right;">

    </form>
@endsection
