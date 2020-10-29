<?php
require 'config.inc.php';
if (!isset($_SESSION['ANSERS_LIST'])) {
    $_SESSION['ANSERS_LIST'] = array();
}
$qid = $_REQUEST['qid'];
$anser = $_REQUEST['anser'];
if (isset($_SESSION['ANSERS_LIST'])) {
    foreach ($_SESSION['ANSERS_LIST'] as $items) {
        foreach ($items as $key => $value) {
            if ($key == $qid) {
                
            }
        }
    }
    array_push($_SESSION['ANSERS_LIST'], array($qid => $anser));
}
echo json_encode($_SESSION['ANSERS_LIST']);
?>