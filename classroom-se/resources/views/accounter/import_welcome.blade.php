@extends('accounter.import_layout')
@section('title', 'หน้าแรก')
@section('content')
    <a>หลักสูตรที่จะ Import</a>
    <span style="display: inline-block; margin-left: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <select dropdown="">
                        <option selected disabled>หลักสูตร</option>
                        @foreach ($dropdown as $row)
                            <option value="{{ $row->id }}">{{ $row->year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </span>
    <div></div><br>

    {{-- <form action="{{ route('importExcelCourse60') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="add">
                เพิ่มทีละ 1 ไฟล์
            </div>
            <input type="file" id="excelFileUpload" name="excelFile" accept=".xls, .xlsx" style="display: none;">
            <img src="{{ asset('asset/addfile.png') }}" alt="Upload File" id="uploadIcon">
            <span id="fileName"></span>

        </div>
        <button type="submit" class="btn btn-primary">บันทึกไฟล์</button>
    </form> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('importExcelCourse55') }}" enctype="multipart/form-data">
                        {{-- <form method="POST" action="{{ route('importExcelCourse55') }}" enctype="multipart/form-data"> --}}
                            @csrf
                            <div class="input-group">
                                <input type="file" name="import_file" class="form-control">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <script>
        document.getElementById('excelFileUpload').addEventListener('change', function() {
        var fileNameDisplay = document.getElementById('fileName');
        if (this.files.length > 0) {
            // Display the name of the first file selected
            fileNameDisplay.textContent = this.files[0].name;
        } else {
            // No file selected
            fileNameDisplay.textContent = "No file chosen";
        }
    });
    </script>
    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            หลักสูตรปี
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="/import_course55">หลักสูตรปี 55</a>
            <a class="dropdown-item" href="/import_course60">หลักสูตรปี 60</a>
            <a class="dropdown-item" href="/import_course65">หลักสูตรปี 65</a>
        </div>
    </div><br>
@endsection

