<?php 
require 'header.inc.php';
require 'functions.inc.php';
if(isset($_SESSION['USER_ID'])) {
   header('location: index.php') ;
}
?>

    <div class="container">
        <div class="register">
            <form action="">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" name="username" id="username">
                    <p class="error"></p>
                </div>
                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input type="password" name="userpassword" id="userpassword">
                    <p class="error"></p>
                </div>
                <div class="form-group">
                <button class="btn" type="button" id="login-btn" onclick="login()">LOGIN</button>
                    <p class="error-message"></p>
                </div>
            </form>
        </div>
    </div>
<?php 
    require 'footer.inc.php';
?>