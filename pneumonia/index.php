<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Pneumonia Analyzer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
            max-width: 700px;
            text-align: center;
        }
        .btn-custom {
            width: 200px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        h1 {
            color: #007bff;
            font-weight: bold;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="card">
            <h1>AI Pneumonia Analyzer</h1>
            <p>
                A cutting-edge AI-based application designed to detect Pneumonia from chest X-rays with high accuracy.
                Upload your X-ray images and get instant results powered by advanced Machine Learning models.
            </p>

            <div>
                <a href="user/index.php" class="btn btn-primary btn-custom">Login as User</a>
                <a href="doctor/login.php" class="btn btn-success btn-custom">Login as Doctor</a>
                <a href="doctor/register.php" class="btn btn-warning btn-custom">New Doctor Signup</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
