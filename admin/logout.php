<?php
session_start();
unset($_SESSION['ADMIN_ID']);
session_destroy();
header('location: index.php');

?>