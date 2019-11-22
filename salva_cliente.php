<?php
        $conecta=pg_connect("host=localhost port=5432 dbname=aleka user=aleka password=ecommerce2019");
        if(!$conecta)
        {
            echo"<script>window.alert('Não foi possível estabelecer a conexão com o servidor...')</script>";
        }
    $excluido=$_POST['del'];
    $id = $_POST['id_cliente'];
    $nome = $_POST['nome_cliente'];
    $email = $_POST['email_cliente'];
    $telefone = $_POST['telefone_cliente'];

 
      $sql = "UPDATE cliente
            SET
             nome_cliente = '$nome',
             email_cliente = '$email',
             telefone_cliente = '$telefone'
             WHERE id_cliente = $id";
    
    if($excluido)
      $sql = "UPDATE cliente SET excluido_cliente='s' WHERE id_cliente=".$id;

    $resultado = pg_query($conecta, $sql);
    echo $resultado;
    $qtd = pg_affected_rows($resultado);
    if($qtd > 0){
        echo"<script> alert('Operação realizada com sucesso!'); <\script>";
        header('Location:../frontend/clientes_html.php');
    }
    else
        echo"ERROR";
    
    
?>
