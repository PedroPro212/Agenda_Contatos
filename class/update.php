<?php

    class Update{
        function update($foto, $nome, $email, $tel, $aniversario){
            $query = "UPDATE contato SET foto=?, nome=?, email=?, tel=?, aniversario=? WHERE email='$email'";
            return $query;
        }

        function updateFoto($foto, $email){
            $query = "UPDATE contato SET foto=? WHERE email='$email'";
            return $query;
        }
    }

?>