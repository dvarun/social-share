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
                <center><h3>Status feed</h3></center>
                <div class="frm" style="margin-right: 20px;">
                    <table class="table table-striped">
                        <?php
                        $sql = "select * from status order by status_id DESC;";
                        $query = $auth->query($sql);
                        while ($row = $auth->fetch($query)):
                            ?>
                            <tr>
                                <td><b><?php echo $row['name']; ?></b></td>
                                <td><?php echo $row['message']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
                <hr/>
            </div>
            <br/>
        </div>
    </body>
</html>
