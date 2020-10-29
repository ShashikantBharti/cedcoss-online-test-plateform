<?php 
require 'config.inc.php';
require 'functions.inc.php';
$username = get_safe_value($conn, $_REQUEST['username']);
$userpassword = get_safe_value($conn, $_REQUEST['userpassword']);

$sql = "SELECT * FROM `users` WHERE `email` = '$username' AND `password` = '$userpassword'";
$result = $conn -> query($sql) or die("Selection Query Failed !!!");
if ($result -> num_rows >0 ) {
    $row = $result -> fetch_assoc();
    $_SESSION['USER_ID'] = $row['id'];
    echo 1;
} else {
    echo 0;
}


?>