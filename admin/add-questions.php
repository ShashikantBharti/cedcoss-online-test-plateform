<?php
require 'header.inc.php';
if (!isset($_SESSION['ADMIN_ID'])) {
    header('location: index.php');
}
$msg = '';
$question = '';
$anser = '';
$option1 = '';
$option2 = '';
$option3 = '';
$option4 = '';
$subject_id = '';
$topic_id = '';
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $id = get_safe_value($conn, $_REQUEST['id']);
    $select = "SELECT * FROM `questions` WHERE `id`='$id'";
    $result = $conn -> query($select) or die("Question Selection Query Failed !!!.");
    $row = $result -> fetch_assoc();
    $question = $row['questions'];
    $anser = $row['anser'];
    $option1 = $row['option1'];
    $option2 = $row['option2'];
    $option3 = $row['option3'];
    $option4 = $row['option4'];
    $subject_id = $row['subject'];
    $topic_id = $row['topic'];
}

if (isset($_REQUEST['submit'])) {
    if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
        $subject = get_safe_value($conn, $_REQUEST['subject']);
        $topic = get_safe_value($conn, $_REQUEST['topic']);
        $quest = ucfirst(get_safe_value($conn, $_REQUEST['question']));
        $ans = ucfirst(get_safe_value($conn, $_REQUEST['anser']));
        $opt1 = ucfirst(get_safe_value($conn, $_REQUEST['option1']));
        $opt2 = ucfirst(get_safe_value($conn, $_REQUEST['option2']));
        $opt3 = ucfirst(get_safe_value($conn, $_REQUEST['option3']));
        $opt4 = ucfirst(get_safe_value($conn, $_REQUEST['option4']));
        $sql = "UPDATE `questions` SET `subject`='$subject', `topic`='$topic', `questions`='$quest', `anser`='$ans', `option1`='$opt1', `option2`='$opt2', `option3`='$opt3', `option4`='$opt4', `status`='1' WHERE `id`='$id'";
        if ($conn -> query($sql) == true) {
            header('location: questions.php');
        } else {
            $msg = "Updation Failed !!!.";
        }
    } else {
        $subject = get_safe_value($conn, $_REQUEST['subject']);
        $topic = get_safe_value($conn, $_REQUEST['topic']);
        $quest = ucfirst(get_safe_value($conn, $_REQUEST['question']));
        $ans = ucfirst(get_safe_value($conn, $_REQUEST['anser']));
        $opt1 = ucfirst(get_safe_value($conn, $_REQUEST['option1']));
        $opt2 = ucfirst(get_safe_value($conn, $_REQUEST['option2']));
        $opt3 = ucfirst(get_safe_value($conn, $_REQUEST['option3']));
        $opt4 = ucfirst(get_safe_value($conn, $_REQUEST['option4']));
        $select = "SELECT * FROM `questions` WHERE `questions`='$question'";
        $result = $conn -> query($select) or die("Question Selection Query Failed !!!.");
        if ($result -> num_rows > 0) {
            $msg = "Question Already Exists !!!.";
        } else {
            $sql = "INSERT INTO `questions`(`subject`, `topic`, `questions`, `anser`, `option1`, `option2`, `option3`, `option4`, `status`) VALUES('$subject', '$topic','$quest', '$ans', '$opt1', '$opt2', '$opt3', '$opt4',1)";
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
    <p><strong>Question </strong>/ Add Question</p>
</div>
<div class="main">
    <form action="" method="POST" id="add-question-form">
        <div class="form-group">
            <select name="subject" id="subject-list" required> 
                <option value="">--Choose Subject--</option>
                <?php 
                $sql = "SELECT * FROM `subjects` ORDER BY `name`";
                $result = $conn -> query($sql) or die("Subject Selection Query Failed !!!.");
                if ($result -> num_rows > 0) {  
                    while ($row = $result -> fetch_assoc()) {
                        if ($subject_id == $row['id']) {
                            echo '<option selected data-topic="'.$topic_id.'" value="'.$row['id'].'">'.$row['name'].'</option>';
                        } else {
                            echo '<option data-topic="'.$topic_id.'" value="'.$row['id'].'">'.$row['name'].'</option>';
                        }
                    }
                }
                ?>
            </select>
            <select name="topic" id="topics-list" required></select>
            <label for="question">Question</label>
            <input type="text" name="question" id="question" value="<?php echo $question; ?>" required>
            <p class="error-message"></p>
            <label for="anser">Anser</label>
            <input type="text" name="anser"  id="anser" value="<?php echo $anser; ?>" required>
            <p class="error-message"></p>
            <label for="option1">Option 1</label>
            <input type="text" name="option1"  id="option1" value="<?php echo $option1; ?>" required>
            <p class="error-message"></p>
            <label for="option2">Option 2</label>
            <input type="text" name="option2"  id="option2" value="<?php echo $option2; ?>" required>
            <p class="error-message"></p>
            <label for="option3">Option 3</label>
            <input type="text" name="option3"  id="option3" value="<?php echo $option3; ?>" required>
            <p class="error-message"></p>
            <label for="option4">Option 4</label>
            <input type="text" name="option4"  id="option4" value="<?php echo $option4; ?>" required>
            <p class="error-message"></p>
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Add Question</button>
        </div> 
    </form>
    <?php if ($msg != '') : ?>
    <div class="message <?php if($msg == 1) { echo 'success-message'; } else { echo 'error-message'; }  ?>">
        <p><?php if($msg == 1) { echo 'Question Successfully Added !!!.'; } else { echo $msg; }  ?></p>
    </div>
    <?php endif; ?>
</div>
<?php require 'footer.inc.php'; ?>