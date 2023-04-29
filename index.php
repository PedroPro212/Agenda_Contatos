<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="style/index.css" type="text/css" rel="stylesheet">
    <link href="style/new.css" type="text/css" rel="stylesheet">
    <link href="style/update.css" type="text/css" rel="stylesheet">
</head>
<body>
    <header>            
        <div style="display: flex;">
            <h1><img src="imgs/menu.svg" class="menu" id="icon_menu" alt="Menu" onclick="Encolher()"><img src="imgs/user.svg" alt="Usuário"> Contatos</h1>
            <div class="pesquisa">
                <img src="imgs/pesquisa.svg">
                <input type="text" class="text_pesquisa" placeholder="Pesquisa">
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            
            <header class="menu col-sm-3" id="menu">
                <a><button id="new" onclick="New()">
                    <img src="imgs/mais.svg" alt="+"> Criar contato
                </button></a><br>
                <div class="opcoes">
                    <a href="index.php"><img src="imgs/user.svg"> Contatos <label id="count"></label></a>
                </div>
            </header>

            <main class="col-sm-8" id="conteudo">
                <section id="contatos">

                <?php

                    require_once('class/server.php');
                    $conn = new Conn;

                    $sql = "SELECT id, foto, nome, email, tel, aniversario FROM contato";
                    $result = mysqli_query($conn->conn(), $sql);

                    if(!$result){
                        echo "Erro ao executar a consulta: " . mysqli_error($conn->conn());
                        exit();
                    }

                ?>

                    <table>
                        <thead>
                            <tr>
                                <th style="display:none">Id</th>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tel</th>
                                <th>Aniversario</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<tr>";
                                        echo "<td style='display:none'>" . $row["id"] . "</td>";
                                        echo "<td><img src='data:image/png;base64," . base64_encode($row['foto']) . "'alt='Foto Perfil' width='20'/></td>";
                                        echo "<td>" . $row["nome"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["tel"] . "</td>";
                                        echo "<td>" . date("d/m/Y", strtotime($row["aniversario"])) . "</td>";
                                        echo "<td><a href='view/update.php?id=" . $row['id'] . "'><img src='imgs/editar.svg' width='20' style='cursor: pointer'></a></td>";
                                        echo "<td><a></a><img src='imgs/deletar.svg' id='excluir' width='20'></td>";
                                        echo "</tr>";
                                    }
                                    $conn->conn()->close();
                                }else{
                                    echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>

                </section>

                <section id="criar">
                    <a><button class="cancelar" onclick="Cancelar()">
                        X
                    </button></a>
                    <form method="post" action="php/new.php" enctype="multipart/form-data">
                        
                        <label for="imagem" class="imagem" onclick="Image()">
                            <img src="imgs/imagem.svg" class="icon_img" width="35">
                            <input type="file" class="new" name="imagem" id="imagem" accept=".jpg,.png,.jpeg" required style="display: none;">
                        </label>
                        <label id="nome-completo"></label>
                        <br>
                        <input type="text" class="new" name="nome" id="nome" placeholder="Nome" onchange="Nome()" required><br>
                        <input type="text" class="new" name="sobrenome" id="sobrenome" placeholder="Sobrenome" onchange="Nome()" required><br>
                        <input type="email" class="new" name="email" id="email" placeholder="Email" required><br>
                        <input type="tel" class="new" name="tel" id="tel" placeholder="Telefone" required><br>
                        <input type="date" class="new" name="date" id="date" required><br>

                        <input type="submit" id="salvar" value="Salvar">
                    </form>
                </section>
            </main>
        </div>
    </div>

    <script src="script/index.js"></script>
    <script src="script/new.js"></script>

</body>
</html>