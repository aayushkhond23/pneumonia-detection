<?php
@session_start();
if (!isset($_SESSION['doctor_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .menu {
            position: fixed;
            top: 0;
            left: 0;
            background-color: #4A90E2;
            width: 250px;
            height: 100%;
            padding-top: 20px;
            transition: transform 0.3s;
            z-index: 11;
        }
        .menu a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #357ABD;
        }
        .menu-toggle {
            font-size: 30px;
            cursor: pointer;
            margin-left: 10px;
            display: none;
            color: white;
        }
        .header {
            background-color: #4A90E2;
            color: white;
            padding: 15px;
            text-align: left;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 10;
        }
        .container {
            flex-grow: 1;
            padding: 80px 20px 20px 270px; /* Adjusted for menu width */
            transition: padding-left 0.3s;
        }

        /* Stats Cards */
        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 180px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .stat-card h2 {
            color: #4A90E2;
            margin: 0;
        }
        .stat-card p {
            margin-top: 8px;
            color: #666;
        }

        /* Navigation Cards */
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .card a {
            color: #4A90E2;
            text-decoration: none;
            font-size: 16px;
        }

        /* Mobile Styles */
        @media (max-width: 991px) {
            .menu {
                transform: translateX(-100%);
            }
            .menu.show {
                transform: translateX(0);
            }
            .menu-toggle {
                display: inline-block;
            }
            .container {
                padding-left: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar Menu -->
<div class="menu" id="menu">
    <a href="javascript:void(0)" onclick="toggleMenu()" style="text-align: right; margin-right: 20px;">✖</a>
    <a href="dashboard.php">Dashboard</a>
    <a href="ai.php">Ai Detector</a>
    <a href="viewappointments.php">View Appointments</a>
    <a href="viewfeedback.php">View Feedback</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Header -->
<div class="header">
    <span class="menu-toggle" onclick="toggleMenu()">☰</span>
    <span>Doctor Dashboard</span>
</div>

<!-- JavaScript for Menu Toggle -->
<script>
    function toggleMenu() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('show');
    }

    // Close menu if clicked outside (for mobile)
    document.addEventListener('click', function(event) {
        var menu = document.getElementById('menu');
        var toggleButton = document.querySelector('.menu-toggle');

        if (window.innerWidth <= 991 && !menu.contains(event.target) && !toggleButton.contains(event.target)) {
            menu.classList.remove('show');
        }
    });
</script>
