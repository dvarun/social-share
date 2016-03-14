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
        <script>
            $('#myModal').modal('show')
        </script>
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
        <title>Admin :: DashBoard ::</title>
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
                $sql = "select count(*) from users where online=1";
                $query = mysql_query($sql);
                if ($query) {
                    while ($row = mysql_fetch_array($query)) {
                        echo '<b>Number of Online user:</b><span class="label label-info">';
                        echo $row['0'];
                        echo "</span>";
                    }
                }
                ?>
                <hr/>
                <table class="table table-striped table-bordered" style="margin-top: 10px;">
                    <tr>
                        <td colspan="5"><center><h4>Users list</h4></center></td>
                    </tr>
                    <?php
                    $sql = "Select * from users";
                    $query = $auth->query($sql);
                    if ($query):
                        while ($row = mysql_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?php echo $row['uid']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><a href="manager.php?uid=<?php echo $row['uid']; ?>&mode=1">Edit</a></td>
                                <td><a href="manager.php?uid=<?php echo $row['uid']; ?>&mode=2">Delete</a></td>
                            </tr>
                            <?php
                        endwhile;
                    else:echo mysql_error();
                    endif;
                    ?>
                </table>
                <hr/>
                          <table class="table table-striped table-bordered" style="margin-top: 10px;">
                    <tr>
                        <td colspan="4"><center><h4>All Messages</h4></center></td>
                    </tr>
                    <?php
                    $sql = "Select * from messages";
                    $query = $auth->query($sql);
                    if ($query):
                        while ($row = mysql_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?php echo $row['msgId']; ?></td>
                                <td><?php echo $row['Message']; ?></td>
                                <td><?php echo $row['time']; ?></td>
                                <td><a href="manager.php?mid=<?php echo $row['msgId']; ?>&mode=4">Delete</a></td>
                            </tr>
                            <?php
                        endwhile;
                    else:echo mysql_error();
                    endif;
                    ?>
                </table>
            </div>
        </div>
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Add admin</h3>
            </div>
            <div class="modal-body">
                <ul class="nav nav-list">
                    <form method="GET" action="manager.php">
                        <label>User:*</label>
                        <input type="text" name="txtUser" style="width:100%;"/><br/>
                        <label>Password:*</label>
                        <input type="password" name="txtPass" style="width:100%;"/><br/>
                        <input type="hidden" name="mode" value="3"/>
                        <input type="submit" class="btn btn-success" style="width:100%;"/>
                    </form>
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </body>
</html>
