<?php
session_start();
include 'header.php';
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Please log in to view your appointments.'); window.location.href = 'index.php';</script>";
    exit();
}

// Fetching the logged-in user's email
$user_email = $_SESSION['user_email'];

// Deleting the appointment if the delete button is clicked
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM appointments WHERE id = '$delete_id' AND user_email = '$user_email'";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Appointment deleted successfully.'); window.location.href = 'myappointments.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetching the appointments of the current user
$sql = "SELECT * FROM appointments WHERE user_email = '$user_email' ORDER BY appointment_date DESC, appointment_time DESC";
$result = $conn->query($sql);
?>

<!-- Add this in your header.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { margin: 0; font-family: Arial, sans-serif; }
    .main-content { margin-top: 70px; margin-left: 250px; padding: 20px; transition: margin-left 0.3s; }
    .table-container { background: white; padding: 30px; border-radius: 8px; max-width: 900px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
    .table-container h2 { margin-bottom: 20px; }
    .btn-delete, .btn-feedback { padding: 5px 10px; border-radius: 4px; cursor: pointer; border: none; color: white; }
    .btn-delete { background-color: #ff4d4d; }
    .btn-feedback { background-color: #007bff; }
    .btn-delete:hover { background-color: #cc0000; }
    .btn-feedback:hover { background-color: #0056b3; }
</style>

<div class="main-content">
    <div class="table-container">
        <h2>My Appointments</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): 
                        $appointment_id = $row['id'];
                        
                        // Check if feedback is already submitted
                        $feedback_query = "SELECT * FROM feedback WHERE appointment_id = '$appointment_id' AND user_email = '$user_email'";
                        $feedback_result = $conn->query($feedback_query);
                        $feedback_submitted = ($feedback_result->num_rows > 0);
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <?php if ($row['status'] == 'Done'): ?>
                                    <?php if ($feedback_submitted): ?>
                                        <span class="text-success">Feedback Submitted</span>
                                    <?php else: ?>
                                        <a href="feedback.php?appointment_id=<?php echo $appointment_id; ?>" class="btn-feedback">Give Feedback</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <a href="myappointments.php?delete_id=<?php echo $appointment_id; ?>" class="btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No appointments found.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
