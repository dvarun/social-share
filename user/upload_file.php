<?php
include "../lib/DBA.php";
include "../lib/AUTH.php";
$auth = new AUTH();
if (!empty($_SESSION['uid'])) {
    $name = $_SESSION['name'];
} else {
    header("Location: ../index.php");
}
$gname = $_POST['gName'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
        <link rel="shortcut icon" href="../favi.ico" />
        <link rel="stylesheet" type="text/css" href="user-style.css" />
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <title>Welcome :: <?php echo $name; ?> ::</title>
    </head>
    <body>
        <!--starting of nav bar -->
        <?php include "/components/header.php"; ?>
        <!--End of nav bar -->    
        <div class="container wrap">
            <br/>
            <div class="content" style="margin-left: 5%;margin-right: 5%;width:90%;text-align: left;">
                <?php
                $valid_file = true;
                if (empty($_FILES['file']['name'])) {
                    echo 'Please select a file before uploading!';
                    echo '<a href="index.php">Go back</a>';
                    die();
                }

                if ($_FILES['file']['name']) {
                    //if no errors...
                    if (!$_FILES['file']['error']) {
                        
                        $new_file_name = strtolower($_FILES['file']['tmp_name']); //rename file
                        $mb = 1048576;
                        if ($_FILES['file']['size'] > 10485760) { //can't be larger than 8 MB
                            $valid_file = false;
                            echo 'Oops!  Your file\'s size is to large.';
                            echo '<a href="index.php">Go back</a>';
                        }

                        //if the file has passed the test
                        if ($valid_file) {
                            //move it to where we want it to be
                            move_uploaded_file($_FILES['file']['tmp_name'], '../APP-BOX/' . $gname . '/' . basename($_FILES['file']['name']));
                            echo 'Congratulations!  Your file was uploaded sucessfully.';
                            echo '<a href="index.php">Go back</a>';
                        }
                    }
                    //if there is an error...
                    else {
                        //set that to be the returned message
                        echo 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
                    }
                }
                ?>
            </div>
            <br/>
        </div>
    </body>
</html>
