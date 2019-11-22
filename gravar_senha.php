<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gravação</title>
</head>
<body>
    <?php
    
    include "conecta.php";
    
    $email_cliente=$_POST['email_cliente'];
    $senha=$_POST['senha'];
    $senha_crip=md5($senha);
    $sql = "UPDATE public.cliente SET senha_cliente = '".$senha_crip."' WHERE email_cliente = '".$email_cliente."';";
    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);
    if ($qtde > 0)
    {
        echo "<script> alert('Senha alterada com sucesso!')</script>";
        echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'>";
    }
    else
        echo "Erro na alteração de senha!<br><br>";
    ?>
</body>
</html>