<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
} else {
    header("Location: ../index.php");
}
$uid = $_GET['uid'];
if (!$uid || $uid == NULL) {
    header("Location: ../index.php");
} else {
    $sql = "select * from users where uid=" . $uid;
    $query = $auth->query($sql);
    if ($query) {
        while ($row = mysql_fetch_array($query)) {
            $recName = $row['name'];
        }
    } else {
        echo mysql_error();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="user-style.css" />
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <title>Welcome to <?php echo $gname . " : " . $name; ?> ::</title>
    </head>
    <body>
        <!--starting of nav bar -->
        <?php include "/components/header.php"; ?>
        <!--End of nav bar -->    
        <div class="container wrap">
            <br/>
            <div class="content" style="margin-left: 5%;margin-right: 5%;width:90%;text-align: left;">
                <?php
                $sql = "select * from users where uid=" . $uid;
                $query = $auth->query($sql);
                if ($query) {
                    while ($row = mysql_fetch_array($query)) {
                        $name2 = $row['name'];
                    }
                } else {
                    echo mysql_error();
                }
                ?>
                <center><h3>Send Message to <?php echo $name2; ?> </h3></center>
                <div class="frm" style="margin-right: 20px;">
                    <form method="POST" action="umanager.php">
                        <textarea rows="5" name="txtMessage" style="width: 100%;">Type Message here!! </textarea>
                        <input type="hidden" value="<?php echo $uid; ?>" name="txtReceiver"/>
                        <input type="hidden" value="<?php echo $_SESSION['uid']; ?>" name="txtSender"/><br/>
                        <input type="hidden" value="<?php echo $name; ?>" name="txtRecName"/>
                        <input type="hidden" value="4" name="txtMode"/>
                        <input type="submit" value="send" class="btn btn-success" style="width:100%;"/>
                    </form>
                </div>
            </div>
            <br/>
        </div>
    </body>
</html>
