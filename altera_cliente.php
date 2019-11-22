<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
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

    <form action="salva_cliente.php" method="post">
        ID_CLIENTE <input type="text" name="id_cliente" value="<?php echo $linha['id_cliente']; ?>" readonly><br>
        NOME <input type="text" name="nome_cliente" value="<?php echo $linha['nome_cliente']; ?>"><br>
        EMAIL <input type="text" name="email_cliente" value="<?php echo $linha['email_cliente']; ?>"><br>
        TELEFONE <input type="text" name="telefone_cliente" value="<?php echo $linha['telefone_cliente']; ?>"><br>
        <input type="submit" value="Salvar">
        <input type="reset" value="Voltar">
    </form>
</body>

</html>
