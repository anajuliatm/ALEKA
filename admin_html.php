<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Aleka</title>
    <link rel="shortcut icon" href="../fotos/favicon.ico" />
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    if(!isset($_SESSION) || empty($_SESSION['nome']) || $_SESSION['nome']=="deslogado")
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
                    <img src="../fotos/aleka.png" width="120" height="120">
                </div>
                <div id="botoes">
                    <span onclick="openNav()"><button class="btn btn-secondary">OPÇÕES</button></span>
                    <!--
                    <a href="home_html.php"><button type="button" class="padrao">Home</button></a>
                    <a href="cadastro_html.php"><button type="button" class="padrao">Cadastro</button></a>
                    <a href="produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                    <a href="des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                    <a href="sobre_html.php"><button type="button" class="padrao">Outros</button></a>
-->


                </div>
                <div id="icones">
                    <br>
                    <button class="popup" onclick="myFunction()">
                        <div id="login"><img src="../fotos/admin.png" width="50" height="50"></div>
                        <span class="popuptext" id="myPopup">Bem-vindo <b><?php echo $_SESSION["nome"]."<br><a href='../backend/logout.php' id='buy'>Logout</a>" ; ?></b></span>
                    </button>
                    <div id="carrinho"><a href="carrinho_html.php"><img src="../fotos/carrinhoatual.png" width="50" height="50"></a></div>

                </div>
            </div>
            <div id="space">

            </div>


            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="../frontend/estoque_html.php">Cadastro de Produto</a>
                <a href="../frontend/clientes_html.php">Clientes</a>
                <a href="../frontend/consultaprod_html.php">Produtos</a>
                <a href="../frontend/estat_html.php">Estatisticas</a>
            </div>



            <div id="main">
                <h1>Bem-vindo adminstrador da Aleka!</h1>
                <h4>Clique em '<b onclick="openNav()">OPÇÕES</b>' acima para se direcionar às ferramentas de administrador↑</h4>
                <p>Aqui você encontrará as Estatisticas do Projeto, Consultará Clientes e Produtos e Cadastrará Produtos</p>
            </div>





            <div id="space">

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
                

                <br><br>
                Amanda, nº2 - Ana Julia, nº3 <br>
                Eduardo, nº7 - Kaio, nº20 <br>
                Luiz, nº24


            </div>
        </div>



        <!--Java Script-->
        <script>
            /* Set the width of the side navigation to 250px */
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            /* Set the width of the side navigation to 0 */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }

            function myFunction() {
                var popup = document.getElementById("myPopup");
                popup.classList.toggle("show");
            }

        </script>
    </center>
</body>

</html>
