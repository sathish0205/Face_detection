<?php
include("../db/db.php"); // Include your database connection file

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $event = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'day' => $row['day'],
            'month' => $row['month'],
            'year' => $row['year']
        );
        $events[] = $event;
    }
}

// Close the connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($events);
?>
