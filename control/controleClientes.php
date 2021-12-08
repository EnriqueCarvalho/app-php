<?php

include "../model/Cliente.php";



if (isset($_POST['opcao'])){
$opcao = $_POST['opcao'];
            if($opcao=='Salvar'){

                    $c = new Cliente;
                    session_start();
                    $codEmpresa = $_SESSION['codEmpresa'];
                    $c->setCodEmpresa($codEmpresa);
                    $c->setNomeFantasia($_POST['nomeFantasia']);
                    $c->setRazaoSocial($_POST['razaoSocial']);
                    $c->setCnpjCliente($_POST['cnpjCliente']);
                    $c->setCepCliente($_POST['cepCliente']);
                    $c->setRuaCliente($_POST['ruaCliente']);
                    $c->setBairroCliente($_POST['bairroCliente']);
                    $c->setNumEnd($_POST['numEnd']);
                    $c->setCidadeCliente($_POST['cidadeCliente']);
                    $c->setUfCliente($_POST['ufCliente']);
                    $c->setTelefoneCliente($_POST['telefoneCliente']);
                    $c->setEmailCliente($_POST['emailCliente']);
                    $c->setObservacaoCliente($_POST['observacaoCliente']);
                
                    
                
                    $ret = $c->cadastrarCliente();
                    
                    if($ret==1){
                        echo "<script>alert('Cliente cadastrado com sucesso');</script>";
                        echo "<script>window.location = '../view/menu.php';</script>";
                    }else{
                        echo "<script>alert('Erro ao cadastrar Cliente');</script>";
                        echo "<script>window.location = '../view/menu.php';</script>";
                    }
        }else if ($opcao=='Alterar'){
            $c = new Cliente;
            session_start();
            $c->setCodCliente($_POST['codCliente']);
            $c->setNomeFantasia($_POST['nomeFantasia']);
            $c->setRazaoSocial($_POST['razaoSocial']);
            $c->setCnpjCliente($_POST['cnpj']);
            $c->setCepCliente($_POST['cep']);
            $c->setRuaCliente($_POST['ruaCliente']);
            $c->setBairroCliente($_POST['bairro']);
            $c->setNumEnd($_POST['numEnd']);
            $c->setCidadeCliente($_POST['cidade']);
            $c->setUfCliente($_POST['uf']);
            $c->setTelefoneCliente($_POST['telefone']);
            $c->setEmailCliente($_POST['emailCliente']);
            $c->setObservacaoCliente($_POST['observacaoCliente']);
        
            
        
            $ret = $c->alterarDadosCliente();
            
           
                echo "<script>alert('Dados do cliente alterados com sucesso');</script>";
                echo "<script>window.location = '../view/clienteInformacoes.php?codCliente=$ret';</script>";
       
         
            
        }

}



    
?>