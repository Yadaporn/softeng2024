@extends('teacher.layout')
@section('title', 'ห้องปฏิบัติการ')
@section('content') 

<body>
    <div class="top">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="head">
            ห้องปฏิบัติการ
        </div>

    </div>
    <div>
        ตึก23
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
    $sql = 'SELECT * FROM status_build23';
    $result = $conn->query($sql);
    $items_per_page = 10; // Number of items you want per page
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Get the current page from the URL
    $offset = ($current_page - 1) * $items_per_page; // Calculate the offset for the query
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    
    // Fetch the total number of items in the database to calculate the total number of pages
    $searchTermLike = '%' . $searchTerm . '%';
    $total_items_query = 'SELECT COUNT(st_id) FROM status_build23 WHERE st_room LIKE ? OR st_day LIKE ? OR st_start LIKE ? OR st_end LIKE ? OR st_subjects LIKE ? OR st_teacher_name LIKE ?';
    $stmt = $conn->prepare($total_items_query);
    $stmt->bind_param('ssssss', $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike);
    $stmt->execute();
    $total_items_result = $stmt->get_result();
    $total_items_row = $total_items_result->fetch_row();
    $total_items = $total_items_row[0];
    $total_pages = ceil($total_items / $items_per_page);
    
    // Now, modify the SQL query for the main data retrieval with LIMIT and OFFSET
    $sql = 'SELECT * FROM status_build23 WHERE st_room LIKE ? OR st_day LIKE ? OR st_start LIKE ? OR st_end LIKE ? OR st_subjects LIKE ? OR st_teacher_name LIKE ? LIMIT ? OFFSET ?';
    $stmt = $conn->prepare($sql);
   $stmt->bind_param('ssssssii', $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $items_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // ... continue with your HTML table generation using $result
    
    if ($stmt = $conn->prepare($total_items_query)) {
        // Prepare and bind parameters
        $searchTermLike = '%' . $searchTerm . '%';
        $stmt->bind_param('ssssss', $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike, $searchTermLike);
    
        // Execute the statement and retrieve the result
        if ($stmt->execute()) {
            $total_items_result = $stmt->get_result();
            $total_items_row = $total_items_result->fetch_row();
            // ...
        } else {
            // Handle execution error
            echo 'Error executing query: ' . $stmt->error;
        }
    } else {
        // Handle preparation error
        echo 'Error preparing query: ' . $conn->error;
    }
    
    // HTML to display the data in a table
    echo '<table border="1">';
    echo '<tr><th>ห้อง</th><th>วัน/เวลา</th><th>วิชา</th><th>อาจารย์</th></tr>';
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['st_room'] . '</td>';
            echo '<td>' . $row['st_day'] . '' . $row['st_start'] . '-' . $row['st_end'] . '</td>'; // Assuming 'ห้อง' is the correct column name
            echo '<td>' . $row['st_subjects'] . '</td>';
            echo '<td>' . $row['st_teacher_name'] . '</td>';
            // Correct the link for the edit button
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
