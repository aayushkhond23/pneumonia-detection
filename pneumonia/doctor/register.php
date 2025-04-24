<?php
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $license_number = mysqli_real_escape_string($conn, $_POST['license_number']);

    $sql = "INSERT INTO doctors (fullname, email, password, experience, qualification, license_number)
            VALUES ('$fullname', '$email', '$password', '$experience', '$qualification', '$license_number')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Registration Successful! Please login to continue.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
            transition: transform 0.3s;
        }
        form:hover {
            transform: scale(1.02);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border 0.3s;
        }
        input:focus {
            border-color: #6e8efb;
        }
        input[type="submit"] {
            background-color: #6e8efb;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #a777e3;
        }
        .error {
            background-color: #ffdddd;
            color: #d9534f;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Doctor Registration</h2>
        
        <label>Full Name:</label>
        <input type="text" name="fullname" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <label>Experience (in years):</label>
        <input type="number" name="experience" required>
        
        <label>Qualification:</label>
        <input type="text" name="qualification" required>
        
        <label>License Number:</label>
        <input type="text" name="license_number" required>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
