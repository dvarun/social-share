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
        <title>Welcome :: <?php echo $name; ?> ::</title>
        <script>
            $(function(){
                $(".frm1").hide();
                $("#CHpass").click(function(){
                    $(".frm").hide();
                    $("#CHpass").hide();
                    $(".frm1").show();
                }) ;
                $("#back").click(function(){
                    $(".frm").show();
                    $("#CHpass").show();
                    $(".frm1").hide();
                }) ;
            });
        </script>
    </head>
    <body>
        <!--starting of nav bar -->
        <?php include "/components/header.php"; ?>
        <!--End of nav bar -->    
        <div class="container wrap" >
            <br/>
            <div class="content" style="margin-left: 5%;margin-right: 5%;width:90%;text-align: left;">
                <center><h3>Manage Your Group</h3></center>
                <hr/>
                <div class="frm">
                    <table class="table table-striped">
                        <?php
                        $directory = '../APP-BOX/' . $gname . '/';
                        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
                        while ($it->valid()):
                            if (!$it->isDot()):
                                ?>
                                <tr>
                                    <td><?php echo $it->getFilename(); ?></td>
                                    <td>
                                        <form method="POST" action="umanager.php" id="del1">
                                        <!--<a href="../APP-BOX/<?php echo $gname . '/' . $it->getFilename(); ?>"/>Delete</a>-->
                                        <input type="hidden" name="txtMode" value="7"/>
                                        <input type="hidden" value="<?php echo "../APP-BOX/".$gname."/".$it->getFilename();?>" name="FLpath"/>
                                        <input type="submit" value="Delete File" class="btn btn-warning" onClick="if(confirm('Do you want to delete this file?')){this.submit();}else{return false;}"/>
                                        </form>
                                    </td>                                    
                                </tr>
                                <?php
                            endif;
                            $it->next();
                        endwhile;
                        ?>
                    </table>
                    <form action="umanager.php" method="POST">
                    <input type="submit" class="btn btn-large btn-danger" value="Delete Group"/>
                    <input type="hidden" value="6" name="txtMode"/>
                    <input type="hidden" value="<?php echo $gid;?>" name="grid"/>
                    </form>
                </div>
            </div>
            <br/>
        </div>
    </body>
</html>
