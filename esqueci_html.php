<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Esqueci</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <center>
        <div id="mae">

            <div id="cabecalho">

                <div id="logo">
                    <img src="../fotos/aleka.png" width="120" height="120">
                </div>
                <div id="botoes">
                    <a href="home_html.php"><button type="button" class="padrao">Home</button></a>
                    <a href="cadastro_html.php"><button type="button" class="padrao">Cadastro</button></a>
                    <a href="produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                    <a href="des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                    <a href="sobre_html.php"><button type="button" class="padrao">Outros</button></a>

                </div>
                <div id="icones">
                    <br>
                    <button class="open-button" onclick="openForm()">
                        <div id="login"><img src="../fotos/login.png" width="50" height="50"></div>
                    </button>
                    <div id="carrinho"><a href="carrinho.html"><img src="../fotos/carrinho.png" width="50" height="50"></a></div>

                </div>
            </div>


            <div id="esqueci">

                <div id="formesqueci">
                    <img src="../fotos/esqueci.png" alt="">
                    <br>
                    <br>
                    <form method="post" action="../backend/email_senha.php">
                        <strong>Problemas para acessar?</strong> <br>
                        <sub>Insira seu nome de usuário ou email e enviaremos a você um link para voltar a acessar sua conta</sub>
                        <br><br>
                        <label class="sr-only" for="inlineFormInputGroupUsername2">Usuário ou e-mail</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Usuário ou e-mail" name="email_cliente">
                        </div>
                        <button class="btnesqueci">Enviar link</button><br><br>
                        <a href="cadastro_html.php">Não é cadastrado? Cadastre-se</a>
                    </form>
                </div>

            </div>


            <div id="rodape">
                <div class="btn-group mr-2" role="group" aria-label="First group">

                    <a href="home_html.php"><button type="button" class="btn btn-secondary">Home</button></a>

                    <a href="cadastro_html.php"><button type="button" class="btn btn-secondary">Cadastro</button></a>

                    <a href="produtos_html.php"><button type="button" class="btn btn-secondary">Produtos</button></a>

                    <a href="des_html.php"><button type="button" class="btn btn-secondary">Desenvolvimento</button></a>

                    <a href="sobre_html.php"><button type="button" class="btn btn-secondary">Outros</button></a>

                </div>
                <br><br>
                <a href="#top"><button type="button" class="btn btn-secondary">Voltar ao topo ↑ </button></a>
                <span onclick="openNav()"><button class="btn btn-secondary">OPÇÕES</button></span>
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
