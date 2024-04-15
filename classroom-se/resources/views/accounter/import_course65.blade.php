@extends('accounter.import_layout')
@section('title', 'Courses')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <table class="table table-bordered border-black table-active text-center">
        <div class="">
            <div class="col-auto">
                <form action="/import_course65" method="GET">
                    <div class="input-group">
                        <input type="search" id="inputPassword6" name="search" class="form-control me-2"
                            style="max-width: 500px;" placeholder="Search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div><br>
                    <a href="/import_create65" class="btn btn-success py-2" style="color: white;">เพิ่มรายวิชา</a> <br>
                    {{-- <input type="search" id="inputPassword6" name="search" class="form-control" placeholder="Search" style="width: 500px;">
                    <button class="btn btn-primary" type="submit">Search</button> --}}
                </form>
            </div>
        </div><br>
        <a>
            <h5 style="text-align:;">หลักสูตรปี 65 วิศวกรรมศาสตร์คอมพิวเตอร์และสารสนเทศศาสตร์</h5>
        </a>
        <thead>
            <tr>

                <th scope="col">รหัสวิชา</th>
                <th scope="col">รหัสวิชา-ปีหลักสูตร</th>
                <th scope="col">ชื่อวิชา</th>
                <th scope="col">บรรยาย</th>
                <th scope="col">ปฏิบัติ</th>
                <th scope="col">แก้ไข</th>
                <th scope="col">ลบ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($course65 as $item)
                <tr>
                    <td>{{ $item->course_idr }}</td>
                    <td>{{ $item->course_code }}</td>
                    <td>{{ $item->course_name }}</td>
                    <td>{{ $item->course_lec }}</td>
                    <td>{{ $item->course_lab }}</td>
                    <td>
                        <a href="{{ route('import_edit65', $item->course_id) }}" class="btn btn-warning btn-sm text-black"
                            onclick="confirmation1(event,'ยืนยันจะแก้ไขรายวิชา {{ $item->course_name }} นี้หรือไม่ ?')">
                            แก้ไข
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('import_delete65', $item->course_id) }}" class="btn btn-danger btn-sm text-black"
                            onclick="confirmation(event,'ยืนยันจะลบรายวิชา {{ $item->course_name }} นี้หรือไม่ ?')">
                            ลบ
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $course65->links() }}
    </script>

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
