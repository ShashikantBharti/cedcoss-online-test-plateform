<?php  
require 'header.inc.php';
if(!isset($_SESSION['ADMIN_ID'])) {
    header('location: index.php');
}

$msg = '';
$subject_name = '';
if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $id = get_safe_value($conn, $_REQUEST['id']);
    $select = "SELECT * FROM `subjects` WHERE `id`='$id'";
    $result = $conn -> query($select) or die("Subject Selection Query Failed !!!.");
    $row = $result -> fetch_assoc();
    $subject_name = $row['name'];
}

if (isset($_REQUEST['submit'])) {
    if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
        $subject = get_safe_value($conn, $_REQUEST['subject']);
        $subject = ucwords($subject);
        $sql = "UPDATE `subjects` SET `name`= '$subject' WHERE `id`='$id'";
        if ($conn -> query($sql) == true) {
            header('location: dashboard.php');
        } else {
            $msg = "Updation Failed !!!.";
        }
    } else {
        $subject = get_safe_value($conn, $_REQUEST['subject']);
        $subject = ucwords($subject);
        $select = "SELECT * FROM `subjects` WHERE `name`='$subject'";
        $result = $conn -> query($select) or die("Subject Selection Query Failed !!!.");
        if ($result -> num_rows > 0) {
            $msg = "Subject Already Exists !!!.";
        } else {
            $sql = "INSERT INTO `subjects`(`name`,`status`) VALUES('$subject',1)";
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
    <p><strong>Subject </strong>/ Add Subject</p>
</div>
<div class="main">
    <form action="" method="POST" id="add-subject-form">
        <div class="form-group">
            <label for="subject">Subject Name</label>
            <input type="text" name="subject" id="add-subject" class="has-error" value="<?php echo $subject_name; ?>" required>
            <p class="error-message"></p> <br>
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Add Subject</button>
        </div> 
    </form>
    <?php if ($msg != '') : ?>
    <div class="message <?php if($msg == 1) { echo 'success-message'; } else { echo 'error-message'; }  ?>">
        <p><?php if($msg == 1) { echo 'Subjects Successfully Added !!!.'; } else { echo $msg; }  ?></p>
    </div>
    <?php endif; ?>
</div>
<?php require 'footer.inc.php'; ?>