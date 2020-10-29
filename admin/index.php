<?php 
require 'config.inc.php';
require 'functions.inc.php';
$msg = '';
if (isset($_REQUEST['login'])) {
    if ($_REQUEST['username'] != '' || $_REQUEST['password'] != '') {
        $username = get_safe_value($conn, $_REQUEST['username']);
        $password = get_safe_value($conn, $_REQUEST['password']);
        $sql = "SELECT * FROM `admin_users` WHERE `username` = '$username' AND `password` = '$password'";
        $result = $conn -> query($sql) or die("Query Failed !!!.");
        if ($result -> num_rows > 0) {
            $row = $result -> fetch_assoc();
            $_SESSION['ADMIN_ID'] = $row['id'];
            header('location: dashboard.php');
        } else {
            $msg = "User Name or Password is Incorrect !!!.";
        }
    } else {
        $msg = "Fill All Details !!!.";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/adminstyle.css">
</head>
<body style="background:#333;">
   <!-- Admin Login Form -->
   <div class="admin-login">
       <div class="content"> 
           <?php if ($msg != ''): ?>
           <div class="message">
                <p><?php echo $msg; ?></p>
                <a href="#">&times;</a>
           </div>
           <?php endif; ?>
           <form action="" method="POST">
               <label for="username">User Name</label>
               <input type="text" name="username" placeholder="User Name">
               <label for="password">Password</label>
               <input type="password" name="password" placeholder="Password">
               <br>
               <button type="submit" name="login" class="btn btn-lg btn-primary">Login</button>
           </form>
       </div>
   </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/adminscript.js"></script>
</body>
</html>