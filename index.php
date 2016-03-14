<?php
session_start();
if (!empty($_SESSION['uid'])) {
    header("Location: user/index.php");
}
if (!empty($_SESSION['aid'])) {
    header("Location: admin/index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="favi.ico" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/jqval.js"></script>       
        <title>Social Share</title>   
        <style>
            body{
<?php
$val = rand(1, 2);
if ($val == 2) {
    ?>
                    background-image: url('bg/1.jpg');
                    <?php
                } else if ($val == 1) {
                    ?>
                    background-image: url('bg/2.jpg');
                    <?php
                }
                ?>
                background-repeat: no-repeat;
                background-size:100%;
            }
            label.error{
                margin:0px;
            }
        </style>
        <script>
            $(function(){
                $("#loger").validate();
                $("#reger").validate();
            });
        </script>
    </head>
    <body>
        <!--starting of nav bar -->
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand" href="#"><span style="color:#00ccff;">Social Share</span></a>
                    <div class="pull-right">
                        <img src="cube.png" style="margin-top:4px;"/>
                    </div>
                </div>
            </div>
        </div>
        <!--End of nav bar -->    

        <div class="container" style="margin-top: 60px;">
            <div class="row-fluid">
                <div class="span7">
                    <div class="hero-unit" style="background-color:transparent;color:#006666;">
                        <h2>Welcome to Social Share!</h2>
                        <p>Portal where every one can share files and join groups of your own choice!</p>
                        <p>Also you can create your own group! :)</p>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                </div>
                <!--Login area -->
                <div class="span5 mywell" id="login">
                    <legend>User Login</legend>
                    <form method="POST" action="manager.php" id="loger">
                        <label for="user"></label>
                        <input type="text" id="user" class="required" name="txtLuser" placeholder="Username" minlength="5"/><br/>
                        <label for="pass"></label>
                        <input type="password" class="required" id="pass" name="txtLpass" placeholder="password" minlength="5"/><br/>
                        <input type="hidden"   name="txtMode" value="2"/>
                        <input type="submit" id="btn-log" value="submit" id="login" class="btn btn-success"/>
                        <a href="recover.php">forgot password</a>
                    </form>
                </div>
                <!--End Login area -->
                
                <!-- Register area -->
                <div class="span5 mywell2" id="register">
                    <legend>Register</legend>
                    <form  method="POST" action="manager.php" id="reger">
                        <label for="fname"></label>
                        <input type="text" id="fname" name="txtFname" placeholder="Full Name" class="required" minlength="5"/><br/>
                        <label for="uname"></label>
                        <input type="text" id="uname" name="txtUname" placeholder="User Name" class="required" minlength="5"/><br/>
                        <label for="email"></label>
                        <input type="text" id="email" name="txtEmail" class="required email" placeholder="email@yourdomain.com" minlength="6"/><br/>
                        <label for="password"></label>
                        <input type="password" id="password" name="txtPass" placeholder="password" class="required" minlength="5"/><br/>
                        <input type="hidden" name="txtMode" value="1"/>
                        <input type="submit" id="btn-reg" value="Sign Up" class="btn btn-warning"/><br/>
                    </form>
                </div>                
                <!--End Register area -->
            </div>
        </div>
    </body>
</html>