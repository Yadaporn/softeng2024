@extends('admin.Info_layout')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}
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
                    <td>{{ $item->info_email }}</td>
                    <td>{{ $item->info_name }}</td>
                    <td>{{ $item->info_duty }}</td>
                    <td>
                        <a href="{{ route('Info_edit', $item->info_id) }}" class="btn btn-warning"
                            onclick="confirmation1(event, 'คุณต้องการจะแก้ไขข้อมูลของ {{ $item->info_name }} หรือไม่ ?')">แก้ไข</a>
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
                        <a href="{{ route('Info_delete', $item->info_id) }}" class="btn btn-danger"
                            onclick="confirmation(event, 'คุณต้องการจะลบข้อมูลของ {{ $item->info_name }} หรือไม่ ?')">ลบ
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
    {{ $blogs->links() }}

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
@endsection
