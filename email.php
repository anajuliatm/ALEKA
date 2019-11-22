<?php
    	$emails="vitorsimeao@gmail.com";
	$assunto="Bom dia, Vitao! <3<br>Amanda, 02<br>Ana Julia, 03<br>Eduardo, 07<br> Kaio, 20<br>Luiz, 24";
	$assunto2="Equipe 7";
	

	    // Inserir Arquivos do PHPMailer
	    require 'Exception.php';
	    require 'PHPMailer.php';
	    require 'SMTP.php';
	    
	    // Usar as classes sem o namespace
	    use PHPMailer\PHPMailer\PHPMailer;
	    use PHPMailer\PHPMailer\Exception;

	    // Criação do Objeto da Classe PHPMailer
	    $mail = new PHPMailer(true); 


	    try {
	        
	        //Retire o comentário abaixo para soltar detalhes do envio 
	         $mail->SMTPDebug = 2;                                
	        
	        // Usar SMTP para o envio
	        $mail->isSMTP();                                      

	        // Detalhes do servidor (No nosso exemplo é o Google)
	        $mail->Host = 'smtp.gmail.com';

	        // Permitir autenticação SMTP
	        $mail->SMTPAuth = true;                               

	        // Nome do usuário
	        $mail->Username = 'grupo7cti2019@gmail.com';        
	        // Senha do E-mail
		    $mail->Password = 'ecommerce2019';         
	                               
	        // Tipo de protocolo de segurança
	        $mail->SMTPSecure = 'tls';   

	        // Porta de conexão com o servidor                        
	        $mail->Port = 587;

	        
	        // Garantir a autenticação com o Google
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	                'verify_peer' => false,
	                'verify_peer_name' => false,
	                'allow_self_signed' => true
	            )
	        );

	        // Remetente
	        $mail->setFrom('grupo7cti2019@gmail.com', 'Equipe 7');
	        
	        // Destinatário
	        $mail->addAddress($emails, 'Aleka');

	        // Conteúdo

	        // Define conteúdo como HTML
	        $mail->isHTML(true);                                  

	        // Assunto
	        $mail->Subject = $assunto2;
	        $mail->Body    = $assunto;
	        $mail->AltBody = '';

	        // Enviar E-mail
	        $mail->send();
	        echo 'Mensagem enviada com sucesso ';
	        echo $emails;
            
	    } catch (Exception $e) {
	    	}

?>