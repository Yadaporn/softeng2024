@extends('accounter.import_layout')
@section('title')
@section('content')
<body>
    <div class="top">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="head">
            ห้องปฏิบัติการ
        </div>
        <button onclick="window.location.href='addroom';" class="add-btn">เพิ่มห้อง</button>
    </div>
    <div class="search-container">
        <form action="" method="GET">
            <input type="text" placeholder="ค้นหาห้อง..." name="search">
            <button type="submit">ค้นหา</button>
        </form>
    </div>
    <br><br>

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
    $sql = 'SELECT * FROM tb_build';
    $result = $conn->query($sql);
    $items_per_page = 10; // Number of items you want per page
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Get the current page from the URL
    $offset = ($current_page - 1) * $items_per_page; // Calculate the offset for the query
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Fetch the total number of items in the database to calculate the total number of pages
    $total_items_query = 'SELECT COUNT(crs_id) FROM tb_build';
    $total_items_result = $conn->query($total_items_query);
    $total_items_row = $total_items_result->fetch_row();
    $total_items = $total_items_row[0];
    $total_pages = ceil($total_items / $items_per_page);
    $total_items_query = 'SELECT COUNT(crs_id) FROM tb_build WHERE crs_room LIKE ? OR crs_build LIKE ?';
    $stmt = $conn->prepare($total_items_query);
    $stmt->bind_param('ss', $searchTermLike, $searchTermLike);
    $stmt->execute();
    $total_items_result = $stmt->get_result();
    $total_items_row = $total_items_result->fetch_row();

    // Modify the SQL query to include LIMIT and OFFSET
    $sql = "SELECT * FROM tb_build WHERE crs_room LIKE ? OR crs_build LIKE ? LIMIT $items_per_page OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $searchTermLike = '%' . $searchTerm . '%';
    $stmt->bind_param('ss', $searchTermLike, $searchTermLike);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // HTML to display the data in a table
    echo '<table border="1">';
    echo '<tr><th>ตึก</th><th>ห้อง</th><th>จำนวนนิสิต</th><th>แก้ไข/ลบ</th></tr>';
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['crs_build'] . '</td>';
            echo '<td>' . $row['crs_room'] . '</td>'; // Assuming 'ห้อง' is the correct column name
            echo '<td>' . $row['crs_Number_of_students'] . '</td>'; // Assuming 'จำนวนนิสิต' is the correct column name
            // Correct the link for the edit button
            echo "<td><button onclick=\"window.location.href='" .
                route('editroom', ['crs_id' => $row['crs_id']]) .
                "'\" class='edit-button'>แก้ไข</button>
                        <form action='" .
                route('ลบห้อง', ['crs_id' => $row['crs_id']]) .
                "' method='POST' style='display: inline;' onsubmit='return confirm(\"คุณต้องการลบห้องนี้หรือไม่?\");'>
                            " .
                csrf_field() .
                "
                            <input type='hidden' name='_method' value='DELETE'>
                            <button type='submit' class='delete-button'>ลบ</button>
                        </form>
                        </td>";
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

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img src="{{ asset('asset/delete.jpg') }}" alt="Image" class="modal-img"> <!-- Add your image here -->
            <p>ยืนยันลบห้องนี้หรือไม่?</p>
            <button class="yes-btn" onclick="deleteRoom(this)">ยืนยัน</button>
            <button class="no-btn" onclick="closeModal()">ยกเลิก</button> <!-- Close modal on "No" button click -->
        </div>
    </div>

    <script>
        // Function to open the modal
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Function to handle delete action
        function deleteRoom(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            closeModal(); // Close the modal after deletion
        }
    </script>
</body>
@endsection