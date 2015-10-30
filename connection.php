<?php

class createCon  {
    var $host = 'mysql.hostinger.de';
    var $user = 'u659698584_ilyas';
    var $pass = 'ilyasmysql';
    var $db = 'u659698584_kalo';
    var $myconn;


    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$con) {
            die('Verbindung zum Server konnte nicht hergestellt werden!');
        } else {
            $this->myconn = $con;}
        return $this->myconn;
    }

    function close() {
        mysqli_close($myconn);
        echo 'Connection closed!';
    }

}

?>

