<?php
session_start();
include '../db.php';
include 'header.php';

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_email'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in doctor's email
$doctor_email = $_SESSION['doctor_email'];

// Fetch doctor details from the database
$doctor_query = "SELECT id, fullname FROM doctors WHERE email = '$doctor_email'";
$doctor_result = $conn->query($doctor_query);
$doctor = $doctor_result->fetch_assoc();

if (!$doctor) {
    echo "Doctor not found.";
    exit();
}

$doctor_id = $doctor['id'];

// Handle deletion of an appointment
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM appointments WHERE id = '$delete_id' AND doctor_id = '$doctor_id'";
    
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'viewappointments.php';</script>";
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }
}

// Handle marking an appointment as done
if (isset($_GET['mark_done_id'])) {
    $mark_done_id = $_GET['mark_done_id'];
    $mark_done_query = "UPDATE appointments SET status = 'Done' WHERE id = '$mark_done_id' AND doctor_id = '$doctor_id'";
    
    if ($conn->query($mark_done_query) === TRUE) {
        echo "<script>alert('Appointment marked as done successfully!'); window.location.href = 'viewappointments.php';</script>";
    } else {
        echo "Error updating appointment status: " . $conn->error;
    }
}

// Fetch appointments for the logged-in doctor
$appointment_query = "SELECT * FROM appointments WHERE doctor_id = '$doctor_id' ORDER BY appointment_date, appointment_time";
$appointment_result = $conn->query($appointment_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Appointments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #4A90E2;
            color: white;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .delete-button, .done-button {
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            color: white;
        }
        .delete-button {
            background-color: #e74c3c;
        }
        .delete-button:hover {
            background-color: #c0392b;
        }
        .done-button {
            background-color: #27ae60;
        }
        .done-button:hover {
            background-color: #1e8449;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Appointments for Dr. <?php echo htmlspecialchars($doctor['fullname']); ?></h2>

    <?php if ($appointment_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Patient Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $appointment_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'Pending'): ?>
                            <a href="viewappointments.php?mark_done_id=<?php echo $row['id']; ?>">
                                <button class="done-button">Mark as Done</button>
                            </a>
                        <?php endif; ?>
                        <a href="viewappointments.php?delete_id=<?php echo $row['id']; ?>">
                            <button class="delete-button">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>

</div>

</body>
</html>

<?php $conn->close(); ?>
