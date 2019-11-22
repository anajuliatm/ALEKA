<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="shortcut icon" href="../fotos/favicon.ico" />

    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    if(isset($_SESSION['nome']) && $_SESSION['nome']!="deslogado")
    {
        session_start();
        echo"<script>window.alert('Você já está logado. Faça logout para acessar o cadastro!')</script>";
        echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'</script>";
        exit;
    }
    ?>
    <center>
        <div id="mae">

            <div id="cabecalho">

                <a href="home_html.php">
                    <div id="logo">
                        <img src="../fotos/aleka.png" width="120" height="120">
                    </div>
                </a>
                <div id="botoes">
                    <a href="../frontend/home_html.php"><button type="button" class="padrao">Home</button></a>
                    <a href="../frontend/cadastro_html.php"><button type="button" class="padrao" id="atual">Cadastro</button></a>
                    <a href="../frontend/produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                    <a href="../frontend/des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                    <a href="../frontend/sobre_html.php"><button type="button" class="padrao">Sobre</button></a>
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
            <div id="space">

            </div>
            <div class="fundo">
                <div id="cadastro">
                    <form name="cadastro" action="../backend/cadastro.php" method="post">
                        <div class="form-row">
                            <br>

                            <label for="inputAddress">Nome de usuário *</label>
                            <input type="text" name="nome" class="form-control" maxlength="18" id="inputAddress" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122" required>

                            <br>

                            <label for="inputAddress2">Telefone *</label>
                            <input type="text" name="telefone" class="form-control" id="inputAddress2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11" maxlength="11" required>

                            <br>

                            <label for="inputEmail4">Email *</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4" onchange="confirma_email()" required>

                            <br>

                            <label for="inputEmail4">Confirmar Email *</label>
                            <input type="email" name="conf_email" class="form-control" id="inputEmail4" onchange="confirma_email()" required>

                            <br>

                            <label for="inputPassword4">Senha *</label>
                            <input type="password" name="senha" class="form-control" id="inputPassword4" onchange="confirma_senha()" minlength="8" required>

                            <br>

                            <label for="inputPassword4">Confirmar Senha *</label>
                            <input type="password" name="conf_senha" class="form-control" id="inputPassword4" onchange="confirma_senha()" required>

                            <script>
                                function confirma_senha() {
                                    let senha = document.cadastro.senha;
                                    let senha_2 = document.cadastro.conf_senha;

                                    if (senha.value == senha_2.value) {
                                        senha_2.setCustomValidity('')

                                    } else {
                                        senha_2.setCustomValidity('As senhas estão diferentes...')
                                    }
                                }

                                function confirma_email() {
                                    let email = document.cadastro.email;
                                    let email_2 = document.cadastro.conf_email;

                                    if (email.value == email_2.value) {
                                        email_2.setCustomValidity('')
                                    } else {
                                        email_2.setCustomValidity('Os emails estão diferentes...')

                                    }
                                }

                            </script>

                            <br><br>

                            <button type="submit" class="btn btn-secondary">Cadastrar</button>&nbsp;
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                        </div>

                    </form>
                </div>
            </div>


            <div id="space">

            </div>
            <div id="rodape">
                <div class="btn-group mr-2" role="group" aria-label="First group">

                    <a href="../frontend/home_html.php"><button type="button" class="btn btn-secondary">Home</button></a>

                    <a href="../frontend/cadastro_html.php"><button type="button" class="btn btn-secondary">Cadastro</button></a>

                    <a href="../frontend/produtos_html.php"><button type="button" class="btn btn-secondary">Produtos</button></a>

                    <a href="../frontend/des_html.php"><button type="button" class="btn btn-secondary">Desenvolvimento</button></a>

                    <a href="../frontend/sobre_html.php"><button type="button" class="btn btn-secondary">Sobre</button></a>

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

                <!-- JAVASCRIPT -->
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
                        Ainda não é cadastrado? <a href="cadastro.html">Cadastre-se!</a>
                    </form>
                </div>



            </div>
        </div>
    </center>
</body>

</html>
