<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    $conecta=pg_connect("host=localhost port=5432 dbname=aleka user=aleka password=ecommerce2019");
    if(!$conecta)
    {
        echo"<script>window.alert('Não foi possível estabelecer a conexão com o servidor...')</script>";
    }
    ?>
</body>
</html>