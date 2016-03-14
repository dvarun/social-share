<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (empty($_SESSION['aid'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/jqval.js"></script>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>      
        <title>Backend Manager</title>
        <style>
            .sidebar-nav-fixed {
                background-color: whitesmoke;
                border:1px solid #cccccc;
            }
            #fixed-lbar{
                float:left;
                position: absolute;
                height: 100%;
                background-color:whitesmoke;
                border-right: 1px solid #ccccff;
            }
        </style>
    </head>
    <body>
        <?php include "component/header.php"; ?>
        <div class="container-fluid" style="margin-top:40px;">
            <div id="fixed-lbar" class="span3" style="margin-left: -20px">
                <?php include 'component/side.php'; ?>
            </div> <!-- /sidebar -->
            <div class="span10" style="padding-left:270px">
                <br/>
                <?php
                $name = $_POST['txtName'];
                $User = $_POST['txtUser'];
                $Pass = $_POST['txtPass'];
                $Email = $_POST['txtEmail'];
                $sql = 'update users set name="' . $name . '",username="' . $User . '",email="' . $Email . '" ,password="' . md5($Pass) . '" where uid="' . $_POST['uid'] . '";';
                $query = $auth->query($sql);
                if ($query) {
                    echo "<h3>User Updated!</h3>";
                    echo '<a href="admin.php">Click here to go back</a>';
                } else {
                    echo mysql_error();
                    die();
                }
                ?>
                <br/>
            </div>
    </body>
</html>
