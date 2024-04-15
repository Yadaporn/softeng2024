@extends('accounter.import_layout')
@section('content')
<div class="button-container" style="padding: 20px">
    <a href="/route-1" class="btn btn-green">สำเร็จ</a>
    <a href="/route-2" class="">รอพิจารณา</a>
</div>
<?php
    // Database configuration
    define('DB_SERVER', 'localhost:3306');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'project_se');
    
    // Create database connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    // Query to fetch data from the table
    $sql = 'SELECT * FROM classcreated';
    $result = $conn->query($sql);
    $items_per_page = 10; // Number of items you want per page
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Get the current page from the URL
    $offset = ($current_page - 1) * $items_per_page; // Calculate the offset for the query
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Fetch the total number of items in the database to calculate the total number of pages
    $total_items_query = 'SELECT COUNT(sbj_id) FROM classcreated';
    $total_items_result = $conn->query($total_items_query);
    $total_items_row = $total_items_result->fetch_row();
    $total_items = $total_items_row[0];
    $total_pages = ceil($total_items / $items_per_page);
    $total_items_query = 'SELECT COUNT(sbj_id) FROM classcreated WHERE sbj_name LIKE ? OR sbj_Teacher_Name LIKE ?';
    $stmt = $conn->prepare($total_items_query);
    $stmt->bind_param('ss', $searchTermLike, $searchTermLike);
    $stmt->execute();
    $total_items_result = $stmt->get_result();
    $total_items_row = $total_items_result->fetch_row();

    // Modify the SQL query to include LIMIT and OFFSET
    $sql = "SELECT * FROM classcreated WHERE sbj_name LIKE ? OR sbj_Teacher_Name LIKE ? LIMIT $items_per_page OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $searchTermLike = '%' . $searchTerm . '%';
    $stmt->bind_param('ss', $searchTermLike, $searchTermLike);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // HTML to display the data in a table
    echo '<table border="1">';
    echo '<tr><th>วัน/เวลา ที่รายวิชาชน</th><th>ชื่อวิชา</th><th>อาจารย์</th><th>สถานะ</th></tr>';
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['sbj_day'] . '</td>';
            echo '<td>' . $row['sbj_name'] . '</td>'; // Assuming 'ห้อง' is the correct column name
            echo '<td>' . $row['sbj_Teacher_Name'] . '</td>'; // Assuming 'จำนวนนิสิต' is the correct column name
            // Correct the link for the edit button
            echo '<td>' . สำเร็จแล้ว . '</td>';
            echo '</tr>';
        }
    
        // ...
    } else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
    }
    
    echo '</table>';
    
    echo '<div class="pagination">';
    for ($page = 1; $page <= $total_pages; $page++) {
        // Check if we're on the current page
        $class = $page == $current_page ? 'active' : '';
        echo "<a href='?page=$page' class='$class'>$page</a>";
    }
    echo '</div>';
    
    // Close database connection
    $conn->close();
    ?>

    {{-- <table class="table table-bordered text text-center table-secondary ">
        <thead>
            <tr>
                <th scope="col">วัน/เวลา ที่รายวิชาชน</th>
                <th scope="col">ชื่อวิชา</th>
                <th scope="col">อาจารย์</th>
                <th scope="col">สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sbjs as $item)
                <tr>
                    <td>{{ $item->sbj_day }} {{ $item->sbj_start }}-{{ $item->sbj_end }}</td>
                    <td>{{ $item->sbj_name }}</td>
                    <td>{{ $item->sbj_teacher_name }}</td>
                    <td>
                        <a href="{{ route('managesuccess', $item->sbj_id) }}" class="">สำเร็จแล้ว</a>
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

                    {{-- <td>
                        <a href="{{ route('Manage_delete', $item->sbj_id) }}" class="btn btn-danger"
                            onclick="confirmation(event, 'คุณต้องการจะยกเลิกข้อมูลของ {{ $item->sbj_name }} หรือไม่ ?')">ยกเลิก
                        </a>
                    </td> --}}
                    {{-- <td>
                        <a href="{{ route('Info_delete', $item->info_id) }}" class="btn btn-danger"
                            onclick="confirmSubmission()">ลบ
                        </a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sbjs->links() }} --}}
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

