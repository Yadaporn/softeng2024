@extends('accounter.import_layout')
@section('title', 'เพิ่มรายวิชา')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <h2 class="text-center py-2"> เพิ่มรายวิชา </h2>
    <form id="myForm" method="POST" action="/import_insert60">
        @csrf
        <div class="form-group">
            <label for="idr">รหัสวิชา</label>
            <input type="text" name="idr" id="idr" class="form-control">
        </div>
        @error('idr')
            <div class="my -2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="code">รหัสวิชา-ปีหลักสูตร</label>
            <input type="text" name="code" id="code"class="form-control">
        </div>
        @error('code')
            <div class="my -2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="name">ชื่อวิชา</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        @error('name')
            <div class="my -2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="lec">บรรยาย</label>
            <input type="text" name="lec" id="lec" class="form-control">
        </div>
        @error('lec')
            <div class="my -2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="lab">ปฏิบัติ</label>
            <input type="text" name="lab" id="lab" class="form-control">
        </div>
        @error('lab')
            <div class="my -2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="year">หลักสูตร</label>
            <input type="text" name="year" id="year" class="form-control">
        </div>
        @error('year')
            <div class="my -2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <button type="submit" onclick="submitForm()" class="btn btn-primary text-black my-3">บันทึก</button>
        <a href="/import_course60" class="btn btn-success text-black">รายวิชาทั้งหมด</a>
    </form>

    <script>
        function submitForm() {
            var idr = document.getElementById('idr').value;
            var code = document.getElementById('code').value;
            var name = document.getElementById('name').value;
            var lec = document.getElementById('lec').value;
            var lab = document.getElementById('lab').value;
            var year = document.getElementById('year').value;

            if (idr === "" || code === "" || name === ""|| lec === ""|| lab === ""|| year === "") {
                Swal.fire({
                    title: "กรุณากรอกข้อมูลผู้ใช้ให้ครบถ้วน",
                    icon: "warning",
                    iconColor: "#ffc107",
                    showConfirmButton: false // ไม่แสดงปุ่มตกลง
                });
            } else {
                Swal.fire({
                    title: "บันทึกข้อมูลเรียบร้อย",
                    icon: "success",
                    iconColor: "#28a745",
                    showConfirmButton: false // ไม่แสดงปุ่มตกลง
                });
                document.getElementById("myForm").submit();
            }
        }
    </script>
@endsection
