<?php
include('../db/db.php');

$title = $_POST['title'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

$date = $year . '-' . $month . '-' . $day;

$sql = "INSERT INTO events (title, day, month, year, date2) VALUES ('$title', '$day', '$month', '$year', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
