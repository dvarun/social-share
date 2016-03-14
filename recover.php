<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/jqval.js"></script>       
        <title>PASSWORD Recover!</title>
        <style>
            body{
                background-image: url(../bg/bg.gif);
                background-repeat:no-repeat;
                background-color:#c4e0ec;
            }
        </style>
        <script>
            $(function(){
                $("#reco").validate();
            });
        </script>
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
                    <form action="send-recover.php" method="POST" id="reco">
                        <label for="User"><b>Enter Username:</b></label>
                        <input type="text" class="required" placeholder="EG: John" name="txtUser" id="User"/><br/>
                        <input type="hidden" value="<?php echo $_SERVER['HTTP_HOST'];?>" name="txtHost"/>
                        <input type="submit" class="btn btn-success" value="Submit"/>
                    </form>
                    <small>Don't worry we email you new password :)</small>
                </center>
            </div>
        </div>
    </body>
</html>