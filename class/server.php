<?php

    class Conn{

        var $server = '127.0.0.1';
        var $user = 'root';
        var $password = '1234';
        var $bd = 'Agenda';
        function conn(){
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->bd);
            return $conn;
        }
    }

?>