<?php 
include 'header.php'; 
include 'db.php';

// Fetching the total number of available doctors
$doctorQuery = "SELECT COUNT(*) as total_doctors FROM doctors"; // Assuming your doctors table is named 'doctors'
$doctorResult = $conn->query($doctorQuery);
$doctorRow = $doctorResult->fetch_assoc();
$totalDoctors = $doctorRow['total_doctors'];

// Fetching the total number of appointments booked
$appointmentQuery = "SELECT COUNT(*) as total_appointments FROM appointments"; // Assuming your appointments table is named 'appointments'
$appointmentResult = $conn->query($appointmentQuery);
$appointmentRow = $appointmentResult->fetch_assoc();
$totalAppointments = $appointmentRow['total_appointments'];

$conn->close();
?>

<!-- Main Content -->
<div class="main-content" style="margin-left: 250px; padding: 20px;">
    <br>
    <h1>Welcome to AI Pneumonia Analyzer Dashboard</h1>
    <div class="cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
        <div class="card" style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
            <h3 style="margin: 0; font-size: 2.5rem; color: #0047AB;"><?php echo $totalDoctors; ?></h3>
            <p style="margin: 10px 0; font-size: 1.2rem; color: #666;">Doctors Available</p>
        </div>
        <div class="card" style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
            <h3 style="margin: 0; font-size: 2.5rem; color: #0047AB;"><?php echo $totalAppointments; ?></h3>
            <p style="margin: 10px 0; font-size: 1.2rem; color: #666;">Appointments Booked</p>
        </div>
    </div>
</div>

</body>
</html>
