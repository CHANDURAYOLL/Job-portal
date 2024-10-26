<?php
include 'db.php'; 
session_start();

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $resume = $_FILES['resume']['name'];

    // Set upload directory and move uploaded file
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($resume);

    if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadFile)) {
        // Insert user data into the database
        $sql = "INSERT INTO users (name, email, password, resume) VALUES ('$name', '$email', '$password', '$resume')";
        if ($conn->query($sql) === TRUE) {
            header('Location: ../login.html');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload resume.";
    }
}



// Login User
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header('Location: ../dashboard.html'); // Redirect to dashboard after successful login
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "No user found with that email";
    }
}
?>
