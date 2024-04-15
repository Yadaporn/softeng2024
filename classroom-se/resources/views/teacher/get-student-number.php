<?php
// Replace with actual database connection code
include '../classroom/storage/framework/views/database.php';

// Get the room from the query parameters
$room = $_GET['crs_room'] ?? '';

// Implement your logic to retrieve the number of students
$numberOfStudents = 0; // Default value if not found

// Example pseudo-code for a database query
$query = "SELECT crs_Number_of_students FROM tb_build WHERE crs_room = :room";
$stmt = $pdo->prepare($query);
$stmt->execute(['room' => $room]);
if ($row = $stmt->fetch()) {
    $numberOfStudents = $row['crs_Number_of_students'];
}

// Return the number of students as JSON
header('Content-Type: application/json');
echo json_encode(['crs_Number_of_students' => $numberOfStudents]);