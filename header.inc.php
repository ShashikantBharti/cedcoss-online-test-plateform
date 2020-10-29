<?php  
    require 'config.inc.php';
    $filename = basename($_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Test Plateform</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <h2><a href="index.php"><span>Online</span> Test</a></h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a class="<?php if ($filename == 'index.php') { echo 'active'; } ?>" href="index.php">Home</a></li>
                    <?php
                        if (isset($_SESSION['USER_ID'])) {
                            if ($filename == 'myrecord.php') {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            echo '<li><a class="'.$active.'" href="myrecord.php">My Record</a></li>';
                            echo '<li><a href="logout.php">Logout</a></li>';
                        } else {
                            if ($filename == 'register.php') {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            echo '
                                <li><a class="'.$active.'" href="register.php">Register</a></li>
                                <li><a href="javascript:void(0)" id="login-btn">Login</a></li>
                            ';
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
    </header>
    <!-- //Header -->