<?php

session_start();
unset($_SESSION['USER_ID']);
unset($_SESSION['ANSER_LIST']);
session_destroy();
header('location: index.php');

?>