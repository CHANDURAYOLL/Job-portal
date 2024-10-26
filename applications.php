<?php
include 'server/db.php'; 
session_start();

$job_id = $_GET['job_id'];
$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO applications (user_id, job_id) VALUES ('$user_id', '$job_id')";
if ($conn->query($sql) === TRUE) {
    header('Location: dashboard.php'); // Redirect after application
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
