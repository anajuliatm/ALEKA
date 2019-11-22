<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
   <?php
    session_start();
    $_SESSION['admin']='n';//tive que fazer isso perdao
    unset($_SESSION['nome'], $_SESSION['email'], $_SESSION['carrinho'], $_SESSION['admin']);
    echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'>";
    ?>
</body>
</html>