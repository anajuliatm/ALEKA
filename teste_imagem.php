<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include"conecta.php";
       if(isset($_FILES['arquivo']))
        {
            //Verifica qual a extensão do arquivo (.png, .jpg, .gif)
            //A função substr pega o nome do arquivo e o corta em pedaços menores
            //O "-4" indica que a função deve pegar os útlimos quatro dígitos da string
            //A função strtolower transforma todos os caracteres em minúsculo
            $extensao = pathinfo($_FILES['arquivo']['name']); //strtolower(substr($_FILES['arquivo']['name'], -4));
            
            //Define novo nome para o arquivo com hora criptografada
            //A criptografia evita arquivos duplicados e que um arquivo sobescreva o outro
            $novo_nome = md5(time()) . "." . $extensao['extension'];
            
            //Define diretório onde será salvo o arquivo
            $diretorio = "../fotos/";
            
            echo $_FILES['arquivo']['tmp_name'];
            //Acessa o nome temporário do arquivo (criado pelo PHP como "temp_name")
            //Move o arquivo para o diretorio com o novo nome
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            
            //Insere o nome do arquivo, bem como a sua data de upload na tabela produtos
            $sql_code = "INSERT INTO public.arquivo (codigo, arquivo, data) VALUES(DEFAULT, '$novo_nome', NOW())";
            $consulta=pg_query($conecta, $sql_code);
            
            //$mysql->query($sql_code);
        }
?>
<form  action="teste_imagem.php" method="post" enctype="multipart/form-data">
    Arquivo: <input type="file" required name="arquivo">
    <input type="submit" value="salvar">
</form>