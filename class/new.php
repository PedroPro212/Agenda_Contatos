<?php

    class Create{
        function create($foto, $nome, $email, $tel, $aniversario){
            $query = "INSERT INTO contato VALUES(NULL, ?, ?, ?, ?, ?)";
            return $query;
        }
    }
?>