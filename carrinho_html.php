    <?php
    session_start();
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Carrinho</title>
        <link rel="shortcut icon" href="../fotos/favicon.ico" />
        <link rel="stylesheet" href="estilo.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
    <?php
        if(!isset($_SESSION) || empty($_SESSION['nome']) || $_SESSION['nome']=="deslogado")
        {
            session_start();
            echo"<script>window.alert('Você deve estar logado para acessar essa área!')</script>";
            echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/cadastro_html.php'</script>";
            exit;
        }
        session_start();
        
        if(!isset($_SESSION['carrinho'])){
            $_SESSION['carrinho'] = array();
        }
        
        //adiciona produto
        
        if(isset($_GET['acao'])){
            //Adiciona produto ao carrinho
            if($_GET['acao'] == 'adicionar'){
                $id_produtos = intval($_GET['id_produtos']);//o código do produto vem dá página produtos
                if(!isset($_SESSION['carrinho'][$id_produtos])){
                    $_SESSION['carrinho'][$id_produtos] = 1;
                }else{
                    $_SESSION['carrinho'][$id_produtos] += 1;
                }
            }
            
            //Remove do carrinho
            if($_GET['acao'] == 'del'){
                $id_produtos = intval($_GET['id_produtos']);
                if(isset($_SESSION['carrinho'][$id_produtos])){
                    unset($_SESSION['carrinho'][$id_produtos]);
                }
            }
            
            //Altera a quantidade
            if($_GET['acao'] == 'up'){
                //echo "<script> alert('QQQQ'); </script>";
                if(is_array($_POST['prod'])){
                    foreach($_POST['prod'] as $id_produtos => $qtd){
                        $id_produtos = intval($id_produtos);
                        //despreza a parte decimal
                        $qtd = intval($qtd);
                        if(!empty($qtd) && $qtd>0){
                            $_SESSION['carrinho'][$id_produtos] = $qtd;
                        }else{
                            unset($_SESSION['carrinho'][$id_produtos]);
                        }
                    }
                }
            }
            
            // Modifica a url para remover qualquer uma das ações: add, del ou up, evita que a ação seja
             // processada novamente caso a página seja recarregada
            // header("location:carrinho_html.php");
        }
    ?>
        <center>
            <div id="mae">

                <div id="cabecalho">

                    <div id="logo">
                        <a href="home_html.php"><img src="../fotos/aleka.png" width="120" height="120"></a>
                    </div>
                    <div id="botoes">
                        <a href="../frontend/home_html.php"><button type="button" class="padrao">Home</button></a>
                        <a href="../frontend/cadastro_html.php"><button type="button" class="padrao">Cadastro</button></a>
                        <a href="../frontend/produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                        <a href="../frontend/des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                        <a href="../frontend/sobre_html.php"><button type="button" class="padrao">Sobre</button></a>
                    </div>
                    <div id="icones">
                        <br>
                        <button class="popup" onclick="myFunction()">
                            <div id="login"><img src="../fotos/login.png" width="50" height="50"></div>
                            <span class="popuptext" id="myPopup">Bem-vindo <b><?php echo $_SESSION["nome"]."<br><a href='../backend/logout.php' id='buy'>Logout</a>" ; ?></b></span>
                        </button>
                        <div id="carrinho"><a href="carrinho_html.php"><img src="../fotos/carrinhoatual.png" width="50" height="50"></a></div>

                    </div>
                </div>

                <div id="space"></div>
                <div class="carrinho">
                    <div id="centr">
                        <div id="detalheprod">
                            <div id="indicacao"><img src="../fotos/alekacarrinho.png"></div>

                            <div id="titulos">
                                <div id="titprod">
                                    <b>Produto</b>
                                </div>
                                <div id="titqtd">
                                    <b>Quantidade</b>
                                </div>
                                <div id="titpreco">
                                    <b>Preço Unitário</b>
                                </div>
                            </div>
                            
                            <br>
                            <form action="?acao=up" method ="post">
                            <?php
                                
                            if(count($_SESSION['carrinho']) == 0){
                                echo "<div id='mostraprod'>
                                Não há nada no carrinho";
                                echo "</div>";
                            }
                            else
                            {
                                require("../backend/conecta.php");
                                $total = 0;
                                echo "<div id='mostraprod'>";
                                
                                foreach($_SESSION['carrinho'] as $id_produtos => $qtd)
                                {//início do foreach
                                    $sql = "SELECT * FROM public.produtos WHERE id_produtos=$id_produtos  ORDER BY id_produtos";
                                    $resultado = pg_query($conecta, $sql);
                                    $lin = pg_num_rows($resultado);
                                    if($lin>0)
                                    {
                                        $linha = pg_fetch_array($resultado);
                                        $produto = $linha['nome_produtos'];

                                        $preco = 5;
                                        $sub = $preco * $qtd;
                                        $subtotal += $sub;
                                        $total += $sub;
                                        $preco = number_format($preco, 2, ',', '.');
                                        $subtotal = number_format($subtotal, 2, ',', '.');
                                    }

                                    echo "<div id='titprod'>";
                                    echo $produto;
                                    echo '</div>
                                    <div id="titqtd">
                                    <input type="text" size="3" name="prod['.$id_produtos.']" value="'.$qtd.'" >
                                    </div>
                                    <div id="titpreco">';

                                    echo $preco;
                                    echo "</div>";
                                }
                                echo"</div>";
                                $total = number_format($total, 2, ',', '.');
                            }
                            ?>
                            <input type="submit" value="Atualizar carrinho">
                                </form>
                        </div>
                        
                        <div id="resumocomp">
                            <div id="titresumo">
                                <b>Resumo do pedido</b>
                                <hr>
                            </div>
                            <div id="titres">
                                <b>Subtotal:</b><?php echo $subtotal; ?>
                                <br><br>
                                <b>Frete:</b> <i>Grátis</i>
                                <hr>
                                <b>Total:</b> <?php echo $total; ?>
                            </div>
                            <br>
                            <form method="post" action="../backend/finalcompra.php">
                            <div id="botaoresumo">
                                <button type="submit" id="finalizar">
                                    Finalizar
                                </button>
                            </div>
                            </form>
                        </div>
                        <!--
                            <a href="carrinho_html.php?acao=up&qtd=<?php echo $qtd; ?>">
                            <button> ATUALIZAR CARRINHO</button>
                            </a>
-->
                       
                                
                    </div>
                </div>




                <div id="space"></div>

                <div id="rodape">
                    <div class="btn-group mr-2" role="group" aria-label="First group">

                        <a href="../frontend/home_html.php"><button type="button" class="btn btn-secondary">Home</button></a>

                        <a href="../frontend/cadastro_html.php"><button type="button" class="btn btn-secondary">Cadastro</button></a>

                        <a href="../frontend/produtos.html"><button type="button" class="btn btn-secondary">Produtos</button></a>

                        <a href="../frontend/des_html.php"><button type="button" class="btn btn-secondary">Desenvolvimento</button></a>

                        <a href="../frontend/sobre.html"><button type="button" class="btn btn-secondary">Sobre</button></a>

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
                        // When the user clicks on <div>, open the popup
                        function myFunction() {
                            var popup = document.getElementById("myPopup");
                            popup.classList.toggle("show");
                        }

                    </script>

                </div>
            </div>

        </center>
    </body>

    </html>
