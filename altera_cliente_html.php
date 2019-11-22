   <?php
    session_start();
    ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <title>Altera Clinte</title>
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

        $id_cliente = $_GET['id_cliente'];

        $sql="SELECT * FROM cliente WHERE id_cliente=".$id_cliente;
        $resultado=pg_query($conecta,$sql);
        $qtde=pg_num_rows($resultado);
        if ( $qtde == 0 )
        {
            echo "Produto nao encontrado !!!<br><br>";
            exit;
        }

        $linha = pg_fetch_array($resultado);
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
                       <a href="home_html.php"><button type="button" class="padrao">Home</button></a>
                       <a href="cadastro_html.php"><button type="button" class="padrao" id="atual">Cadastro</button></a>
                       <a href="produtos_html.php"><button type="button" class="padrao">Produtos</button></a>
                       <a href="des_html.php"><button type="button" class="padrao">Desenvolvimento</button></a>
                       <a href="sobre_html.php"><button type="button" class="padrao">Sobre</button></a>
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
               <div id="space">

               </div>
               <div class="fundo">
                   <div id="cadastro">
                       <form name="altera" action="../backend/salva_cliente.php" method="post">
                           <div class="form-row">
                               <br>
                               <label for="inputAddress2">ID</label>
                               <input type="text" name="id_cliente" value="<?php echo $linha['id_cliente']; ?>" class="form-control" id="inputAddress2" readonly>
                               <br>

                               <label for="inputAddress">Nome</label>
                               <input type="text" name="nome_cliente" value="<?php echo $linha['nome_cliente']; ?>" class="form-control" maxlength="18" id="inputAddress" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122">

                               <br>

                               <label for="inputAddress2">Telefone</label>
                               <input type="text" name="telefone_cliente" value="<?php echo $linha['telefone_cliente']; ?>" class="form-control" id="inputAddress2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11" maxlength="11">

                               <br>

                               <label for="inputEmail4">Email</label>
                               <input type="email" name="email_cliente" value="<?php echo $linha['email_cliente']; ?>" class="form-control" id="inputEmail4" onchange="confirma_email()" required>

                               <br>

                               <br><br>

                               <input type="submit" class="btn btn-secondary" name="save" value="Salvar">&nbsp;
                               <input type="submit" class="btn btn-secondary" name="del" value="Excluir">
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

                       <a href="produtos_html.php"><button type="button" class="btn btn-secondary">Produtos</button></a>

                       <a href="des_html.php"><button type="button" class="btn btn-secondary">Desenvolvimento</button></a>

                       <a href="sobre_html.php"><button type="button" class="btn btn-secondary">Sobre</button></a>

                   </div>

                   <br><br>

                   <a href="#top"><button type="button" class="btn btn-secondary">Voltar ao topo ↑ </button></a>

                   <br><br>

                   Amanda, nº2 - Ana Julia, nº3 <br>
                   Eduardo, nº7 - Kaio, nº20 <br>
                   Luiz, nº24
                   
                   <script>
                       
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
