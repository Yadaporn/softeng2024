<?php
// add_room.php

// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // replace with your database username
define('DB_PASSWORD', ''); // replace with your database password
define('DB_DATABASE', 'db_classroom'); // replace with your database name

// Create database connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $building = $conn->real_escape_string($_POST['building']);
    $room = $conn->real_escape_string($_POST['room']);
    $student_count = (int)$_POST['student_count'];
    $notes = $conn->real_escape_string($_POST['notes']);

    // Prepare an INSERT statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO tb_build (building, room, student_count, notes) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $building, $room, $student_count, $notes);
    
    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "New record created successfully";
        // Redirect to the list rooms page or wherever appropriate
        header("Location: list_rooms.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
