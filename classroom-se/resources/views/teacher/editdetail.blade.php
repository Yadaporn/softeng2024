@extends('teacher.layout')
@section('title', 'แก้ไขรายละเอียดวิชาที่ลงทะเบียนเปิดสอน')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <h1>แก้ไขรายละเอียดวิชาที่ลงทะเบียนเปิดสอน</h1>
    <form id='myForm' method="POST" action="{{ route('update_detail', $subjects->sbj_id) }}">
        @csrf
        <div class="form-group">
            <h3>{{--{{ $subjects->sbj_code }}--}} {{ $subjects->sbj_name }} หมู่ {{ $subjects->sbj_sec }}</h3>
            {{-- for="subject_code,subject_name" --}}

            <br>
            <div>
                <label for="sbj_day">วัน</label>
                <select name="sbj_day">
                    <option>{{ $subjects->sbj_day }}</option>
                    <option>จันทร์</option>
                    <option>อังคาร</option>
                    <option>พุธ</option>
                    <option>พฤหัสบดี</option>
                    <option>ศุกร์</option>
                    <option>เสาร์</option>
                    <option>อาทิตย์</option>
                </select>


                <label for="sbj_start">เวลาเริ่ม</label>
                <select name="sbj_start">
                    <option>{{ $subjects->sbj_start }}</option>
                    <option>08:00</option>
                    <option>08:30</option>
                    <option>09:00</option>
                    <option>09:30</option>
                    <option>10:00</option>
                    <option>10:30</option>
                    <option>11:00</option>
                    <option>11:30</option>
                    <option>12:00</option>
                    <option>12:30</option>
                    <option>13:00</option>
                    <option>13:30</option>
                    <option>14:00</option>
                    <option>14:30</option>
                    <option>15:00</option>
                    <option>15:30</option>
                    <option>16:00</option>
                    <option>16:30</option>
                    <option>17:00</option>
                    <option>17:30</option>
                    <option>18:00</option>
                    <option>18:30</option>
                    <option>19:00</option>
                    <option>19:30</option>
                </select>


                <label for="sbj_end">เวลาสิ้นสุด</label>
                <select name="sbj_end">
                    <option>{{ $subjects->sbj_end }}</option>
                    <option>08:00</option>
                    <option>08:30</option>
                    <option>09:00</option>
                    <option>09:30</option>
                    <option>10:00</option>
                    <option>10:30</option>
                    <option>11:00</option>
                    <option>11:30</option>
                    <option>12:00</option>
                    <option>12:30</option>
                    <option>13:00</option>
                    <option>13:30</option>
                    <option>14:00</option>
                    <option>14:30</option>
                    <option>15:00</option>
                    <option>15:30</option>
                    <option>16:00</option>
                    <option>16:30</option>
                    <option>17:00</option>
                    <option>17:30</option>
                    <option>18:00</option>
                    <option>18:30</option>
                    <option>19:00</option>
                    <option>19:30</option>
                </select>
            </div>

            <br>
            <div>
                <label for="sbj_number_of_students">จำนวนนิสิต</label>
                <input type="text" name="sbj_number_of_students" id="sbj_number_of_students" value="{{ $subjects->sbj_number_of_students }}">
            </div>
            @error('sbj_number_of_students')
                <div class="my-2">
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <br>
                <div>
                    <label for="sbj_major">สาขา-ชั้นปี</label>
                    <input type="text" name="sbj_major" id="sbj_major" class="form-control" value="{{ $subjects->sbj_major }}">
                </div>
                @error('sbj_major')
                    <div class="my-2">
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <br>
                    <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary text-white"
                        onclick="return submitForm()">
                        {{--<button type="button" onclick="submitForm()" class="btn btn-primary">บันทึกข้อมูล</button>--}}
                </div>

                {{-- <a href="/editresult" class="btn btn-success text-white" style="float:right;">ยืนยัน</a> --}}

    </form>
    <script>
        function submitForm() {
            var sbj_number_of_students = document.getElementById('sbj_number_of_students').value;
            var sbj_major = document.getElementById('sbj_major').value;
        
            if (sbj_number_of_students === "" || sbj_major === "") {
                Swal.fire({
                    title: "กรุณากรอกข้อมูลให้ครบถ้วน",
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
