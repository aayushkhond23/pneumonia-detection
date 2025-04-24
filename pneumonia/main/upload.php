<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . "tt.jpg";

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Run check.py and capture output
                exec('python ./check.py', $output);

                if (is_array($output)) {
                    $output = implode("\n", $output);
                }

                // Display results in a formatted HTML page
                echo "
                <html>
                <head>
                    <title>Pneumonia Detection Report</title>
                    <style>
                        body { 
                            font-family: Arial, sans-serif; 
                            margin: 20px; 
                            padding: 20px; 
                            text-align: center; 
                            background-color: #f4f4f4; 
                        }
                        .container { 
                            max-width: 700px; 
                            margin: auto; 
                            padding: 20px; 
                            border: 2px solid #ddd; 
                            border-radius: 10px; 
                            background: white; 
                        }
                        h2 { 
                            color: #2c3e50; 
                        }
                        .result { 
                            font-size: 22px; 
                            line-height: 1.5; 
                            margin-top: 20px; 
                            padding: 15px; 
                            background: #ecf0f1; 
                            border-radius: 5px; 
                            text-align: left; 
                            word-wrap: break-word; 
                            white-space: pre-wrap; 
                            overflow: hidden;
                        }
                        .btn { 
                            margin-top: 20px; 
                            padding: 10px 20px; 
                            background: #3498db; 
                            color: white; 
                            text-decoration: none; 
                            border-radius: 5px; 
                            display: inline-block; 
                            cursor: pointer;
                            border: none;
                        }
                        .btn:hover { 
                            background: #2980b9; 
                        }
                        @media print {
                            body * {
                                visibility: hidden;
                            }
                            .print-section, .print-section * {
                                visibility: visible;
                            }
                            .print-section {
                                position: absolute;
                                left: 0;
                                top: 0;
                                width: 100%;
                            }
                        }
                    </style>
                    <script>
                        function printReport() {
                            window.print();
                        }

                        function saveAsPDF() {
                            var printWindow = window.open('', '_blank');
                            printWindow.document.write(`
                                <html>
                                <head>
                                    <title>Pneumonia Detection Report</title>
                                    <style>
                                        body { font-family: Arial, sans-serif; text-align: center; margin: 40px; }
                                        .container { max-width: 700px; margin: auto; padding: 20px; border: 2px solid #ddd; border-radius: 10px; background: white; }
                                        h2 { color: #2c3e50; }
                                        .result { font-size: 20px; line-height: 1.6; margin-top: 20px; padding: 15px; background: #ecf0f1; border-radius: 5px; text-align: left; border: 1px solid #ccc; }
                                        .footer { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px; text-align: center; font-size: 14px; color: #333; }
                                    </style>
                                </head>
                                <body>
                                    <div class='container'>
                                        <h2>Pneumonia Detection Report</h2>
                                        <p>Date: \${new Date().toISOString().split('T')[0]}</p>
                                        <div class='result'>
                                            <p>" . nl2br(htmlspecialchars($output)) . "</p>
                                        </div>
                                        <div class='footer'>
                                            <p>Generated by Pneumonia Detection System</p>
                                        </div>
                                    </div>
                                    <script>
                                        setTimeout(function() {
                                            window.print();
                                        }, 500);
                                    <\/script>
                                </body>
                                </html>
                            `);
                            printWindow.document.close();
                        }
                    </script>
                </head>
                <body>
                    <div class='container print-section'>
                        <h2>Pneumonia Detection Report</h2>
                        <div class='result'>
                            <p>" . nl2br(htmlspecialchars($output)) . "</p>
                        </div>
                    </div>
                    <button class='btn' onclick='printReport()'>Print Report</button>
                    <button class='btn' onclick='saveAsPDF()'>Save as PDF</button>
                </body>
                </html>
                ";
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
    echo "Invalid request.";
}
?>
