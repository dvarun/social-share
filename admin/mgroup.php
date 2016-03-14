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
                <table class="table table-striped">
                    <tr>
                        <td colspan="2"><h3>Groups</h3></td>
                    </tr>
                    <?php
                    $sql = "select * from groups order by gid DESC";
                    $query = $auth->query($sql);
                    if ($query):
                        while ($row = mysql_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?php echo $row['gname']; ?></td>
                                <td><a href="manager.php?grid=<?php echo $row['gid'];?>&mode=5">Delete</a></td>
                            </tr>
                            <?php
                        endwhile;
                    endif;
                    ?>
                </table>
                <br/>
            </div>
    </body>
</html>
