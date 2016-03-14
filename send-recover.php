<?php
require 'lib/class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
// or try these settings (worked on XAMPP and WAMP):
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';
$mail->Username = "**********";
$mail->Password = "*********";

$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.

$mail->From = "varun.dube92@gmail.com";
$mail->FromName = "Social Share:: Password Recovery ::";
?>
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
                    //echo $_SERVER['HTTP_HOST']; localhost or current host address
                    include 'lib/DBA.php';
                    include "lib/AUTH.php";
                    $auth = new AUTH();
                    if (!empty($_POST['txtUser'])) {
                        $user = mysql_real_escape_string($_POST['txtUser']);
                        if ($auth->checkUsername($user) == 0) {
                            echo '<h3>User name is <span style="color:Red;">not available!</span></h3>';
                            echo '<a href="recover.php">Go back</a> :(';
                            die();
                        }
                        $regenerate_pass = rand(111111, 999999);
                        $hash = md5($regenerate_pass);
                        $sql = "update users set password='" . $hash . "' where username='" . $user . "'";
                        $query = $auth->query($sql) or mysql_error(die());
                        if ($query) {
                            $sql = "select email from users where username='" . $user . "';";
                            $query1 = $auth->query($sql);
                            while ($row = mysql_fetch_array($query1)) {
                                $email = $row['email'];
                            }
                            $mail->addAddress($email, "User");

                            $mail->Subject = "Social Share Password Recovery";
                            $mail->Body = "Dear '".$user."',<br /><br />You're password is'".$regenerate_pass."'.<br/><br/><br/> Thank you for using Social share";

                            if (!$mail->Send())
                                echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
                            else
                                echo "Email has been sent to :<b>".$email."</b>";
                        }
                    }else {
                        header("Location: index.php");
                    }
                    ?>
                </center>
            </div>
        </div>
    </body>
</html>
