<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="../style/index.css" type="text/css" rel="stylesheet">
    <link href="../style/new.css" type="text/css" rel="stylesheet">
    <link href="../style/update.css" type="text/css" rel="stylesheet">

</head>
<body>
    <header>            
        <div style="display: flex;">
            <a href="../index.php" style="text-decoration:none"><h1><img src="../imgs/menu.svg" class="menu" id="icon_menu" alt="Menu" onclick="Encolher()"><img src="../imgs/user.svg" alt="Usuário"> Contatos</h1></a>
            <div class="pesquisa">
                <img src="../imgs/pesquisa.svg">
                <input type="text" class="text_pesquisa" placeholder="Pesquisa">
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <header class="menu col-sm-3" id="menu">
                <a><button id="new" onclick="New()">
                    <img src="../imgs/mais.svg" alt="+"> Criar contato
                </button></a><br>
                <div class="opcoes">
                    <a href="../index.php"><img src="../imgs/user.svg"> Contatos <label id="count"></label></a>
                </div>
            </header>

            <?php

                require_once('../class/server.php');
                $conn = new Conn;

                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM contato WHERE id = $id";
                    $result = mysqli_query($conn->conn(), $sql);

                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                        $nome = $row['nome'];
                        $email = $row['email'];
                        $tel = $row['tel'];
                        $aniversario = $row['aniversario'];
                    }else{
                        header("Location: ../index.php");
                        exit();
                    }
                }else{
                    header("Location: ../index.php");
                    exit();
                }

            ?>

            <div class="col-sm-8" id="conteudo">
                <section>
                    <form action="../php/update.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"><br>
                        <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
                        <input type="email" name="email" value="<?php echo $email; ?>"><br>
                        <input type="tel" name="tel" value="<?php echo $tel; ?>"><br>
                        <input type="date" name="aniversario" value="<?php echo $aniversario; ?>"><br>

                        <input type="submit" value="Atualizar">
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script src="../script/index.js"></script>
    <script src="../script/new.js"></script>
</body>
</html>