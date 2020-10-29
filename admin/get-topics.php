<?php 
require 'config.inc.php';
$subject = $_REQUEST['id'];
$topic = $_REQUEST['topic'];

$sql = "SELECT * FROM `topics` WHERE `subject`='$subject' ORDER BY `name`";
$result = $conn -> query($sql) or die("Topics Selection Query Failed !!!.");
$html = '';
if ($result -> num_rows > 0) {
    $html .= '<option value="">--Select Topic--</option>';
    while ($row = $result -> fetch_assoc()) {
        if($topic == $row['id']) {
            $html .= '<option selected value="'.$row['id'].'">'.$row['name'].'</option>';
        } else {
            $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }
}
echo $html;

?>