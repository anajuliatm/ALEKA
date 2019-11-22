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
                    <a href="produtos_html.php"><button type="button" class="padrao" id="atual">Produtos</button></a>
                    <a href="des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                    <a href="sobre_html.php"><button type="button" class="padrao">Sobre</button></a>
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

            <?php
                include "../backend/conecta.php";

                $sql = "SELECT * FROM produtos WHERE excluido_produtos='n'";

                $exec = pg_query($conecta,$sql);

            
                //PAGINAÇÃO
                $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;//número da pagina atual, se n especifica atribui pagina 1
                $qtdregistros = pg_num_rows($exec);//numero de produtos
                $registros = 8;//registros por pagina
                $qtd_pag = ceil($qtdregistros / $registros);//calcula qtd de paginas(ceil arredonda o numero para o maior vizinho)
                $inicio = ($registros * $pagina) - $registros;//calcula o inicio da visualização com base na atual    
                //SELEÇÃO DE REGISTROS POR PAGINA
                $sql2 = "SELECT * FROM produtos WHERE excluido_produtos='n' LIMIT $registros OFFSET $inicio";
                $resultado = pg_query($conecta,$sql2);
                $total = pg_num_rows($exec);
                if($qtdregistros > 0){                    
            ?>


            <div id="prod">

                <?php 
                  for($i = 0; $i < pg_num_rows($resultado); $i++){
                        $linha = pg_fetch_array($resultado);
                        $qtd = $linha['qtd_produtos'];
                ?>
                <div id="prodesp">
                    <div class="card" style="width: 286px; height: 473px;">
                            <img src="../fotos/popsockets/<?php echo $linha['arquivo'] ?>" class="card-img-top" width="" height="">
                            <div class="card-body">
                                <h5 class="card-title"><b><?php echo "Popsocket ".$linha['nome_produtos']; ?></b></h5>
                                <p class="card-text"><?php echo "Tema: ".$linha['tema_produtos']; ?></p>
                                <p class="card-text"><?php echo $linha['preco_produtos']; ?></p>
                                <input name="id_prod" type="hidden" value="<?php echo $linha['id_produtos'] ?>">
                                <?php
                                if($qtd>0)
                                {
                                    echo "<a href='carrinho_html.php?acao=adicionar&id_produtos=".$linha['id_produtos']."'>Comprar</a>";
                                }
                                else
                                {
                                    echo"Produto indisponível no momento";
                                }
                                ?>
                            </div>
                    </div>
                </div>
                <?php }

                    ?>
            </div>

            <?php
            }
            $prox = $pagina +1; 
            $ant = $pagina - 1;
            if($pagina>=2 && $pagina<=$qtd_pag){
                echo "<a href='?pagina=$ant'>ANTERIOR | </a>";
            }
            
            for($i = 1; $i < $qtd_pag + 1; $i++){ 
                                echo "<a href='produtos_html.php?pagina=$i'><button class='pagina'>".$i."</button></a> &nbsp;" ; 
                            }
            
            if($pagina>=1 && $pagina<$qtd_pag){
               echo "<a href='?pagina=$prox'> | PROXIMO</a>";
            }      
    ?>
            <div id="space">

            </div>
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
