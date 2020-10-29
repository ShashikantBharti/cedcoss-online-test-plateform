<?php
    require 'header.inc.php';
?>
    <!-- Main Content -->
    <div class="container">
        <br>
        <h1 align="center">Choose Subject</h1>
        <div class="content">
            <?php
            $sql = "SELECT * FROM `subjects` WHERE `status` = 1 ORDER BY `name` ASC";
            $result = $conn -> query($sql) or die("Subject Selection QUery Failed !!!.");
            if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                    echo '
                    <a href="topics.php?id='.$row['id'].'" class="box">
                        <h2>'.$row['name'].'</h2>
                    </a>
                    ';        
                }
            }
        ?>
        </div>
    </div>
    <!-- //Main Content -->
    <!-- Login Modal -->
    <div class="login">
        <form action="">
            <input type="text" name="username" id="username" placeholder="Email ID*">
            <input type="password" name="userpassword" id="userpassword" placeholder="Password*" autocomplete="false">
            <button class="btn" type="button" id="login-btn" onclick="login()">LOGIN</button>
            <span class="error-message"></span>
            <a href="#" id="close-btn">&times;</a>
            <p>New User? <a href="register.html">Register</a></p>
        </form>
    </div>
    <!-- //Login Modal -->
<?php 
    require 'footer.inc.php';
?>