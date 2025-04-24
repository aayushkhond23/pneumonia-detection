<?php
@session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Panel</title>
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
            padding: 80px 20px 20px 270px;
            transition: padding-left 0.3s;
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
    <a href="ai.php">AI Detector</a>
    <a href="ailog.php">AI Detector Log</a>
    <a href="viewdoctors.php">View Doctors</a>
    <a href="viewappointments.php">My Appointments</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Header -->
<div class="header">
    <span class="menu-toggle" onclick="toggleMenu()">☰</span>
    <span>User Panel</span>
</div>

<!-- JavaScript for Menu Toggle -->
<script>
    function toggleMenu() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
        var menu = document.getElementById('menu');
        var toggleButton = document.querySelector('.menu-toggle');

        if (window.innerWidth <= 991 && !menu.contains(event.target) && !toggleButton.contains(event.target)) {
            menu.classList.remove('show');
        }
    });
</script>
