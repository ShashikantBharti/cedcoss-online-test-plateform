<?php  
require 'header.inc.php';
if(!isset($_SESSION['ADMIN_ID'])) {
    header('location: index.php');
}

$msg = '';
$subject = '';
$topic = '';
if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $id = get_safe_value($conn, $_REQUEST['id']);
    $select = "SELECT * FROM `topics` WHERE `id`='$id'";
    $result = $conn -> query($select) or die("Topic Selection Query Failed !!!.");
    $row = $result -> fetch_assoc();
    $topic = $row['name'];
    $subject = $row['subject'];
}

if (isset($_REQUEST['submit'])) {
    if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
        $topic_name = ucwords(get_safe_value($conn, $_REQUEST['topic']));
        $subject_id = get_safe_value($conn, $_REQUEST['subject']);
        $sql = "UPDATE `topics` SET `subject`='$subject', `name`='$topic_name' WHERE `id`='$id' ";
        if ($conn -> query($sql) == true) {
            header('location: topics.php');
        } else {
            $msg = "Updation Failed !!!.";
        }
    } else {
        $topic_name = ucwords(get_safe_value($conn, $_REQUEST['topic']));
        $subject_id = get_safe_value($conn, $_REQUEST['subject']);
        $select = "SELECT * FROM `topics` WHERE `name`='$topic_name'";
        $result = $conn -> query($select) or die("Topic Selection Query Failed !!!.");
        if ($result -> num_rows > 0) {
            $msg = "Topic Already Exists !!!.";
        } else {
            $sql = "INSERT INTO `topics`(`subject`,`name`,`status`) VALUES('$subject_id', '$topic_name', 1)";
            if ($conn -> query($sql) == true) {
                $msg = 1;
            } else {
                $msg = "Something Went Wrong !!!.";
            }
        }
    }
}

?>
<div class="main-content-header">
    <p><strong>Topics </strong>/ Add Topic</p>
</div>
<div class="main">
    <form action="" method="POST" id="add-topic-form">
        <div class="form-group">
            <select name="subject" id="subject" required> 
                <option value="">--Choose Subject--</option>
                <?php 
                    $sql = "SELECT * FROM `subjects` ORDER BY `name`";
                    $result = $conn -> query($sql) or die("Subject Selection Query Failed !!!.");
                    if($result -> num_rows > 0) {
                        while($row = $result -> fetch_assoc()) {
                            if ($subject == $row['id']) {
                                echo '<option selected value="'.$row['id'].'">'.$row['name'].'</option>';
                            } else {
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                        }
                    }
                ?>
                
            </select>
            <label for="topic">Topic</label>
            <input type="text" name="topic" id="add-topic" class="has-error" value="<?php echo $topic; ?>" required>
            <p class="error-message"></p> <br>
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Add Topic</button>
        </div> 
    </form>
    <?php if ($msg != '') : ?>
    <div class="message <?php if ($msg == 1) { echo 'success-message'; } else { echo 'error-message'; }  ?>">
        <p><?php if ($msg == 1) { echo 'Question Successfully Added !!!.'; } else { echo $msg; }  ?></p>
    </div>
    <?php endif; ?>
</div>
<?php require 'footer.inc.php'; ?>