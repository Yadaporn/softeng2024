@extends('accounter.import_layout')
@section('content')
<div class="button-container" style="padding: 20px">
    <a href="/route-1" class="">สำเร็จ</a>
    <a href="/route-2" class="btn btn-yellow">รอพิจารณา</a>
</div>

    <table class="table table-bordered text text-center table-secondary ">
        <thead>
            <tr>
                <th scope="col">วัน/เวลา ที่รายวิชาชน</th>
                <th scope="col">ชื่อวิชา</th>
                <th scope="col">อาจารย์</th>
                <th scope="col">ยืนยัน</th>
                <th scope="col">ยกเลิก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sbjs as $item)
                <tr>
                    <td>{{ $item->sbj_day }} {{ $item->sbj_start }}-{{ $item->sbj_end }}</td>
                    <td>{{ $item->sbj_name }}</td>
                    <td>{{ $item->sbj_teacher_name }}</td>
                    <td>
                        <a href="{{ route('managesbj', $item->sbj_id) }}" class="btn btn-warning"
                            onclick="confirmation1(event, 'คุณต้องการจะยืนยันข้อมูลของ {{ $item->sbj_name }} หรือไม่ ?')">ยืนยัน</a>
                    </td>
                    {{-- <td><a href="{{ route('Info_edit', $item->info_id) }}" class="btn btn-warning"
                            onclick="return confirm('คุณต้องการจะแก้ไขข้อมูลของ {{ $item->info_name }} หรือไม่ ?')">แก้ไข
                        </a></td> --}}
                    {{-- <td><a href="{{ route('Info_edit', $item->info_id) }}" class="btn btn-warning"
                            onclick="confirmation1(event)">แก้ไข
                        </a></td> --}}
                    {{-- 
                        <script>
                        </script> --}}

                    <td>
                        <a href="{{ route('Manage_delete', $item->sbj_id) }}" class="btn btn-danger"
                            onclick="confirmation(event, 'คุณต้องการจะยกเลิกข้อมูลของ {{ $item->sbj_name }} หรือไม่ ?')">ยกเลิก
                        </a>
                    </td>
                    {{-- <td>
                        <a href="{{ route('Info_delete', $item->info_id) }}" class="btn btn-danger"
                            onclick="confirmSubmission()">ลบ
                        </a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    <script type="text/javascript">
        function confirmation(ev, customMessage) {
            event.preventDefault();

            var urlToRedirect = event.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            Swal.fire({
                title: customMessage || "คุณต้องการจะลบข้อมูลนี้ใช่หรือไม่ ?",
                icon: "warning",
                iconColor: "#ffc107",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "ลบข้อมูลเรียบร้อย",
                        icon: "success",
                        iconColor: "#28a745",
                        //timer: 1000, // ข้อความจะหายไปเองใน 2 วินาที (2000 มิลลิวินาที)
                        //timerProgressBar: true,
                        showConfirmButton: false // ไม่แสดงปุ่มตกลง
                    })
                    window.location.href = urlToRedirect;
                }
            });
        }

        function confirmation1(ev, customMessage) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            Swal.fire({
                title: customMessage || "คุณต้องการแก้ไขข้อมูลใช่หรือไม่",
                icon: "warning",
                iconColor: "#ffc107",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>

