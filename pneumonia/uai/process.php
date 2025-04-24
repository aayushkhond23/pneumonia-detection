<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $apiKey = "AIzaSyC0Pz3wxWYljSzIAexqdYMTQyGwdU57NFg"; // Replace with your Gemini AI API key
    $imagePath = $_FILES["image"]["tmp_name"];

    // Convert image to base64
    $imageData = base64_encode(file_get_contents($imagePath));

    // Send request to Gemini AI API
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro-vision:generateContent?key=" . $apiKey;
    $postData = json_encode([
        "contents" => [[
            "parts" => [[
                "inlineData" => [
                    "mimeType" => "image/jpeg",
                    "data" => $imageData
                ]
            ]]
        ]]
    ]);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process AI response
    $responseData = json_decode($response, true);
    $diagnosis = $responseData["candidates"][0]["content"]["parts"][0]["text"] ?? "Unknown Diagnosis";

    // Send result back to frontend
    echo json_encode([
        "message" => "Diagnosis: $diagnosis",
        "diagnosis" => $diagnosis
    ]);
}
?>
