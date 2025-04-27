<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ARIS</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="IMG_5993.png">

    <!-- Google Font & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif;">

<!-- Header Section -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e67e22;">
    <div class="container">

        <!-- Logo + Title -->
        <a class="navbar-brand d-flex align-items-center fw-semibold" href="front-page.php" style="gap: 10px;">
            <img src="IMG_5993.png" alt="Logo" style="height: 40px;">
            ARIS
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!empty($_SESSION['level']) && $_SESSION['level'] == "staff") : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="front-page.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="student-register-page.php">Register Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="student-list.php">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Custom Styles -->
<style>
    .navbar-nav .nav-link,
    .navbar-brand {
        transition: color 0.3s ease;
        border-radius: 0;
        background-color: transparent !important;
        outline: none;
        box-shadow: none;
    }

    .navbar-nav .nav-link:hover,
    .navbar-brand:hover {
        color: #ffd7b0 !important;
    }
</style>
