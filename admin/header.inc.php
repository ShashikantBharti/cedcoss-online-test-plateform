<?php 
require 'config.inc.php';
require 'functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/adminstyle.css">
</head>
<body>
     <!-- Header -->
     <header>
        <h2>Welcome <span>Admin</span></h2>
        <a href="logout.php" class="btn btn-lg btn-primary">Logout</a>
     </header>
     <div class="wrapper">
        <div class="sidebar">
            <h4>Menu</h4>
            <ul>
                <li><a href="dashboard.php">&raquo; Dashboard</a></li>
                <li><a href="dashboard.php">&raquo; Manage Subject</a></li>
                <li><a href="topics.php">&raquo; Manage Topics</a></li>
                <li><a href="questions.php">&raquo; Manage Questions</a></li>
            </ul>
        </div>
        <div class="main-content">