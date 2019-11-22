<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Sobre</title>
    <link rel="shortcut icon" href="../fotos/favicon.ico" />

    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    ?>
    <center>
        <div id="mae">

            <div id="cabecalho">

                <div id="logo">
                    <a href="home_html.php"><img src="../fotos/aleka.png" width="120" height="120"></a>
                </div>
                <div id="botoes">
                    <a href="home_html.php"><button type="button" class="padrao">Home</button></a>
                    <a href="cadastro_html.php"><button type="button" class="padrao">Cadastro</button></a>
                    <a href="produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                    <a href="des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                    <a href="sobre_html.php"><button type="button" class="padrao" id="atual">Sobre</button></a>
                </div>
                <div id="icones">
                    <br>
                    <?php 
                    if($_SESSION['nome']=="deslogado" || !isset($_SESSION['nome']))
                    { ?>
                    <button class="open-button" onclick="openForm()">
                        <div id="login"><img src="../fotos/login.png" width="50" height="50"></div>
                    </button>
                    <?php       
                    }
                    if($_SESSION['nome']!="deslogado" && isset($_SESSION['nome']))
                    { ?>
                    <button class="popup" onclick="myFunction()">
                        <div id="login"><img src="../fotos/login.png" width="50" height="50"></div>
                        <span class="popuptext" id="myPopup">Bem-vindo <b><?php echo $_SESSION["nome"]."<br><a href='../backend/logout.php' id='buy'>Logout</a>" ; ?></b></span>
                    </button>
                    <?php
                    }
                     ?>
                    <div id="carrinho"><a href="carrinho_html.php"><img src="../fotos/carrinho.png" width="50" height="50"></a></div>

                </div>
            </div>

            <div id="space"></div>
            <div class="sob">
                <div id="sobre">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h3>A Empresa</h3>
                        </li>


                        <li class="list-group-item list-group-item-primary">Idealizada no dia 08/02/2019 pelos alunos Amanda, Ana Julia, Eduardo, Kaio e Luiz Henrique. Nossos produtos, popsoketes, são assesórios de celular com o objetivo de trazer conforto ao cliente durante o uso do aparelho.</li>
                        <li class="list-group-item list-group-item-secondary"><b>Missão:</b> Vender acessórios que aprimorem a experiência de uso dos clientes possuidores de smartphones e tablets. </li>
                        <li class="list-group-item list-group-item-success"><b>Visão:</b> Ser líder em vendas de gadgets para dispositivos móveis trazendo qualidade e variedade para os clientes.</li>
                        <li class="list-group-item list-group-item-danger"><b>Valores:</b></li>
                        <li class="list-group-item list-group-item-warning">- Qualidade na prestação de atendimento ao cliente;</li>
                        <li class="list-group-item list-group-item-info">- Crescimento e desenvolvimento sustentável;</li>
                        <li class="list-group-item list-group-item-light">- Responsabilidade social;</li>
                        <li class="list-group-item list-group-item-dark">- Atividades com base em respeito e honestidade.</li>
                    </ul>
                </div>
            </div>
            <div id="space"></div>

            <div id="rodape">
                <div class="btn-group mr-2" role="group" aria-label="First group">

                    <a href="home_html.php"><button type="button" class="btn btn-secondary">Home</button></a>

                    <a href="cadastro_html.php"><button type="button" class="btn btn-secondary">Cadastro</button></a>

                    <a href="produtos_html.php"><button type="button" class="btn btn-secondary">Produtos</button></a>

                    <a href="des_html.php"><button type="button" class="btn btn-secondary">Desenvolvimento</button></a>

                    <a href="sobre_html.php"><button type="button" class="btn btn-secondary">Sobre</button></a>

                </div>
                <br><br>
                <a href="#top"><button type="button" class="btn btn-secondary">Voltar ao topo ↑ </button></a>
                <?php
                if($_SESSION['admin']=='s')
                {
                ?>
                <a href="../frontend/admin_html.php"><button type="button" class="btn btn-secondary">Administradores</button></a>
                <?php
                }
                ?>
                <br><br>
                Amanda, nº2 - Ana Julia, nº3 <br>
                Eduardo, nº7 - Kaio, nº20 <br>
                Luiz, nº24
                <script>
                    function openForm() {
                        document.getElementById("myForm").style.display = "block";
                    }

                    function closeForm() {
                        document.getElementById("myForm").style.display = "none";
                    }

                    function myFunction() {
                        var popup = document.getElementById("myPopup");
                        popup.classList.toggle("show");
                    }

                </script>



                <div class="form-popup" id="myForm">
                    <form method="post" action="../backend/login_certo.php" class="form-container">
                        <h1>Login</h1>

                        <label for="email"><b>E-mail/usuário</b></label>
                        <input type="text" placeholder="Insira e-mail/usuário" name="nome_log" required>

                        <label for="psw"><b>Senha</b></label>
                        <input type="password" placeholder="Insira senha" name="senha_log" required>
                        <a href="esqueci_html.php"><br>Esqueci minha senha</a>
                        <button type="submit" class="btn">Login</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Fechar</button>
                        Ainda não é cadastrado? <a href="cadastro_html.php">Cadastre-se!</a>
                    </form>
                </div>

            </div>
        </div>

    </center>
</body>

</html>
