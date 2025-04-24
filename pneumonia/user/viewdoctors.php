<?php 
include 'header.php'; 
include 'db.php';  // Make sure this file contains your database connection code

?>

<div class="container">
    <h2>List of Available Doctors</h2>

    <!-- Displaying List of Doctors -->
    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">

        <?php
        // Fetching list of doctors from the database
        $sql = "SELECT id, fullname, experience, qualification FROM doctors";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($doctor = $result->fetch_assoc()) {
                ?>
                <div style="background-color: white; padding: 20px; border-radius: 8px; width: 250px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
                    <h3><?php echo $doctor['fullname']; ?></h3>
                    <p>Qualification: <?php echo $doctor['qualification']; ?></p>
                    <p>Experience: <?php echo $doctor['experience']; ?> years</p>
                    <form action="bookappointment.php" method="GET">
                        <input type="hidden" name="doctor_id" value="<?php echo $doctor['id']; ?>">
                        <input type="hidden" name="doctor_name" value="<?php echo $doctor['fullname']; ?>">
                        <button type="submit" style="padding: 10px 15px; background-color: #4A90E2; color: white; border: none; border-radius: 4px; cursor: pointer;">Book Appointment</button>
                    </form>
                </div>
                <?php
            }
        } else {
            echo "<p>No doctors available at the moment.</p>";
        }

        $conn->close();
        ?>

    </div>
</div>

</body>
</html>
