<?php
include"conecta.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$nome=$_POST['nome'];
$senha=$_POST['senha'];
$senha_crip=md5($senha);
$email=$_POST['conf_email'];
$telefone=$_POST['telefone'];
$sql_1="SELECT email_cliente FROM public.cliente WHERE email_cliente='".$email."';";
$resultado_1=pg_query($conecta, $sql_1);
$lin_1=pg_num_rows($resultado_1);
if($lin_1>0)
{
    echo"<script>window.alert('O e-mail já está cadastrado...')</script>";
    echo"<script>window.alert('Você será redirecionado ao cadastro!!!')</script>";
    echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/cadastro_html.php'</script>";
}
else
{
    $sql_2="SELECT nome_cliente FROM public.cliente WHERE nome_cliente='".$nome."';";
    $resultado_2=pg_query($conecta, $sql_2);
    $lin_2=pg_num_rows($resultado_2);
    if($lin_2>0)
    {
        echo"<script>window.alert('O nome de usuário já está cadastrado...')</script>";
        echo"<script>window.alert('Você será redirecionado ao cadastro!!!')</script>";
        echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/cadastro_html.php'</script>";
    }
    else
    {
        $sql_3="INSERT INTO public.cliente VALUES(nextval('cliente_id_cliente_seq'::regclass), '$nome', '$senha_crip', '$email', '$telefone', 'n', 'n');";
        $resultado_3=pg_query($conecta, $sql_3);
        $lin_3=pg_affected_rows($resultado_3);
        if($lin_3==0)
        {
            echo"<script>window.alert('Houve um erro no cadastro, tente novamente mais tarde...')</script>";
            echo"<script>window.alert('Você será redirecionado ao cadastro!!!')</script>";
            echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/cadastro_html.php'</script>";
        }
        else
        {
            echo"<script>window.alert('Seu cadastro foi realizado com sucesso!')</script>";
            echo"<script>window.alert('Você será redirecionado à home!!!')</script>";
            echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'</script>";
            $texto="Seu cadastro foi realizado com sucesso!";
            $assunto="Equipe ALEKA";


            // Inserir Arquivos do PHPMailer
            require '../bib_mail/PHPMailerAutoload.php';

            // Criação do Objeto da Classe PHPMailer
            $emailobjeto = new PHPMailer(true); 


            try {
                
                //Retire o comentário abaixo para soltar detalhes do envio 
                    $emailobjeto->SMTPDebug = 2;                                
                
                // Usar SMTP para o envio
                $emailobjeto->isSMTP();                                      

                // Detalhes do servidor (No nosso exemplo Ã© o Google)
                $emailobjeto->Host = 'smtp.gmail.com';

                // Permitir autenticação SMTP
                $emailobjeto->SMTPAuth = true;                               

                // Nome do usuário
                $emailobjeto->Username = 'grupo7cti2019@gmail.com';        
                // Senha do E-mail
                $emailobjeto->Password = 'ecommerce2019';         
                                        
                // Tipo de protocolo de seguranÃ§a
                $emailobjeto->SMTPSecure = 'tls';   

                // Porta de conexão com o servidor                        
                $emailobjeto->Port = 587;

                
                // Garantir a autenticação com o Google
                $emailobjeto->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                // Remetente
                $emailobjeto->setFrom('grupo7cti2019@gmail.com', 'Equipe ALEKA');
                
                // DestinatÃ¡rio
                $emailobjeto->addAddress($email, 'Aleka');

                // Conteúdo

                // Define conteúdo como HTML
                $emailobjeto->isHTML(true);                                  

                // Assunto
                $emailobjeto->Subject = $assunto;
                $emailobjeto->Body    = $texto;
                $emailobjeto->AltBody = '';

                // Enviar E-mail
                $emailobjeto->send();
                echo 'Mensagem enviada com sucesso';
                echo $email;
                
            } catch (Exception $e) 
            {}
        }
    }
}

?>