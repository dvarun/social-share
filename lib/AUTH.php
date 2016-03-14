<?php

class AUTH extends DBA {

    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function checkUsername($username) {
        $sql = "select username from users where username='" . $username . "' ";
        $chk = parent::query($sql);
        if (mysql_num_rows($chk) == 1) {
            return 1;
        }
    }

    public function register($name, $username, $email, $password) {
        $sql = "INSERT INTO users (name,username, Password, email)";
        $sql.= " VALUES('" . $name . "','" . $username . "','" . $password . "','" . $email . "')";
        $query = mysql_query($sql);
        if(!$query){
            echo mysql_error();
        }
    }
    public function register_admin( $username, $password) {
        $sql = "INSERT INTO user_admin (user, password)";
        $sql.= " VALUES('" . $username . "','" . $password . "')";
        $query = mysql_query($sql);
        if(!$query){
            echo mysql_error();
        }
    }

    public function log_in($username, $password) {
        $sql = "select * from users where username='".$username."' AND password='".$password."'";
        $query = parent::query($sql);
        $num = mysql_num_rows($query);
        if($num == 1)
        {
            $row = mysql_fetch_assoc($query);
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['uname'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
         return 1;
        }
    }
    public function log_in_admin($username, $password) {
        $sql = "select * from user_admin where user='".$username."' AND password='".$password."'";
        $query = parent::query($sql);
        $num = mysql_num_rows($query);
        if($num == 1)
        {
            $row = mysql_fetch_assoc($query);
            $_SESSION['aid'] = $row['aid'];
            $_SESSION['uname'] = $row['user'];
         return 1;
        }
    }

    public function logout() {
        session_destroy();
        session_unset();
    }

    public function __destruct() {
        parent::__destruct();
    }

}

?>