<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
} else {
    header("Location: ../index.php");
}
$gid = $_GET['gid'];
if ($gid == NULL) {
    header("Location: index.php");
} else {
    $sql = "Select * from groups where gid = '" . $gid . "'";
    $query = $auth->query($sql);
    while ($row = mysql_fetch_array($query)) {
        $gname = $row['gname'];
    }
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
                echo "<center><h3>" . $gname . "</h3></center>";
                ?>
                <hr/>
                <br/>
                <div class="frm" style="margin-right: 20px;">
                    <form action="upload_file.php" method="post" enctype="multipart/form-data">
                        <label for="file">Filename:</label>
                        <input type="file" name="file" id="file"><br>
                        <input type="hidden" name="gName" value="<?php echo $gname;?>"/>
                        <input type="submit" name="submit" value="Upload"/>
                    </form>

                    <table class="table table-striped">
                        <?php
                        $directory = '../APP-BOX/' . $gname . '/';
                        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
                        while ($it->valid()):
                            if (!$it->isDot()):
                                ?>
                                <tr>
                                    <td><?php echo $it->getFilename(); ?></td>
                                    <td><a href="../APP-BOX/<?php echo $gname . '/' . $it->getFilename(); ?>"/>Download</a></td>
                                </tr>
                                <?php
                            endif;
                            $it->next();
                        endwhile;
                        ?>
                    </table>
                </div>
            </div>
            <br/>
        </div>
    </body>
</html>
