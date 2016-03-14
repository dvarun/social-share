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
        <script src="../bootstrap/js/jqval.js"></script>
        <title>Welcome :: <?php echo $name; ?> ::</title>
        <script>
            $(function(){
                $("#Grpost").validate();
                $("#Prpost").validate();
            });
            $(function(){
                $("#Prpost").hide();
                $("#public-creator").hide();
                $("#feeds").hide();
                $("#private-creator").click(function(){
                    $("#Prpost").show('slow');
                    $("#public-creator").show('slow');
                    $("#Grpost").hide('slow');
                    $("#private-creator").hide('slow');
                    
                });
                $("#public-creator").click(function(){
                    $("#Grpost").show('slow');
                    $("#private-creator").show('slow');
                    $("#Prpost").hide('slow');
                    $("#public-creator").hide();
                });
                $("#show-feed").click(function(){
                    $("#feeds").show('slow');
                    $("#show-feed").hide('slow');
                });
                $("#hide-feed").click(function(){
                    $("#feeds").hide('slow');
                    $("#show-feed").show('slow');
                });
            });
        </script>
    </head>
    <body>
        <!--starting of nav bar -->
        <?php include "/components/header.php"; ?>
        <!--End of nav bar -->    
        <div class="container wrap">
            <br/>
            <div class="row">
                <div class="span3">
                    <div class="box">
                        <ul class="nav nav-list">
                            <li class="nav-header">MENU</li>        
                            <li><a href="#" id="searchBtn"><i class="icon-search"></i> Search</a></li>
                        </ul>
                    </div>
                    <div class="box" style="margin-top: 2%;">
                        <b>New Groups</b>
                        <ul class="nav nav-list">
                            <?php
                            $sql = "select * from groups order by gid DESC limit 0,3;";
                            $query = $auth->query($sql);
                            if ($query):
                                while ($row = mysql_fetch_array($query)) :
                                    ?> 
                                    <li><a href="group.php?gid=<?php echo $row['gid']; ?>"><?php echo $row['gname']; ?></a></li>
                                    <?php
                                endwhile;
                            else :
                                echo mysql_error();
                            endif;
                            ?>
                        </ul>
                    </div>
                    <div class="box" style="margin-top: 2%">
                        <b>Manage your groups</b>
                        <?php
                        $sql = "select * from groups where uid=" . $_SESSION['uid'];
                        $query = $auth->query($sql);
                        if ($query):
                            while ($row = mysql_fetch_array($query)):
                                ?>
                                <ul class="nav nav-list">
                                    <li><a href="user-grp-manager.php?gid=<?php echo $row['gid']; ?>"><?php echo $row['gname']; ?></a></li>
                                </ul>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
                <div class="span9">
                    <div class="content">
                        <h3 style="margin-left:2%;">DASH BOARD</h3>
                        <hr/>
                        <br/>
                        <form method="POST" action="umanager.php">
                            <input type="text" name="txtStatus" style="width:97%" placeholder="What's happening today?"/><br/>
                            <input type="hidden" name="txtUid" value="<?php echo $_SESSION['uid'];?>"/>
                            <input type="hidden" name="txtName" value="<?php echo $name;?>"/>
                            <input type="hidden" name="txtMode" value="8"/>
                            <input type="submit" class="btn btn-success"/>
                            <a href="#" id="show-feed">Show feeds.....</a>
                        </form>
                        <div id="feeds">
                            <table class="table table-striped">
                                <?php 
                                $sql = "select * from status order by status_id DESC limit 0,3;";
                                $query = $auth->query($sql);
                                while($row = $auth->fetch($query)):
                                ?>
                                <tr>
                                    <td><b><?php echo $row['name'];?></b></td>
                                    <td><?php echo $row['message'];?></td>
                                </tr>
                                <?php endwhile;?>
                                <tr>
                                    <td colspan="2"><a href="#" id="hide-feed" class="pull-right">Hide feeds..</a> <a href="feeds.php">More feeds...</a></td>
                                </tr>
                            </table>
                           
                        </div>
                        <hr/>
                        <br/>
                        <div id="new-group" class="well">
                            <!-- Group creation -->
                            <form method="POST" action="umanager.php" id="Grpost">
                                <label>Group Name</label>
                                <label for="grp"></label>
                                <input type="text" name="txtGroup" placeholder="EG: DOCUMENTS" id="grp" class="required" minlength="4"/><br/>
                                <input type="hidden" name="txtMode" value="3"/>
                                <input type="submit" class="btn btn-primary"/>
                            </form>
                            <!--              <a href="#" id="private-creator">Click here to Create Private Group</a> -->
                            <!-- Private group creation -->
                            <form method="POST" action="umanager.php" id="Prpost">
                                <label>Private Group Name</label>
                                <label for="prp"></label>
                                <input type="text" name="txtPGroup" placeholder="EG: DOCUMENTS" id="prp" class="required" minlength="4"/><br/>
                                <input type="hidden" name="txtMode" value="5"/>
                                <input type="submit" class="btn btn-primary"/>
                            </form>
                            <a href="#" id="public-creator">Back</a>
                        </div>
                        <div id="group-list">
                            <table class="table table-bordered table-striped tbl-set">
                                <tr>
                                    <td colspan="2"><center><h4>Groups</h4></center></td>
                                </tr>
                                <?php
                                $sql = "select * from groups order by gid DESC;";
                                $query = $auth->query($sql);
                                if ($query):
                                    while ($row = mysql_fetch_array($query)) :
                                        ?>
                                        <tr>
                                            <td><a href="group.php?gid=<?php echo $row['gid']; ?>"><?php echo $row['gname'] ?></a></td>
                                            <td><a href="group.php?gid=<?php echo $row['gid']; ?>">Browse</a></td>
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
                </div>
            </div><!-- row close -->
            <br/>
        </div>
    </body>
</html>


