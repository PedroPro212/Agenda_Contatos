<?php

    require_once('../class/server.php');
    require_once('../class/update.php');

    $conn = new Conn;
    $update = new Update;  

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $aniversario = $_POST['date'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['imagem']['tmp_name'];
        $conteudoFoto = file_get_contents($imagemTmp);

        $update->updateFoto($conteudoFoto, $email);
    } else {
        $conteudoFoto = null; 
    }

    $mysqli = new mysqli('127.0.0.1', 'root', '1234', 'Agenda');

    $query = "UPDATE contato SET foto=?, nome=?, tel=?, aniversario=? WHERE email=?";
    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('sssss', $conteudoFoto, $nome, $tel, $aniversario, $email);

    $stmt->execute();

    $stmt->close();

    echo "<script language='javascript' type='text/javascript'>
    alert('Atualizado com sucesso'); window.location.href='../index.html'
    </script>";

?>