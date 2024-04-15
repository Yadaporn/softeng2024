@extends('accounter.import_layout')
@section('title')
@section('content')
<body>
    <div class="top">
        <div class="head">
            ห้องปฏิบัติการ
        </div>
        <div class="add">
            เพิ่มทีละ 1 ห้อง
        </div>
        <form action="{{ route('add') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="crs_build">ตึก</label>
                <input type="text" class="form-control" name="crs_build">
            </div>
            @error('crs_build')
                <div class="my-2">
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror
            <div class="form-group">
                <label for="crs_room">ห้อง</label>
                <input type="text" class="form-control" name="crs_room">
            </div>
            @error('crs_room')
                <div class="my-2">
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror
            <div class="form-group">
                <label for="crs_Number_of_students">จำนวนนิสิต</label>
                <input type="number" class="form-control" name="crs_Number_of_students">
            </div>
            @error('crs_Number_of_students')
                <div class="my-2">
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror
            <br>
            <input type="submit" value="บันทึก" class="btn btn-primary">
        </form>
        <!-- Add this inside your <body> tag, potentially next to the existing form -->
        <form action="{{ route('uploadExcel') }}" method="post" enctype="multipart/form-data">
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
        </form>
        <script>
document.getElementById('uploadIcon').addEventListener('click', function() {
    document.getElementById('excelFileUpload').click();
});

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







        <script>
            function toggleDropdown() {
                var dropdownMenu = document.getElementById("dropdownMenu");
                dropdownMenu.classList.toggle("show");
            }
        </script>
    </div>
</body>
@endsection
