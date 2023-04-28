<?php

    require_once('../class/server.php');
    require_once('../class/new.php');

    $conn = new Conn;
    $create = new Create;

    $foto = $_POST['imagem'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $aniversario = $_POST['date'];
    $completo = $nome . ' ' . $sobrenome;

    $query = $create->create($foto, $completo, $email, $tel, $aniversario);
    $insert = mysqli_query($conn->conn(), $query) or die("Erro ao cadastrar");
    echo "<script language='javascript' type='text/javascript'>
    alert('Contato cadastrado com sucesso'); window.location.href='../index.html'
    </script>";

?>