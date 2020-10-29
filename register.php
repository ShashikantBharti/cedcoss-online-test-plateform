<?php 
require 'header.inc.php';
require 'functions.inc.php';
if (isset($_SESSION['USER_ID'])) {
   header('location: index.php');
}

$msg = '';
if (isset($_REQUEST['submit'])) {
    $name = get_safe_value($conn, $_REQUEST['name']);
    $email = get_safe_value($conn, $_REQUEST['email']);
    $mobile = get_safe_value($conn, $_REQUEST['mobile']);
    $password = get_safe_value($conn, $_REQUEST['password']);
    $added_on = date('Y-m-d h:i:s');
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = $conn -> query($sql) or die("User selection query failed !!!.");
    if ($result -> num_rows > 0) {
        $msg = "User email already registered !!!.";
    } else {
        $sql = "INSERT INTO `users`(`name`, `email`, `mobile`, `password`, `added_on`) VALUES ('$name', '$email', '$mobile', '$password', '$added_on')";
        if ($conn -> query($sql) == true) {
            $msg = 1;
        } else {
            $msg = "Registration Failed !!!.";
        }
    }
}
?>

    <div class="container">
        <div class="register">
            <form action="" method="POST" id="reg-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="has-error">
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" class="has-error">
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" class="has-error">
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete = "false" class="has-error">
                    <p class="error-message"></p>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn" id="register">REGISTER</button>
                    <br>
                    <br>
                    <p class="reg-message error-message"></p>
                    <?php 
                    if ($msg != '') {
                        if ($msg == 1) {
                            echo '<p class="success-message">Registration Successfull !!!.</p>';
                        } else {
                            echo '<p class="error-message">'.$msg.'</p>';
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div> 
    <div class="login">
        <form action="">
            <input type="text" name="username" id="username" placeholder="Email ID*">
            <input type="password" name="userpassword" id="userpassword" placeholder="Password*" autocomplete="false">
            <button class="btn" type="button" id="login-btn" onclick="login()">LOGIN</button>
            <span class="error-message"></span>
            <a href="#" id="close-btn">&times;</a>
            <p>New User? <a href="register.php">Register</a></p>
        </form>
    </div>
<?php 
    require 'footer.inc.php';
?>