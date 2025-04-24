<?php
session_start();
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Please log in to provide feedback.'); window.location.href = 'index.php';</script>";
    exit();
}

$user_email = $_SESSION['user_email'];

if (isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];
} else {
    echo "Invalid appointment ID.";
    exit();
}

if (isset($_POST['submit'])) {
    $feedback_text = $conn->real_escape_string($_POST['feedback']);
    $rating = intval($_POST['rating']);

    $insert_query = "INSERT INTO feedback (appointment_id, user_email, feedback_text, rating)
                     VALUES ('$appointment_id', '$user_email', '$feedback_text', '$rating')";

    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Feedback submitted successfully!'); window.location.href = 'viewappointments.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Provide Feedback</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .feedback-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            max-width: 600px;
            margin: 50px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <h2 class="mb-4 text-center">Provide Your Feedback</h2>
        
        <form method="POST" action="">
            <!-- Rating Selection -->
            <div class="mb-4">
                <label for="rating" class="form-label">Rate Your Experience (1 to 5):</label>
                <div class="d-flex align-items-center">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="rating" value="<?php echo $i; ?>" id="rating<?php echo $i; ?>" required>
                            <label class="form-check-label" for="rating<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Feedback Text -->
            <div class="mb-4">
                <label for="feedback" class="form-label">Your Feedback:</label>
                <textarea name="feedback" id="feedback" rows="5" class="form-control" placeholder="Write your feedback here..." required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" name="submit" class="btn-submit">Submit Feedback</button>
            </div>
        </form>
    </div>
</body>
</html>
