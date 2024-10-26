<?php
include 'db.php'; 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile data
$sql = "SELECT name, email, resume FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}

$conn->close();
?>
