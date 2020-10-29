<?php  
require 'header.inc.php';
if (!isset($_SESSION['ADMIN_ID'])) {
    header('location: index.php');
}
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $id = get_safe_value($conn, $_REQUEST['id']);
    $action = get_safe_value($conn, $_REQUEST['action']);
    if ($action == 'active') {
        $status = 1;
        $conn -> query("UPDATE `subjects` SET `status` = '$status' WHERE `id`='$id'") or die("Updation Failed !!!.");
    } else if($action == 'deactive') {
        $status = 0;
        $conn -> query("UPDATE `subjects` SET `status` = '$status' WHERE `id`='$id'") or die("Updation Failed !!!.");
    } else {
        $conn -> query("DELETE FROM `subjects` WHERE `id` = '$id'") or die("Deletion Failed !!!.");
    }
}

?>
<div class="main-content-header">
    <h2>Subjects</h2>
    <a href="add-subject.php">&raquo; Add New Subject</a>
</div>
<div class="main">
    <table>
        <thead>
            <tr>
                <th class="left">#</th>
                <th class="left">ID</th>
                <th class="left">Name</th>
                <th class="right">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
                $sql = "SELECT * FROM `subjects` ORDER BY `name` ASC";
                $result = $conn -> query($sql) or die("Subject Selection Query Failed !!!.");
                if ($result -> num_rows >0 ) {
                    $sr = 1;
                    while ($row = $result -> fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $sr; ?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td class="right">
                <?php 
                        if ($row['status'] == 1) {
                            echo '<a href="?action=deactive&id='.$row['id'].'" class="btn btn-sm btn-success" title="Deactive"><i class="fas fa-toggle-on"></i></a>';
                        } else {
                            echo '<a href="?action=active&id='.$row['id'].'" class="btn btn-sm btn-warning" title="Active"><i class="fas fa-toggle-off"></i></a>';
                        }
                    ?>
                    <a href="add-subject.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php 
                $sr++;
                    }
                    
                }
            ?>
        </tbody>
    </table>
</div>
<?php require 'footer.inc.php'; ?>