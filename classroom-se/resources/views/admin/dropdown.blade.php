@extends('admin.Info_layout')
@section('title')
    Admin
@endsection
{{-- <select name="" >
    @foreach ($data as $row)
    <option value="{{$row->id}}">{{$row->name}}</option>
    @endforeach
</select> --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <select classroom="">
                    <option selected disabled>หลักสูตร</option>
                    @foreach ($data as $row)
                    <option value="{{$row->id}}">{{$row->classroom}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endsection
