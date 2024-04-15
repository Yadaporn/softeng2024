@extends('accounter.import_layout')
@section('title', 'DropdownTest')
@section('content')
    
    <a>หลักสูตรที่จะ Import</a>
    <span style="width: 10px; display: inline-block;"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <select dropdowns="">
                    <option selected disabled>หลักสูตร</option>
                    @foreach ($dropdown as $row)
                        <option value="{{ $row->id }}">{{ $row->year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
@endsection
