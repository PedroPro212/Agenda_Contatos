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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
    <header>            
        <div style="display: flex;">
            <h1><img src="imgs/menu.svg" class="menu" id="icon_menu" alt="Menu" onclick="Encolher()"><img src="imgs/user.svg" alt="Usuário"> Contatos</h1>
            <div class="pesquisa">
                <img src="imgs/pesquisa.svg">
                <input type="text" class="text_pesquisa" placeholder="Pesquisa" onkeyup="pesquisaContatos()">
            </div>
        </div>
    </header>

    <script>
        function pesquisaContatos(){
            var input = document.querySelector('.text_pesquisa');
            var filter = input.value.toUpperCase();
            var table = document.getElementById('tabela-contatos');
            var rows = table.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var tdNome = rows[i].getElementsByTagName('td')[2];
                if (tdNome) {
                    var nome = tdNome.textContent || tdNome.innerText;
                    if (nome.toUpperCase().indexOf(filter) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }

        }
    </script>


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
                        $count = "SELECT COUNT(id) AS Contatos FROM contato";
                        $result = mysqli_query($conn->conn(), $sql);
                        $qts = mysqli_query($conn->conn(), $count);
                        $res = mysqli_fetch_assoc($qts);

                        
                        $qtsTotal = $res["Contatos"];
                        $label = 'count';
                        echo "<script>document.getElementById('$label').innerText = '$qtsTotal';</script>";

                        if(!$result){
                            echo "Erro ao executar a consulta: " . mysqli_error($conn->conn());
                            exit();
                        }

                    ?>

                    <script>

                        var contatoId;
                        // Função JavaScript para abrir modal apagar contato
                        function Deletar(id){
                            contatoId = id;
                            var div = document.querySelector('#modal');
                            var fade = document.querySelector('#fade');

                            if(div.style.display === 'none'){
                                div.style.display = 'block';
                                fade.style.display = 'block';
                            }else{
                                div.style.display = 'none';
                                fade.style.display = 'none';
                            }

                            console.log('teste');
                        }

                        function CancelarExcluir(){
                            var div = document.querySelector('#modal');
                            var fade = document.querySelector('#fade');

                            if(div.style.display === 'block'){
                                div.style.display = 'none';
                                fade.style.display = 'none';
                            }
                        }
                    </script>

                    <table id="tabela-contatos">
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
                                        echo "<td><a></a><img src='imgs/deletar.svg' id='excluir' width='20' style='cursor: pointer' onclick='Deletar(" . $row['id'] . ")'></td>";
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

                <style>
                    #fade{
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.6);
                        z-index: 5;
                    }

                    #modal{
                        position: fixed;
                        left: 50%;
                        top: 50%;
                        transform: translate(-50%, -50%);
                        background-color: #fff;
                        z-index: 10;
                        padding: 1.2rem;
                        border-radius: 0.5rem;
                    }

                    #modal.hide,
                    #fade.hide{
                        display: none;
                    }
                </style>

                <div id="fade" style="display: none">></div>
                <div id="modal" style="display: none">
                    <h3>Deseja apagar esse contato?</h3>
                    <button onclick="ExcluirContato()">Sim</button>
                    <button onclick="CancelarExcluir()">Cancelar</button>
                </div>

                <script>
                    function ExcluirContato(){
                        // Enviar solicitação AJAX para excluir o registro usando o contatoId
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange =function(){
                            if(this.readyState == 4 && this.status == 200){
                                // Ação a ser executada após a exclusão do registro
                                var modal = document.getElementById('modal');
                                var fade = document.getElementById('fade');
                                modal.style.display = 'none';
                                fade.style.display = 'none';
                            }
                        };
                        xhttp.open("GET", "php/deletar.php?id=" + contatoId, true);
                        console.log(contatoId);
                        xhttp.send();   

                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    }
                </script>

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