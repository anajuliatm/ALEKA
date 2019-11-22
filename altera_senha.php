<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar senha</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../fotos/favicon.ico" />

</head>
<body>
  <?php
    session_start();
    $_SESSION['email'] = $_GET['email_cliente'];
    if(empty($_SESSION['email']))
    {
        session_start();
        echo"<script>window.alert('Você deve estar logado para acessar essa área!')</script>";
        echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/cadastro_html.php'</script>";
        exit;
    }
    ?>
   <center>
        <div id="mae">

            <div id="cabecalho">

                <div id="logo">
                    
                    <a href="home_html.php"><img src="../fotos/aleka.png" width="120" height="120"></a>

                </div>

                <div id="botoes">
                    <a href="home_html.php"><button type="button" class="padrao" id="atual">Home</button></a>
                    <a href="cadastro_html.php"><button type="button" class="padrao">Cadastro</button></a>
                    <a href="produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                    <a href="des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                    <a href="sobre_html.php"><button type="button" class="padrao">Sobre</button></a>
                </div>
                <div id="icones">
                    <br>
                        <button class="open-button" onclick="openForm()"> 
                            <div id="login"><img src="../fotos/login.png" width="50" height="50"></div>
                        </button>
                    <div id="carrinho"><a href="carrinho_html.php"><img src="../fotos/carrinho.png" width="50" height="50"></a></div>
                </div>
            </div>
            <div id="space">

            </div>

            <?php
    //Conexão com o Banco de Dados:
    include "../backend/conecta.php";
    //Captura email por método get. Enviado para o email do cliente
    $email_cliente = $_GET['email_cliente'];
    //Consulta pra ver se o e-mail existe:
    $sql="SELECT * FROM public.cliente WHERE email_cliente = '".$email_cliente."';";
    $resultado=pg_query($conecta,$sql);
    $qtde=pg_num_rows($resultado);
    //Caso não exista:
    if($qtde==0)
    {
        echo"<script>window.alert('O e-mail não existe! Você será redirecionado à página anterior!')</script>";
        echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/esqueci_html.php'>";
    }
        $linha = pg_fetch_array($resultado);
    ?>
    <!--Vai começa o html-->
    <div class="fundo">
                <div id="cadastro">
                    <form name="altera" action="../backend/gravar_senha.php" method="post">
                        <div class="form-row">
                            <br>

                            <label for="inputAddress">Identificação:</label>
                            <input type="text" name="id_cliente" class="form-control" id="inputAddress" value="<?php echo $linha[id_cliente]; ?>" readonly>

                            <br>

                            <label for="inputAddress2">Nome:</label>
                            <input type="text" name="email_cliente" value="<?php echo $linha[nome_cliente]; ?>" class="form-control" id="inputAddress2" readonly>

                            <br>

                            <label for="inputEmail4">Email:</label>
                            <input type="email" name="email_cliente" value="<?php echo $linha[email_cliente]; ?>" class="form-control" id="inputEmail4" readonly>

                            <br>

                            <label for="inputEmail4">Telefone:</label>
                            <input type="text" name="telefone_cliente" value="<?php echo $linha[telefone_cliente] ?>" class="form-control" id="inputEmail4" readonly>

                            <br>
                            <label for="inputPassword4">Nova Senha *</label>
                            <input type="password" name="senha" onchange="confirma_senha()" class="form-control" id="inputPassword4" minlength="8" required>
                            
                            <br>

                            <label for="inputPassword4">Confirmar Nova Senha *</label>
                            <input type="password" name="conf_senha" class="form-control" id="inputPassword4" onchange="confirma_senha()" required>
                            
                            <script>
                                function confirma_senha() {
                                    let senha = document.altera.senha;
                                    let senha_2 = document.altera.conf_senha;

                                    if (senha.value == senha_2.value) {
                                        senha_2.setCustomValidity('')

                                    } else {
                                        senha_2.setCustomValidity('As senhas estão diferentes...')
                                    }
                                }

                            </script>
                            
                            <br><br>

                            <button type="submit" class="btn btn-secondary">Alterar</button>&nbsp;
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                        </div>

                    </form>
                </div>
            </div>
            <div id="space">

            </div>
            <div id="rodape">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="home_html.php"><button type="button" class="btn btn-secondary">Home</button></a>
                    <a href="cadastro_html.php"><button type="button" class="btn btn-secondary">Cadastro</button></a>
                    <a href="produtos.html"><button type="button" class="btn btn-secondary">Produtos</button></a>
                    <a href="des_html.php"><button type="button" class="btn btn-secondary">Desenvolvimento</button></a>
                    <a href="sobre.html"><button type="button" class="btn btn-secondary">Sobre</button></a>

                </div>
                <br><br>
                <a href="#top"><button type="button" class="btn btn-secondary">Voltar ao topo ↑ </button></a>
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

                    function openFormLogado(){
                        document.getElementById("myFormLogado").style.display = "block";
                    }
                    function closeFormLogado(){
                        document.getElementById("myFormLogado").style.display = "none";
                    }
                </script>
                <div class="form-popup" id="myForm">
                    <form method="post" action="../backend/login_certo.php" class="form-container">
                        <h1>Login</h1>
                        <label for="email"><b>E-mail/usuário</b></label>
                        <input type="text" placeholder="Insira e-mail/usuário" name="nome_log" required>
                        <label for="psw"><b>Senha</b></label>
                        <input type="password" placeholder="Insira senha" name="senha_log" required>
                        <a href="esqueci.html"><br>Esqueci minha senha</a>
                        <button type="submit" class="btn">Login</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Fechar</button>
                        Ainda não é cadastrado? <a href="cadastro_html.php">Cadastre-se!</a>
                    </form>
                </div>

                <div class="form-popup" id="myFormLogado">
                    <a href="../backend/logout.php"><br>Logout</a>
                </div>

                
            </div>
        </div>
    </center>
    
</body>
</html>