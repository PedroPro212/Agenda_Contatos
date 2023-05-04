<?php

    require_once('../class/server.php');
    require_once('../class/new.php');

    $conn = new Conn;
    $create = new Create;


    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $aniversario = $_POST['date'];
    $completo = $nome . ' ' . $sobrenome;

    // Verifique se um arquivo foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['imagem']['tmp_name'];
        $conteudoFoto = file_get_contents($imagemTmp);
    } else {
        $conteudoFoto = null; 
    }

    $mysqli = new mysqli('127.0.0.1', 'root', '1234', 'Agenda');

    $stmt = $mysqli->prepare($create->create($conteudoFoto, $completo, $email, $tel, $aniversario));

    $stmt->bind_param('sssss', $conteudoFoto, $completo, $email, $tel, $aniversario);

    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Contato cadastrado com sucesso'); window.location.href='../index.php'
        </script>";
    }

    //$query = $create->create($foto, $completo, $email, $tel, $aniversario);
    //$insert = mysqli_query($conn->conn(), $query) or die("Erro ao cadastrar");

?>