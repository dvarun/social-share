<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (empty($_SESSION['aid'])) {
    header("Location: index.php");
}
function removeDir($path) {
    // Normalise $path.
    $path = rtrim($path, '/') . '/';

    // Remove all child files and directories.
    $items = glob($path . '*');

    foreach ($items as $item) {
        is_dir($item) ? removeDir($item) : unlink($item);
    }
    // Remove directory.
    rmdir($path);
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
                $mode = $_GET['mode'];
                switch ($mode) {
                    case 1:
                        //edit
                        $sql = "select * from users where uid=" . $_GET['uid'];
                        $query = $auth->query($sql);
                        if ($query) {
                            while ($row = mysql_fetch_array($query)) {
                                echo '<form method="POST" action="update.php">';
                                echo '<input type="text" value="' . $row['name'] . '" name="txtName"/><br/>';
                                echo '<input type="text" value="' . $row['username'] . '" name="txtUser"/><br/>';
                                echo '<input type="text" value="" name="txtPass"/><br/>';
                                echo '<input type="hidden" value="' . $_GET['uid'] . '" name="uid"/> ';
                                echo '<input type="text" value="' . $row['email'] . '" name="txtEmail"/><br/>';
                                echo '<input type="submit" class="btn"/>';
                                echo '</form>';
                            }
                        } else {
                            echo mysql_error();
                        }
                        break;

                    case 2:
                        //delete
                        $sql = "Delete from users where uid=" . $_GET['uid'];
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "Deleted Successfully";
                            echo '<a href="admin.php">Click here to go back</a>';
                        } else {
                            echo mysql_error();
                        }
                        break;

                    case 3:
                        // Add admin
                        $username = $_GET['txtUser'];
                        $password = $_GET['txtPass'];
                        $query = $auth->register_admin($username, md5($password));
                        if ($query) {
                            echo "Admin added";
                            echo '<a href="admin.php">Click here to go back</a>';
                        }
                        break;

                    case 4:
                        //Delete Message
                        $sql = "Delete from messages where msgId=" . $_GET['mid'];
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "Message Deleted Successfully";
                            echo '<a href="admin.php">Click here to go back</a>';
                        } else {
                            echo mysql_error();
                        }
                        break;

                    case 5:
                        //Delete folder
                        $gid = $_GET['grid'];
                        $sql = "select * from groups where gid=" . $gid;
                        $query = $auth->query($sql);
                        if ($query) {
                            while ($row = mysql_fetch_array($query)) {
                                $gname = $row['gname'];
                            }
                        } else {
                            echo mysql_error();
                        }
                        $dir = '../APP-BOX/' . $gname . '/';
                        removeDir($dir);

                        $sql = "Delete from groups where gid=" . $gid;
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "Group Deleted!!";
                        } else {
                            echo mysql_error();
                        }
                        break;

                    default:
                        echo "No mode found!";
                }
                ?>
            </div>
        </div>
    </body>
</html>
