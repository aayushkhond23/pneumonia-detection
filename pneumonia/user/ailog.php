<?php 
session_start();
include 'header.php'; 
include '../user/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in. Please log in to access this feature.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all results for the user
$stmt = $conn->prepare("SELECT * FROM analyzer_results WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Main Content -->
<div class="main-content" style="margin-left: 250px; padding: 20px; width: calc(100% - 250px);">
    <div style="background: white; border-radius: 12px; padding: 20px;">
        <h4 style="text-align: center;">AI Detection Logs</h4>
        
        <table class="table table-bordered mt-3" style="background-color: white;">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo date("d-m-Y H:i:s", strtotime($row['date'])); ?></td>
                        <td><img src="../uai/<?php echo $row['image_path']; ?>" alt="Uploaded Image" style="width: 150px; height: auto; border-radius: 8px;"></td>
                        <td><?php echo $row['result']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
?>
