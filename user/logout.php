<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$dba = new DBA();
$auth = new AUTH();
$sql = 'UPDATE users SET online = 0 WHERE uid ="' . $_SESSION['uid'] . '";';
$query = $auth->query($sql);
if ($query) {
    header("Location: user/index.php");
} else {
    die();
    echo "error occured";
}
$auth->logout();
header("Location: ../index.php");
?>
