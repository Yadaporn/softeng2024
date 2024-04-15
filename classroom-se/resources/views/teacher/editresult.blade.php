@extends('teacher.layout')
@section('title', 'แก้ไขผลการลงทะเบียนรายวิชาที่เปิดสอน')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <h1>แก้ไขผลการลงทะเบียนรายวิชาที่เปิดสอน</h1>
    <table class="table table-bordered border-black table-active text-center">
        <thead>
            <tr>
                {{--<th scope="col">ลำดับ</th>--}}
                <th scope="col">รหัสวิชา/ชื่อวิชา</th>
                {{--<th scope="col">ชื่อวิชา</th>--}}
                {{--<th scope="col">หน่วยกิต</th>--}}
                <th scope="col">หมู่</th>
                <th scope="col">วัน</th>
                <th scope="col">เวลาเริ่ม</th>
                <th scope="col">เวลาสิ้นสุด</th>
                {{--<th scope="col">ห้อง</th>--}}
                <th scope="col">สาขา-ชั้นปี</th>
                <th scope="col">จำนวนนิสิต</th>
                <th scope="col">แก้ไข</th>
                <th scope="col">ลบ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $item)
                <tr>
                    {{-- <td>{{ $item->id }}</td>
                    <td>{{ $item->subject_code }}</td> --}}
                    <td>{{ $item->sbj_name }}</td>
                    {{--<td>{{ $item->unit }}</td>--}}
                    <td>{{ $item->sbj_sec }}</td>
                    <td>{{ $item->sbj_day }}</td>
                    <td>{{ $item->sbj_start }}</td>
                    <td>{{ $item->sbj_end }}</td>
                    {{--<td>{{ $item->room }}</td>--}}
                    <td>{{ $item->sbj_major }}</td>
                    <td>{{ $item->sbj_number_of_students }}</td>
                    <td><a href="{{ route('edit_detail', $item->sbj_id) }}" class="btn btn-warning btn-sm text-black">แก้ไข</a>
                    </td>
                    <td><a href="{{ route('delete_subject', $item->sbj_id) }}" class="btn btn-danger btn-sm text-black"
                            onclick="return confirmation(event,'คุณต้องการลบรายวิชา {{ $item->sbj_name }} หมู่ {{ $item->sbj_sec }} หรือไม่ ?')">
                            ลบ
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/" class="btn btn-success text-white" style="float:right;" onclick="return confirm()">ยืนยัน</a>

    <script>
        function confirm() {
            // แสดง Alert ด้วย Swal.fire()
            Swal.fire({
                title: "แก้ไขข้อมูลสำเร็จ",
                icon: "success",
                iconColor: "#28a745",
                showConfirmButton: false // ไม่แสดงปุ่มตกลง
            });
        }
    </script>

    <script type="text/javascript">
        function confirmation(event,customMessage) {
            event.preventDefault();

            var urlToRedirect = event.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            Swal.fire({
                title:customMessage|| "คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่ ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "ลบข้อมูลเรียบร้อย",
                        icon: "success"
                    });
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
@endsection
