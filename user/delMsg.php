<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
} else {
    header("Location: ../index.php");
}
$mid = $_GET['mid'];
$sql = "Delete from messages where msgId=" . $mid;
$query = $auth->query($sql);
if($query){
    echo "<script>";
    echo "alert('Message Deleted');";
    echo "</script>";
    header("Location: message.php");
}else{
    echo mysql_error();
}
?>
