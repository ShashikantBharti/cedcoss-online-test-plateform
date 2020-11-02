<?php
    require 'header.inc.php';
    if(!isset($_SESSION['USER_ID'])) {
        header('location: index.php');
    }
    $id = $_REQUEST['id'];
    $subject_id = $_REQUEST['subject_id'];
    $user_id = $_SESSION['USER_ID'];
    $total_pages = '';
    // Select Topic Details
    $select_topic = "SELECT * FROM `topics` WHERE `id`='$id'";
    $topic_result = $conn -> query($select_topic) or die("Topic Selection Failed !!!.");
    if ($topic_result -> num_rows > 0) {
        $topic = $topic_result -> fetch_assoc();
    }
    // Select Subject Details
    $select_subject = "SELECT * FROM `subjects` WHERE `id`='$subject_id'";
    $subject_result = $conn -> query($select_subject) or die("Subject Selection Failed !!!.");
    if ($subject_result -> num_rows > 0) {
        $subject = $subject_result -> fetch_assoc();
    }
    // Select User Details
    $select_user = "SELECT * FROM `users` WHERE `id`='$user_id'";
    $user_result = $conn -> query($select_user) or die("User Selection Failed !!!.");
    if ($user_result -> num_rows > 0) {
        $user = $user_result -> fetch_assoc();
    }
    // Select Question Details
    $sql = "SELECT * FROM `questions` WHERE `topic`='$id' AND `status`=1";
    $result = $conn -> query($sql) or die("Question Selection Failed");
    $limit = 1;
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
?>
    <!-- Main Content -->
    <div class="container">
        <div class="question-section">
            <h2><a href="index.php">Home </a> / <a href="topics.php?id=<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></a> / <?php echo $topic['name']; ?></h2>
            <br>
            <hr>
            <br>
            <div class="top">
                <h3>User: <span><?php echo $user['name']; ?></span></h3>
                <button class="btn" id="start-btn">Start</button>
                <h3>Time: <time>00:20:00</time></h3>
            </div>
            <br>
            <hr>
            <div class="question">
                <?php 
                $sql = "SELECT * FROM `questions` WHERE `topic`='$id' LIMIT {$offset}, {$limit}" ;
                $questions_result = $conn -> query($sql) or die("Question Selection Query Failed !!!.") ;
                if ($questions_result -> num_rows > 0) {
                    while ($question = $questions_result -> fetch_assoc()){
                ?>
                <h4>Q.<?php echo $page.': '.$question['questions']; ?></h4>
                <p><input type="radio" name="<?php echo 'option'.$question['id']; ?>" class="option" data-qid="<?php echo $question['id']; ?>" id="<?php echo $question['option1']; ?>" value="<?php echo $question['option1']; ?>"><label for="<?php echo $question['option1']; ?>"><?php echo $question['option1']; ?></label></p>
                <p><input type="radio" name="<?php echo 'option'.$question['id']; ?>" class="option" data-qid="<?php echo $question['id']; ?>" id="<?php echo $question['option2']; ?>" value="<?php echo $question['option2']; ?>"><label for="<?php echo $question['option2']; ?>"><?php echo $question['option2']; ?></label></p>
                <p><input type="radio" name="<?php echo 'option'.$question['id']; ?>" class="option" data-qid="<?php echo $question['id']; ?>" id="<?php echo $question['option3']; ?>" value="<?php echo $question['option3']; ?>"><label for="<?php echo $question['option3']; ?>"><?php echo $question['option3']; ?></label></p>
                <p><input type="radio" name="<?php echo 'option'.$question['id']; ?>" class="option" data-qid="<?php echo $question['id']; ?>" id="<?php echo $question['option4']; ?>" value="<?php echo $question['option4']; ?>"><label for="<?php echo $question['option4']; ?>"><?php echo $question['option4']; ?></label></p>
                <?php 
                    }
                }
                ?>
                <br><br>
                <a href="result.php?topic=<?php echo $id; ?>" class="btn" id="submit-test-btn">Submit</a>
                <a href="#" class="btn">Quit</a>
            </div>
            <hr> 
            <br><br>
            <div class="pagination">
                <?php 
                if ($page > 1) {
                    echo '<a href="?subject_id='.$subject['id'].'&id='.$id.'&page='.($page - 1).'">&laquo;</a>' ;
                }
                if ($result -> num_rows > 0) {
                    $total_records = $result -> num_rows;
                    $total_pages = ceil($total_records / $limit);
                    for ($i = 1;$i <= $total_pages; $i++) {
                        if ($page == $i) {
                            echo '<a href="?subject_id='.$subject['id'].'&id='.$id.'&page='.$i.'" class="current">'.$i.'</a>' ;
                        } else {
                            echo '<a href="?subject_id='.$subject['id'].'&id='.$id.'&page='.$i.'">'.$i.'</a>' ;
                        }
                    }
                }
                if ($page < $total_pages) {
                    echo '<a href="?subject_id='.$subject['id'].'&id='.$id.'&page='.($page + 1).'">&raquo;</a>' ;
                }
                ?>
            </div>
            <div class="description">
                <ul>
                    <li>There are 10 questions.</li>
                    <li>You have 20 min to solve them.</li>
                    <li>Each question contains 1 mark.</li>
                    <li>You can submit test before time but when time up test will be automatically submitted.</li>
                    <li>When test will be submitted result will be displayed.</li>
                    <li>After submitting test your record will be saved. You can see it in <strong>My Record</strong> section.</li>
                    <li>You can quit your test before time but record will not be saved.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- //Main Content -->
    
<?php  
    require 'footer.inc.php';
?>