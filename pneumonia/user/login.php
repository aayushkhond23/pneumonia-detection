<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {  // Compare plain text passwords
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            // Redirect to dashboard.php
            echo "<script>alert('Login successful! Welcome!!.'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with this email. Please register.'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
