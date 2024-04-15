@extends('admin.Info_layout')
@section('title', 'แก้ไขข้อมูล')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <form method="POST" action="/insert" class=""> --}}
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

    <form id="myForm" method="POST" action="{{ route('Info_update', $member->info_id) }}">
        @csrf
        <div>
            <label for="info_email">อีเมล</label>
            <input type="text" name="info_email" id="info_email" value="{{ $member->info_email }}"><br>
        </div>
        @error('info_email')
            <div>
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="info_name">ชื่อ - สกุล</label>
            <input type="text" name="info_name" id="info_name" value="{{ $member->info_name }}">
        </div>
        @error('info_name')
            <div>
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        <div>
            <label for="info_duty">หน้าที่</label>
            <input type="text" name="info_duty" id="info_duty" value="{{ $member->info_duty }}">
        </div>
        @if ($errors->has('info_duty'))
            <div>
                <span class="text-danger">{{ $errors->first('info_duty') }}</span>
            </div>
        @endif
        {{-- @error('info_duty')
            <div>
                <span class="info_text-danger">{{ $message }}</span>
            </div>
        @enderror --}}

        {{-- <input type="submit" value="อัปเดต" class="btn btn-success" style="float:right;" onclick="confirmUpdate()"> --}}
        {{-- <button type="submit" class="btn btn-success" style="float:right;" onclick="confirmUpdate()">อัปเดต</button> --}}
        <button type="button" onclick="submitForm()" class="btn btn-success" style="float:right;">อัปเดต</button>
    </form>
    <script>
        function submitForm() {
            var info_email = document.getElementById('info_email').value;
            var info_name = document.getElementById('info_name').value;
            var info_duty = document.getElementById('info_duty').value;

            if (info_email === "" || info_name === "" || info_duty === "") {
                Swal.fire({
                    title: "กรุณากรอกข้อมูลผู้ใช้ให้ครบถ้วน",
                    icon: "warning",
                    iconColor: "#ffc107",
                    showConfirmButton: false // ไม่แสดงปุ่มตกลง
                });
            } else if (info_duty.length > 12) {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    text: "หน้าที่ต้องมีความยาวไม่เกิน 12 ตัวอักษร",
                    icon: "error",
                    iconColor: "#dc3545",
                    showConfirmButton: false // ไม่แสดงปุ่มตกลง
                });
            } else if (info_duty.toLowerCase() === "admin") { // แก้ไขตรวจสอบเป็น "admin" โดยใช้ toLowerCase()
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    text: "หน้าที่นี้ถูกบันทึกแล้ว กรุณาเลือกหน้าที่อื่น",
                    icon: "error",
                    iconColor: "#dc3545",
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
        // function submitForm() {
        //     var email = document.getElementById('email').value;
        //     var name = document.getElementById('name').value;
        //     var duty = document.getElementById('duty').value;

        //     if (email === "" || name === "" || duty === "") {
        //         Swal.fire({
        //             title: "กรุณากรอกข้อมูลผู้ใช้ให้ครบถ้วน",
        //             icon: "warning",
        //             iconColor: "#ffc107",
        //             showConfirmButton: false // ไม่แสดงปุ่มตกลง
        //         });
        //     } else {
        //         Swal.fire({
        //             title: "บันทึกข้อมูลเรียบร้อย",
        //             icon: "success",
        //             iconColor: "#28a745",
        //             showConfirmButton: false // ไม่แสดงปุ่มตกลง
        //         });
        //         document.getElementById("myForm").submit();
        //     }
        // }
    </script>



    {{-- <script>
        function confirmUpdate() {
            // แสดง Alert ด้วย Swal.fire()
            Swal.fire({
                title: "อัปเดตข้อมูลเรียบร้อย",
                icon: "success",
                iconColor: "#28a745",
                showConfirmButton: false // ไม่แสดงปุ่มตกลง
            });
        }
    </script> --}}
@endsection
