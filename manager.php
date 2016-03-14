<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
        <title>LOG MANAGER</title>
        <style>
            body{
                background-image: url(../bg/bg.gif);
                background-repeat:no-repeat;
                background-color:#c4e0ec;
            }
        </style>
    <body>
        <!--starting of nav bar -->
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php"><span style="color:#00ccff;">Social Share</span></a>
                </div>
            </div>
        </div>
        <!--End of nav bar --> 
        <div class="container" style="margin-top: 60px;">
            <div class="well">
                <center>
                    <?php
                    include 'lib/DBA.php';
                    include "lib/AUTH.php";
                    $mode = $_POST["txtMode"];
                    if ($mode == NULL) {
                        header("Location: index.php");
                    }
                    $auth = new AUTH();
                    switch ($mode) {
                        case 1://Register
                            $name = mysql_real_escape_string($_POST["txtFname"]);
                            $uname = mysql_real_escape_string($_POST["txtUname"]);
                            $email = mysql_real_escape_string($_POST["txtEmail"]);
                            $pass = md5($_POST["txtPass"]);
                            if (!$name || !$uname || !$email || !$pass) {
                                echo "Please fill all the field!";
                                echo '<a href="index.php">Go back</a> :)';
                                die();
                            } else {
                                if ($auth->checkUsername($uname) == 1) {
                                    echo '<h3>User name is <span style="color:Red;"> taken!</span></h3>';
                                    echo '<a href="index.php">Go back</a> :(';
                                    die();
                                } else {
                                    $auth->register($name, $uname, $email, $pass);
                                    echo "<h3>registered successfully!</h3>";
                                    echo '<a href="index.php">Please Go back and Login</a> :)';
                                }
                            }
                            break;

                        case 2://login
                            $loginUser = mysql_real_escape_string($_POST["txtLuser"]);
                            $loginPass = md5($_POST["txtLpass"]);
                            if (!$loginUser || !$loginPass) {
                                echo "<h3>Please Enter User name and password</h3>";
                                echo '<a href="index.php">Please Go back and Login</a> :)';
                            } else {
                                if ($auth->log_in($loginUser, $loginPass) == 1) {
                                    $sql = 'UPDATE users SET online = 1 WHERE username ="' . $loginUser . '";';
                                    $query = $auth->query($sql);
                                    if ($query) {
                                        header("Location: user/index.php");
                                    } else {
                                        die();
                                        echo "error occured";
                                    }
                                } else {
                                    echo "<h3>Please enter correct User name and Password</h3>";
                                    echo '<a href="index.php">Go back</a> :)';
                                }
                            }
                            break;
                            
                        default:
                            echo "Server error no mode found! :(";
                            echo '<a href="index.php">Go back</a> :)';
                            break;
                    }
                    ?>
                </center>
            </div>
        </div>
    </body>
</html>