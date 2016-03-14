<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
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
        <title>Social share-messaging area!</title>
    </head>
    <body>
        <!--starting of nav bar -->
        <?php include "/components/header.php"; ?>
        <!--End of nav bar -->    
        <div class="container wrap">
            <br/>
            <div class="content" style="margin-left: 5%;margin-right: 5%;width:90%;text-align: left;">
                <center><h3>Messages</h3></center>
                <div class="frm" style="margin-right: 20px;">
                    <table class="table table-bordered">
                        <tr>
                            <td>From</td>
                            <td>Message</td>
                            <td>Reply</td>
                            <td><center>Delete</center></td>
                        </tr>
                        <?php
                        $sql = "select * from messages where uidReceiver=" . $_SESSION['uid'];
                        $query = $auth->query($sql);
                        if ($query):
                            while ($row = mysql_fetch_array($query)):
                                ?>
                                <tr>
                                    <td><?php echo $row['Recname'];?></td>
                                    <td><?php echo $row['Message'];?></td>
                                    <td><a href="sendMsg.php?uid=<?php echo $row['uidSender']; ?>">Reply</a></td>
                                    <td><center><a href="delMsg.php?mid=<?php echo $row['msgId']; ?>"><i class="icon-remove"></i></a></center></td>
                                </tr>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </table>
                </div>
                <hr/>
                <center><h3>Users</h3></center>
                <div class="frm" style="margin-right: 20px;">
                    <table class="table table-striped table-bordered">
                        <?php
                        $sql = "select * from users where uid!=".$_SESSION['uid'];
                        $query = $auth->query($sql);
                        if ($query):
                            while ($row = mysql_fetch_array($query)) :
                                ?> 
                                <tr>
                                    <td><a href="#"><?php echo $row['name'] ?></a></td>
                                    <td><a href="sendMsg.php?uid=<?php echo $row['uid']; ?>"><i class="icon-inbox"></i></a></td>
                                </tr>
                                <?php
                            endwhile;
                        else :
                            echo mysql_error();
                        endif;
                        ?>
                    </table>
                </div>
            </div>
            <br/>
        </div>
    </body>
</html>
