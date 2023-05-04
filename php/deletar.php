<?php

    require_once('../class/server.php');
    $conn = new Conn;

    if($conn->conn()->connect_error){
        die("Falha na conexão com banco de dados: " . $conn->conn()->connect_error);
    }

    $mysqli = new mysqli('127.0.0.1', 'root', '1234', 'Agenda');
    
    $id = $_GET['id'];
    $query = "DELETE FROM contato WHERE id = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    // Verificar se a exclusão foi bem-sucedida
    if($stmt->affected_rows > 0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Atualizado com sucesso'); window.location.href='../index.php'
        </script>";
    } else{
        echo "Erro ao excluir o contato.";
    }

    $stmt->close();
    $conn->conn()->close();

    header("Refresh: 0");
    exit();

?>