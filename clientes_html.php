<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
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
        $conecta=pg_connect("host=localhost port=5432 dbname=aleka user=aleka password=ecommerce2019");
        if(!$conecta)
        {
            echo"<script>window.alert('Não foi possível estabelecer a conexão com o servidor...')</script>";
        }
        $sql = "SELECT * FROM cliente WHERE excluido_cliente='n' ORDER BY id_cliente";
        $resultado = pg_query($conecta, $sql);
        $qtd = pg_num_rows($resultado);
        $linha=pg_fetch_array($resultado);

    //CONSTRUINDO PAGINAÇÃO
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;//número da pagina atual, se n especifica atribui pagina 1
    $totalpags = pg_num_rows($resultado );//pega qtd total de linhas 
    $registros = 10;//registros por pagina
    $qtd_pag = ceil($totalpags / $registros);//calcula qtd de paginas(ceil arredonda o numero para o maior vizinho)
    $inicio = ($registros * $pagina) - $registros;//calcula o inicio da visualização com base na atual    
    //SELEÇÃO DE REGISTROS POR PAGINA
    $sql2 = "SELECT * FROM cliente WHERE excluido_cliente='n'  ORDER BY id_cliente LIMIT $registros OFFSET $inicio";
    $resultado = pg_query($conecta,$sql2);
    $total = pg_num_rows($resultado);
    
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
                    <div id="carrinho"><a href="carrinho_html.php"><img src="../fotos/carrinho.png" width="50" height="50"></a></div>

                </div>
            </div>

            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="../frontend/admin_html.php">Home Admin</a>
                <a href="../frontend/estoque_html.php">Cadastro de Produto</a>
                <a href="../frontend/consultaprod_html.php">Produtos</a>
                <a href="../frontend/estat_html.php">Estatisticas</a>
            </div>



            <div id="clientes">
                <div class="alert alert-dark" role="alert">
                    Consulta de Clientes
                </div>
                <div id="tabela">
                    <div class="container">

                        <div class="row">
                            <div class="col-" id="id"><b>ID</b></div>
                            <div class="col-" id="nome"><b>NOME</b></div>
                            <div class="col-" id="email"><b>EMAIL</b></div>
                            <div class="col-" id="tel"><b>TELEFONE</b></div>
                            <div class="col-" id="opt"><b>OPÇÃO</b></div>
                        </div>

                        <?php
                                if($qtd > 0){
                                for($cont=0; $cont < pg_num_rows($resultado); $cont++)
                                {$linha=pg_fetch_array($resultado);
                            ?>
                        <div class="row">
                            <div class="col-" id="id"><?php echo $linha['id_cliente']; ?></div>
                            <div class="col-" id="nome"><?php echo $linha['nome_cliente']; ?></div>
                            <div class="col-" id="email"><?php echo $linha['email_cliente']; ?></div>
                            <div class="col-" id="tel"><?php echo $linha['telefone_cliente']; ?></div>
                            <div class="col-" id="opt"><?php echo "<a href='altera_cliente_html.php?id_cliente=".$linha['id_cliente']."'>Alterar/Excluir</a>";?></div>
                        </div>

                        <?php
                            }}
                            
                        ?>


                    </div>

                </div>
                <br>
                <?php
                    $prox = $pagina +1; 
            $ant = $pagina - 1;
            if($pagina>=2 && $pagina<=$qtd_pag){
                echo "<a href='?pagina=$ant'>ANTERIOR | </a>";
            }
            
            for($i = 1; $i < $qtd_pag + 1; $i++){ 
                                echo "<a href='clientes_html.php?pagina=$i'><button class='pagina'>".$i."</button></a> &nbsp;" ; 
                            }
            
            if($pagina>=1 && $pagina<$qtd_pag){
               echo "<a href='?pagina=$prox'> | PROXIMO</a>";
            }      
                    ?>
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
