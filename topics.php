<?php
    require 'header.inc.php';
    $subject_id = $_REQUEST['id'];
    $sql = "SELECT * FROM `subjects` WHERE `id`='$subject_id'";
    $result = $conn -> query($sql) or die("Subject Selection Query Failed !!!.");
    if($result -> num_rows > 0) {
        $subject = $result -> fetch_assoc();
        $subject_name = $subject['name'];
    }
?>
    <div class="topics">
        <div class="container">
            <h2><a href="index.php">Home </a> / <?php echo $subject_name; ?></h2>
            <br>
            <hr>
            <ul>
                <?php 
                    $sql = "SELECT * FROM `topics` WHERE `subject` = '$subject_id' AND `status`=1";
                    $result = $conn -> query($sql) or die("Topics Selection Query Failed !!!.");
                    if($result -> num_rows > 0) {
                        while($row = $result -> fetch_assoc()) {
                            if(isset($_SESSION['USER_ID'])) {
                                echo '<li><a href="test.php?subject_id='.$subject_id.'&id='.$row['id'].'">'.$row['name'].'</a></li>';
                            } else {
                                echo '<li><a href="login_form.php">'.$row['name'].'</a></li>';
                            }
                        }
                    }
                ?>
                
            </ul>
        </div>
    </div>

<?php 
    require 'footer.inc.php';
?>