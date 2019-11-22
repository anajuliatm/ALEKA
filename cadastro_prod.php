<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>cadastro_produto.php</title>
</head>

<body>

    <?php
       include "conecta.php";

       if(isset($_FILES['arquivo'])) 
        {
            //Verifica qual a extensão do arquivo (.png, .jpg, .gif)
            //A função substr pega o nome do arquivo e o corta em pedaços menores
            //O "-4" indica que a função deve pegar os útlimos quatro dígitos da string
            //A função strtolower transforma todos os caracteres em minúsculo
            //$extensao =  strtolower(substr($_FILES['arquivo']['name'], -4));
            $extensao=pathinfo($_FILES['arquivo']['name']);
            
            $nome_img=$_FILES['arquivo'];

            //Define novo nome para o arquivo com hora criptografada
            //A criptografia evita arquivos duplicados e que um arquivo sobescreva o outro
            $novo_nome = $extensao['filename'] . "." . $extensao['extension'];
            
            //Define diretório onde será salvo o arquivo
            $diretorio = "../fotos/popsockets/";
            
            //Acessa o nome temporário do arquivo (criado pelo PHP como "temp_name")
            //Move o arquivo para o diretorio com o novo nome
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
        }
        
        $nome = $_POST['nome_prod'];
        $tema = $_POST['tema_prod'];
        $qtd = $_POST['qtd_prod'];
        $preco = $_POST['preco_prod'];
        $excluido='n';
        $vendido = 0;
    
        $sql="INSERT INTO public.produtos
            VALUES(nextval('produtos_id_produtos_seq'::regclass), 
            '$nome',
            '$tema',
             $qtd,
            '$preco',
            '$excluido',
             $vendido,
             '$novo_nome')";
        $resultado=pg_query($conecta, $sql);
        $linhas=pg_affected_rows($resultado);
        if($linhas > 0)
        {
            echo"<script>window.alert('Produto cadastrado com sucesso!')</script>";
            echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/estoque_html.php'>";
        }
        else
        {
            echo $sql;
            echo"<script>window.alert('Erro na gravação do produto!')</script>";
            //echo"<meta http-equiv='refresh' content='0;url=http://200.145.153.175/eduardopires/site_aleka/frontend/estoque_html.php'>";
        }
        pg_close($conecta);
   ?>

</body>

</html>
