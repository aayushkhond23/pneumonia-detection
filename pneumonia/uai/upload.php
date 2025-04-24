<?php
session_start();  // Start the session to access $_SESSION['user_id']
include '../user/db.php';  // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) { // Ensure the user is logged in
        $user_id = $_SESSION['user_id'];  // Get user ID from session

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $target_file = $target_dir . "tt_" . $user_id . "_" . time() . ".jpg";  // Unique file name for each user

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                    // Run check.py and capture output
                    exec('python ./check.py', $output);

                    if (is_array($output)) {
                        $output = implode("\n", $output);
                    }

                    // Store result in the database
                    $stmt = $conn->prepare("INSERT INTO analyzer_results (user_id, image_path, result) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $user_id, $target_file, $output);

                    if ($stmt->execute()) {
                        $stmt->close();

                        // Format the output
                        $formattedOutput = nl2br(htmlspecialchars($output));
                        $formattedOutput = preg_replace('/(Prediction:|Confidence:)/', '<strong>$1</strong>', $formattedOutput);
                        $formattedOutput = preg_replace('/(NORMAL|PNEUMONIA)/', '<span style="color: green; font-weight: bold;">$0</span>', $formattedOutput);

                        // Display results
                        echo "
                        <html>
                        <head>
                            <title>Pneumonia Detection Report</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; padding: 20px; text-align: center; background-color: #f4f4f4; }
                                .container { max-width: 700px; margin: auto; padding: 20px; border: 2px solid #ddd; border-radius: 10px; background: white; }
                                h2 { color: #2c3e50; }
                                .result { 
                                    font-size: 18px; 
                                    line-height: 1.6; 
                                    margin-top: 20px; 
                                    padding: 15px; 
                                    background: #ecf0f1; 
                                    border-radius: 5px; 
                                    text-align: left; 
                                    white-space: pre-wrap; 
                                    border: 1px solid #ccc; 
                                }
                                .btn { 
                                    margin-top: 20px; 
                                    padding: 10px 20px; 
                                    background: #3498db; 
                                    color: white; 
                                    text-decoration: none; 
                                    border-radius: 5px; 
                                    cursor: pointer; 
                                    border: none;
                                }
                                .btn:hover { background: #2980b9; }
                            </style>
                            <script>
                                function printReport() {
                                    window.print();
                                }
                            </script>
                        </head>
                        <body>
                            <div class='container'>
                                <h2>Pneumonia Detection Report</h2>
                                <div class='result'>$formattedOutput</div>
                                <button class='btn' onclick='printReport()'>Print Report</button>
                                <a class='btn' href='index.php'>Recheck</a>
                            </div>
                        </body>
                        </html>
                        ";
                    } else {
                        echo "Error saving the result to the database.";
                    }
                } else {
                    echo "Error uploading image.";
                }
            } else {
                echo "File is not an image.";
            }
        } else {
            echo "No file uploaded or an error occurred.";
        }
    } else {
        echo "You are not logged in. Please log in to access this feature.";
    }
} else {
    echo "Invalid request.";
}
?>
