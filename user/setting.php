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
                <center><h3>Setting:</h3></center>
                <hr/>
                <div class="frm">
                    <form  method="POST" action="umanager.php">
                        <label>Name:</label>
                        <?php 
                        $sql = "select * from users where uid='".$_SESSION['uid']."'";
                        $query = $auth->query($sql);
                        $row = mysql_fetch_assoc($query);
                        ?>
                        <input type="text" value="<?php echo $row['name']; ?>" name="txtName"/>
                        <label>Username:</label>
                        <input type="text" value="<?php echo $row['username']?>" name="txtUser"/>
                        <label>Email:</label>
                        <input type="text" value="<?php echo $row['email']; ?>" name="txtEmail"/>
                        <input type="hidden" value="1" name="txtMode"/><br/>
                        <input type="submit" class="btn btn-success"/>
                    </form>
                    <a href="#" id="CHpass">Change password:</a>
                </div>
                <div class="frm1">
                    <form  method="POST" action="umanager.php">
                        <label>Enter Old password:</label>
                        <input type="text" name="txtOpass"/>
                        <label>Enter New password:</label>
                        <input type="text" name="txtNpass"/>
                        <label>Retype New password:</label>
                        <input type="text" name="txtCheck"/>
                        <input type="hidden" value="2" name="txtMode"/><br/>
                        <input type="submit" class="btn btn-success"/>
                    </form>
                    <a href="#" id="back">Edit Detail</a>
                </div>
            </div>
            <br/>
        </div>
    </body>
</html>
