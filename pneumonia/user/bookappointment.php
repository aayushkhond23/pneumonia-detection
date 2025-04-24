<?php
session_start();
include 'header.php';
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Please log in to book an appointment.'); window.location.href = 'index.php';</script>";
    exit();
}

// Fetching the logged-in user's details from the user table
$user_email = $_SESSION['user_email'];
$user_query = "SELECT name FROM users WHERE email = '$user_email'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();
$patient_name = $user['name'];

// Handling Appointment Booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $doctor_name = $_POST['doctor_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $patient_name1 = $_POST['patient_name'];

    $current_date = date("Y-m-d");

    // Check if selected date is a past date
    if ($appointment_date < $current_date) {
        echo "<script>alert('Cannot book an appointment for a previous date.'); window.location.href = 'viewdoctors.php';</script>";
    } else {
        // Insert appointment into the database
        $sql = "INSERT INTO appointments (user_email, patient_name, doctor_id, doctor_name, appointment_date, appointment_time)
                VALUES ('$user_email', '$patient_name1', '$doctor_id', '$doctor_name', '$appointment_date', '$appointment_time')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Appointment booked successfully!'); window.location.href = 'viewdoctors.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!-- Add this in your header.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .main-content {
        margin-top: 70px;
        margin-left: 250px;
        padding: 20px;
        transition: margin-left 0.3s;
    }

    .form-container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-container input,
    .form-container select {
        padding: 10px;
        width: 100%;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container button {
        padding: 10px 20px;
        background-color: #4A90E2;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    .form-container button:hover {
        background-color: #357ABD;
    }
</style>

<div class="main-content">
    <div class="form-container">
        <h2>Book Appointment with Dr. <?php echo htmlspecialchars($_GET['doctor_name']); ?></h2>

        <form method="POST" action="bookappointment.php">
            <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($_GET['doctor_id']); ?>">
            <input type="hidden" name="doctor_name" value="<?php echo htmlspecialchars($_GET['doctor_name']); ?>">

            <div>
                <label>Patient Name:</label>
                <input type="text" name="patient_name" value="<?php echo $patient_name; ?>" readonly>
            </div>

            <div>
                <label>Appointment Date:</label>
                <input type="date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div>
                <label>Appointment Time:</label>
                <select name="appointment_time" required>
                    <?php
                    // Generate time slots in 30-minute intervals
                    $start_time = strtotime("08:00");
                    $end_time = strtotime("23:00");

                    for ($time = $start_time; $time <= $end_time; $time += 1800) {
                        $time_slot = date("H:i", $time);
                        echo "<option value='$time_slot'>$time_slot</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit">Book Appointment</button>
        </form>
    </div>
</div>
</body>
</html>
