@extends('layout')
@section('title')
    Admin
@endsection
@section('content')
    <a class="bi bi-plus-circle-fill "style="float:right ; font-size: 3rem; color: rgb(0, 0, 0);" href="/Info_create"></a>
    <table class="table table-bordered text text-center table-secondary ">
        <thead>
            <tr>
                <th scope="col">อีเมล</th>
                <th scope="col">ชื่อ - นามสกุล</th>
                <th scope="col">หน้าที่</th>
                <th scope="col">แก้ไข</th>
                <th scope="col">ลบ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $item)
                <tr>
                    <td>{{ $item->info_email}}</td>
                    <td>{{ $item->info_name}}</td>
                    <td>{{ $item->info_duty}}</td>
                    <td><a 
                        href="{{route('Info_edit',$item->info_id)}}" 
                        class="btn btn-warning"
                        onclick="return confirm('คุณต้องการจะแก้ไขข้อมูลของ {{$item->info_name}} หรือไม่ ?')"
                        >แก้ไข
                    </a></td>
                    <td><a 
                        href="{{route('Info_delete',$item->info_id)}}" 
                        class="btn btn-danger"
                        onclick="return confirm('คุณต้องการจะลบข้อมูลของ {{$item->info_name}} หรือไม่ ?')"
                        >ลบ
                    </a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$blogs->links()}}
               
@endsection
