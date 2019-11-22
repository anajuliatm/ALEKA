<?php
    $conecta=pg_connect("host=localhost port=5432 dbname=aleka user=aleka password=ecommerce2019");
    if(!$conecta)
    {
        echo"<script>window.alert('Não foi possível estabelecer a conexão com o servidor...')</script>";
    }
    $sql = "SELECT * FROM cliente WHERE excluido_cliente='n'";
    echo $sql;
    $resultado = pg_query($conecta, $sql);
    $qtd = pg_affected_rows($resultado);
    if($qtd > 0){
        echo "<br>Mostra Clientes <br><br>";
        for ($cont=0; $cont < $qtd; $cont++)
        {
            $linha=pg_fetch_array($resultado);
            echo "ID CLIENTE: ".$linha['id_cliente']."<br>";
            echo "NOME: ".$linha['nome_cliente']."<br>";
            echo "EMAIL: ".$linha['email_cliente']."<br>";
            echo "TELEFONE: ".$linha['telefone_cliente']."<br>";
            echo "<a href='altera_cliente.php?id_cliente=".$linha['id_cliente']."'>
Alterar</a><br><br>";
        }
    }
    else
        echo "<script>alert('Nenhum cliente localizado')</script>";
?>
