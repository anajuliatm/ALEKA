<?php
//Reporte de erros:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Conexão
include"conecta.php";
//Verificação de existência da Session:
session_start();
if(!isset($_SESSION))
{
    session_start();
}
//Estado do login:
$_SESSION['cond']="n";
//Captura de variáveis:
$login=$_POST['nome_log'];
$senha=$_POST['senha_log'];
$senha_crip=md5($senha);
//Verificação da existência da conta:
$sql1="SELECT nome_cliente FROM public.cliente WHERE nome_cliente='".$login."' OR email_cliente='".$login."';";
$resultado1=pg_query($conecta, $sql1);
$lin1=pg_num_rows($resultado1);
//Caso NÃO exista:
if($lin1<0)
{
    //Caixa de alert em JS e mudança para a Home
    echo"<script>window.alert('O usuário não existe em nosso banco de dados...')</script>";
    echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'>";
}
//Caso exista:
else
{
    //Verificação de senha:
    $sql2="SELECT senha_cliente FROM public.cliente WHERE nome_cliente='".$login."' AND senha_cliente='".$senha_crip."' OR email_cliente='".$login."' AND senha_cliente='".$senha_crip."';";
    $resultado2=pg_query($conecta, $sql2);
    $lin2=pg_num_rows($resultado2);
    //Caso a senha tenha sido inserida INcorretamente:
    if($lin2==0)
    {
        echo"<script>window.alert('A senha não foi inserida corretamente...')</script>";
        echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'>";
    }
    //Caso a senha tenha sido inserida corretamente:
    else
    {
        //Estado do login:
        $_SESSION['cond']="s";
        //Verificação se é e-mail ou login:
        //Verificação se é e-mail:
        $sql3="SELECT email_cliente FROM public.cliente WHERE email_cliente='".$login."';";
        $resultado3=pg_query($conecta, $sql3);
        $lin3=pg_num_rows($resultado3);
        //Caso não seja e-mail:
        if($lin3==0)
        {
            //Caso seja nome de usuário:
            $sql4="SELECT * FROM public.cliente WHERE nome_cliente='".$login."';";
            $consulta1=pg_query($conecta, $sql4);
            $array=pg_fetch_array($consulta1);
            $email=$array['email_cliente'];
            //Atribuição das variáveis NOME e EMAIL:
            $_SESSION['nome']=$login;
            $_SESSION['email']=$email;
            $_SESSION['id_cliente']=$array['id_cliente'];
            //Verificação de administrador:
            $sql5="SELECT admin_cliente FROM public.cliente WHERE admin_cliente='n' AND nome_cliente='".$login."';";
            $resultado4=pg_query($conecta, $sql5);
            $lin4=pg_num_rows($resultado4);
            //Caso seja admin:
            if($lin4>0)
            {
                echo"<script>window.alert('Login efetuado com sucesso! Você será direcionado à Home!')</script>";
                echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'>";
                $_SESSION['admin']='n';
            }
            else
            {
                //Caso NÂO seja admin:
                echo"<script>window.alert('Login efetuado com sucesso! Você será direcionado à Administradores!')</script>";
                echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/admin_html.php'>";
                $_SESSION['admin']='s';
            }
        }
        else
        {
            //Caso tenha logado com email:
            $sql6="SELECT * FROM public.cliente WHERE email_cliente='".$login."';";
            $consulta2=pg_query($conecta, $sql6);
            $array2=pg_fetch_array($consulta2);
            $nome=$array2['nome_cliente'];
            $_SESSION['nome']=$nome;
            $_SESSION['email']=$login;
            $_SESSION['id_cliente']=$array['id_cliente'];
            //Verificação de administrador:
            $sql7="SELECT admin_cliente FROM public.cliente WHERE admin_cliente='n' AND nome_cliente='".$login."';";
            $resultado5=pg_query($conecta, $sql7);
            $lin5=pg_num_rows($resultado5);
            //Caso seja admin:
            if($lin5==0)
            {
                echo"<script>window.alert('Login efetuado com sucesso! Você será direcionado à Administradores!')</script>";
                echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/admin_html.php'>";
                $_SESSION['admin']='s';
            }
            else
            {
                //Caso NÂO seja admin:
                echo"<script>window.alert('Login efetuado com sucesso! Você será direcionado à Home!')</script>";
                echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'>";
                $_SESSION['admin']='n';
            }
        }
    }
}
?>
