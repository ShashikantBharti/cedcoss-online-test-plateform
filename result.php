<?php
require 'header.inc.php';
if (!$_SESSION['USER_ID']) {
    header('location: index.php');
}
$topic = $_REQUEST['topic'];
$user_id = $_SESSION['USER_ID'];
$total_attempt_qsn = count($_SESSION['ANSER_LIST']);
$right = 0;
$sql = "SELECT `id`,`anser` FROM `questions` WHERE `topic`='$topic'";
$result = $conn -> query($sql) or die("Query Failed !!!.");
if ($result -> num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        foreach ($_SESSION['ANSER_LIST'] as $key => $value) {
            if (($row['id'] == $value[0]) && ($row['anser'] == $value[1])) {
                $right++;
            }
        }
    }
}
$user_sql = "SELECT * FROM `users` WHERE `id`='$user_id'";
$user_result = $conn -> query($user_sql) or die("USer query failed !!!.");
if ($user_result -> num_rows > 0) {
    $user = $user_result -> fetch_assoc();
}
?>
    <div class="topics">
        <div class="container">
            <h1><?php echo $user['name']; ?></h1> <hr>
            <p>Total Attempt Questions: <strong><?php echo $total_attempt_qsn; ?></strong></p>
            <p>Total Not Attempt Questions: <strong> <?php echo count($_SESSION['ANSER_LIST']) - $total_attempt_qsn; ?> </strong></p>
            <p>Total Right Ansers: <strong> <?php echo $right; ?> </strong></p>
            <p>Total Wrong Ansers: <strong> <?php echo $total_attempt_qsn - $right; ?> </strong></p>
        </div>
    </div>

<?php 
    require 'footer.inc.php';
?>