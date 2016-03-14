<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$dba = new DBA();
$auth = new AUTH();
$auth->logout();
header("Location: index.php");
?>
