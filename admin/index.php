<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if(!empty($_SESSION['aid']))
{
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css"/>
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }
            .form-signin {
                max-width: 300px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin input[type="text"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }

        </style>
        <title>Admin :: Sign in ::</title>
    </head>
    <body>
        <!--starting of nav bar -->
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand" href="index.php"><span style="color:#00ccff">Social Share</span></a>
                </div>
            </div>
        </div>
        <!--End of nav bar -->               
        <div class="container-fluid" style="margin-top: 60px;">
            <div class="well">
                <?php
                if (!empty($_POST['txtUser']) && !empty($_POST['txtPass'])) {
                    $user = mysql_real_escape_string($_POST['txtUser']);
                    $pass = md5($_POST['txtPass']);
                    if ($auth->log_in_admin($user, $pass) == 1) {
                        header("Location: admin.php");
                    } else {
                        echo "<center><h3>Please enter correct User name and Password</h3></center>";
                    }
                } else {
                    ?>
                    <form class="form-signin" method="POST" action="index.php">
                        <h2 class="form-signin-heading">Admin sign in</h2>
                        <input type="text" class="input-block-level" placeholder="User" name="txtUser">
                        <input type="password" class="input-block-level" placeholder="Password" name="txtPass">
                        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
                    </form>
                <?php } ?>
            </div><!-- container end -->
    </body>
</html>
