<?php

class DBA {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "SocShare";
    public $con;

    public function __construct() {
        $con = mysql_connect($this->host, $this->user, $this->pass) or die(mysql_error());
        mysql_select_db($this->dbname) or die(mysql_error());
    }

    public function query($sql) {
        $ret = mysql_query($sql) or mysql_error();
        return $ret;
    }

    public function fetch($query) {
        return mysql_fetch_array($query);
    }

    public function __destruct() {
    }

}

?>
