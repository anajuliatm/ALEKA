<?php
session_start();
if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}

include "conecta.php";

foreach($_SESSION['carrinho'] as $id_produtos => $qtd)
{
    //Seleciona da tabela produtos o nome do produto comprado
    $sql2="SELECT * from public.produtos WHERE id_produtos = $id_produtos;";
    $resultado2 = pg_query($conecta, $sql2);
    $res = pg_fetch_array($resultado2);
    if($res > 0)
    {
        $nome_produtos = $res['nome_produtos'];
        $qtd_velho = $res['qtd_produtos'];
        $qtd_vendido_velho = $res['qts_vendidos_produtos'];
        $qtd_novo = $qtd_velho - $qtd;
        $qtd_vendido_novo = $qtd_vendido_velho + $qtd;
    }
    if($qtd > $qtd_velho)
    {
        echo"<script>window.alert('Quantidade pedida não disponível!')</script>";
        echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/carrinho_html.php'</script>";
        exit;
    }
    else
    {
        //Seleciona da tabela clientes o id do cliente que efetuou a compra
        $id_cliente = $_SESSION['id_cliente'];
        $sql3="SELECT * from public.cliente WHERE id_cliente = $id_cliente;";
        $resultado3 = pg_query($conecta, $sql3);
        $res2 = pg_fetch_array($resultado3);
        if($res2 > 0)
        {
            $nome_cliente = $res2['nome_cliente'];
        }
        //Insete na tabela venda
        $sql4="INSERT INTO public.venda VALUES(DEFAULT, $id_produtos, $id_cliente, '$nome_produtos', $qtd, NOW());";
        $resultado4 = pg_query($conecta, $sql4);
        $lin2 = pg_affected_rows($resultado4);
        if($lin2<=0)
        {
            echo"<script>window.alert('Não foi possível realizar a compra!')</script>";
            echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/carrinho_html.php'</script>";
            exit;
        }
        else
        {
            //Aqui vai o código que vai descontar os produtos comprados da tabela produtos
            $sql5="UPDATE public.produtos SET qtd_produtos = $qtd_novo, qts_vendidos_produtos = $qtd_vendido_novo WHERE id_produtos = $id_produtos;";
            $resultado5 = pg_query($conecta, $sql5);
            $res3 = pg_affected_rows($resultado5);
            if($res3<=0)
            {
                echo"<script>window.alert('Não foi possível realizar a compra!')</script>";
                echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/carrinho_html.php'</script>";
                exit;
            }
            else
            {
                echo"<script>window.alert('A comprar foi realizada com sucesso!')</script>";
                echo"<script>window.location.href = 'http://200.145.153.175/eduardopires/site_aleka/frontend/home_html.php'</script>";
                unset ($_SESSION['carrinho']);
            }
        }
    }
}
?>