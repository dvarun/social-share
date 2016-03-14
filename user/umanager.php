<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $user = $_SESSION['uname'];
} else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="../favi.ico" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="user-style.css" />
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <title>Welcome :: <?php echo $name; ?> ::</title>    </head>
    <body>
        <?php include "/components/header.php"; ?>
        <div class="container wrap" >
            <br/>
            <div class="content" style="margin-left: 5%;margin-right: 5%;width:90%;text-align: left;">
                <?php
                $mode = $_POST['txtMode'];
                switch ($mode) {
                    case 1:
                        $txtName = $_POST['txtName'];
                        $txtEmail = $_POST['txtEmail'];
                        $txtUser = $_POST['txtUser'];
                        $sql = 'update users set name="' . $txtName . '",username="' . $txtUser . '",email="' . $txtEmail . '" where uid="' . $_SESSION['uid'] . '";';
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "<center><h3>Detail Successfully Updated</h3>\n";
                            echo '<a href="index.php">Click here to go back</a></center>';
                        } else {
                            echo mysql_error();
                        }
                        break;

                    case 2:
                        $oldpass = md5($_POST['txtOpass']);
                        $newpass = md5($_POST['txtNpass']);
                        $checkpass = md5($_POST['txtCheck']);
                        $sql = 'select * from users where uid="' . $_SESSION['uid'] . '" and password="' . $oldpass . '";';
                        $query = $auth->query($sql);
                        if (mysql_num_rows($query) == 1) {
                            if ($newpass != $checkpass) {
                                echo "<center><h3>Retype Password Does not match!</h3>\n";
                                echo '<a href="index.php">Click here to go back</a></center>';
                                die();
                            }
                            $sql = 'update users set password="' . $newpass . '" where uid="' . $_SESSION['uid'] . '";';
                            $query = $auth->query($sql);
                            if ($query) {
                                echo "<center><h3>Password Changed Successfully!</h3>\n";
                                echo '<a href="index.php">Click here to go back</a></center>';
                            } else {
                                echo mysql_error();
                                die();
                            }
                        } else {
                            echo "<center><h3>Old Password Does not match</h3>\n";
                            echo '<a href="index.php">Click here to go back</a></center>';
                            die();
                        }
                        break;

                    case 3:
                        $group = $_POST['txtGroup'];
                        $sql = "select * from groups where gname='" . $group . "' ";
                        $query = $auth->query($sql);
                        if ($query) {
                            while ($row = mysql_fetch_array($query)) {
                                if ($group == $row['gname']) {
                                    echo "<center><h3>Group already exists</h3>";
                                    echo '<a href="index.php">Click here to go back</a></center>';
                                    die();
                                }
                            }
                        } else {
                            echo mysql_error();
                        }
                        $sql = "INSERT INTO `socshare`.`groups` (`uid`, `gname`) VALUES ('" . $_SESSION['uid'] . "', '" . $group . "');";
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "<center><h3>Group Created</h3>";
                            echo '<a href="index.php">Click here to go back</a></center>';
                            mkdir("../APP-BOX/" . $group);
                        } else {
                            echo mysql_error();
                            die();
                        }
                        break;

                    case 4:
                        $sender = $_POST['txtSender'];
                        $rec = $_POST['txtReceiver'];
                        $mess = addslashes($_POST['txtMessage']);
                        $recName = $_POST['txtRecName'];
                        $sql = "insert into messages (uidSender,Recname,uidReceiver,Message) values('" . $sender . "','" . $recName . "','" . $rec . "','" . $mess . "')";
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "<center><h3>Message has been sent</h3>";
                            echo '<a href="message.php">Click here to go back</a></center>';
                        } else {
                            echo mysql_error();
                        }
                        break;

                    case 5:
                        $group = $_POST['txtPGroup'];
                        $sql = "select * from pr_group where gname='" . $group . "' ";
                        $query = $auth->query($sql);
                        if ($query) {
                            while ($row = mysql_fetch_array($query)) {
                                if ($group == $row['gname']) {
                                    echo "<center><h3>Group already exists</h3>";
                                    echo '<a href="index.php">Click here to go back</a></center>';
                                    die();
                                }
                            }
                        } else {
                            echo mysql_error();
                        }
                        $sql = "INSERT INTO `socshare`.`groups` (`uid`, `gname`) VALUES ('" . $_SESSION['uid'] . "', '" . $group . "');";
                        $query = $auth->query($sql);
                        if ($query) {
                            echo "<center><h3>Group Created</h3>";
                            echo '<a href="index.php">Click here to go back</a></center>';
                            mkdir("../PRIVATE-APP-BOX/" . $group);
                        } else {
                            echo mysql_error();
                            die();
                        }
                        break;
                    case 6:

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
                        $gid = $_POST['grid'];
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
                            echo "<center><h3>Group Deleted!!</h3></center>";
                            echo '<center><a href="index.php">Click here to go back</a></center>';
                        } else {
                            echo mysql_error();
                        }
                        break;
                        
                        case 7:
                            //Delete file
                            $file_path = $_POST['FLpath'];
                            if(unlink($file_path)){
                                echo "<h3>File Deleted Sucessfully</h3>";
                                echo '<center><a href="index.php">Click here to go back</a></center>';
                            }
                        break;
                        
                        case 8:
                            //update status
                            $uid = $_POST['txtUid'];
                            $name_status = $_POST['txtName'];
                            $status = mysql_real_escape_string(strip_tags($_POST['txtStatus']));
                            $sql = "insert into status values('','".$uid."', '".$name_status."','".$status."');";
                            $query = $auth->query($sql);
                            if($query){
                                echo "<h3>Status Upadated!</h3>";
                                echo '<center><a href="index.php">Click here to go back</a></center>';
                            }else{echo mysql_error();}
                        break;
                    
                    default:
                        echo "<center><h3>No Option or mode found!</h3></center>";
                }
                ?>
            </div>
            <br/>
        </div>
    </body>
</html>
