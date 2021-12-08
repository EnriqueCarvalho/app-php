<?php

include "../model/Produto.php";



if (isset($_POST['opcao'])){
    $opcao = $_POST['opcao'];

    $produto = new Produto;
    $produto->setNome($_POST['nome']);
    $produto->setValor($_POST['valorProduto']);
    $produto->setDesconto($_POST['descontoMaximo']);
    $produto->setQtde($_POST['qtdeEstoque']);
    $produto->setDescricao($_POST['descricaoProduto']);
   
    $ret = $produto->cadastrarProduto();

    if($ret==1){
        echo "<script>alert('Produto cadastrado com sucesso');</script>";
        echo "<script>window.location = '../view/menu.php';</script>";
    }else{
        echo "<script>alert('Erro ao cadastrar produto');</script>";
        echo "<script>window.location = '../view/pgproduto.php';</script>";
    }
    

}



    
?>