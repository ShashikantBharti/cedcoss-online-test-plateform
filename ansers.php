<?php
require 'config.inc.php';

if (!isset($_SESSION['ANSER_LIST'])) {
    $_SESSION['ANSER_LIST'] = array();
}
$qid = $_REQUEST['qid'];
$anser = $_REQUEST['anser'];
if (isset($_SESSION['ANSER_LIST']) && count($_SESSION['ANSER_LIST']) != 0) {
    $flag = 0;
    foreach ($_SESSION['ANSER_LIST'] as $key => $value) {
        if ($value[0] == $qid) {
            $_SESSION['ANSER_LIST'][$key][1] = $anser;
            $flag = 1;
            break;
        } 
    }
    if ($flag == 0) {
        array_push($_SESSION['ANSER_LIST'], array($qid, $anser));    
    } 
} else {
    array_push($_SESSION['ANSER_LIST'], array($qid, $anser));
}
// unset($_SESSION['ANSER_LIST']);
print_r($_SESSION['ANSER_LIST']);

?>