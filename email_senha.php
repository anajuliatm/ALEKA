<!DOCTYPE html>
<html lang="pt-br">
<?php    

        include"../backend/conecta.php";
        $email_cliente = $_POST['email_cliente'];
        $sql_1="SELECT email_cliente FROM public.cliente WHERE email_cliente='".$email_cliente."';";
        $resultado_1=pg_query($conecta, $sql_1);
        $lin=pg_num_rows($resultado_1);
        if($lin>0)
        {
            $texto="<html><head></head><body>       
            <h3>Checagem de email</h3><br>
            Clique <a href='200.145.153.175/eduardopires/site_aleka/frontend/altera_senha.php?email_cliente=$email_cliente'>aqui</a> para alterar sua senha<br>
            </body></html>";
            $assunto="Pedido para alterar senha";


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
                $emailobjeto->addAddress($email_cliente, 'Aleka');

                // Conteúdo

                // Define conteúdo como HTML
                $emailobjeto->isHTML(true);                                  

                // Assunto
                $emailobjeto->Subject = $assunto;
                $emailobjeto->Body    = $texto;
                $emailobjeto->AltBody = '';

                // Enviar E-mail
                $emailobjeto->send();
                echo"<script>window.alert('Foi enviada uma mensagem no seu email para recuperação de senha!')</script>";
                echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'</script>";
                
            } catch (Exception $e) 
            {}
        }
        else
        {
            echo"<script>window.alert('Email não está cadastrado!')</script>";
            echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/cadastro_html.php'</script>";
        }
?>
</html>