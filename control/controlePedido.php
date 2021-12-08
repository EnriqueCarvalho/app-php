<?php
include '../model/Pedido.php';

    if(isset($_GET['opcao'])){ //----------------------------GET---------------------------------------
        $opcao=$_GET['opcao'];

        if($opcao=='selCliente'){
            session_start();
           $codCliente = $_GET['codigo'];
           $nomeCliente = $_GET['nomeCliente'];
           $codEmpresa = $_SESSION['codEmpresa'];
           $codFuncionario = $_SESSION['codFunc'];
           $nomeFuncionario = $_SESSION['nomeFunc'];
         
           $result  = Pedido::novoPedido($codCliente,$codEmpresa,$codFuncionario,$nomeFuncionario,$nomeCliente);           
           $_SESSION['codPedido']=$result;
           echo "<script>window.location = '../view/pedidoAddProd.php';</script>";
           
          
        }else if($opcao=='addItem'){
       
            echo "<script>window.location = '../view/pedidoAddItem.php';</script>";
        }else if ($opcao=='RemoverItem'){
            $codProduto = $_GET['codProduto'];
            $codPedido = $_GET['codPedido'];
            $qtdeItem=$_GET['qtdeItem'];
            Pedido::removerItemPedido($codProduto,$codPedido,$qtdeItem);
            echo "<script>window.location = '../view/pedidoAddProd.php';</script>";
        }else if ($opcao=='CancelarPedido'){
            session_start();
            $codRemoverPedido=$_SESSION['codPedido'];
            Pedido::removerPedido($codRemoverPedido);
            unset( $_SESSION['codPedido'] );
            echo "<script>window.location = '../view/menu.php';</script>";
        }
        
       
       
       
    }else if (isset($_POST['opcao'])){//----------------------------POST---------------------------------------
        $opcao=$_POST['opcao'];
        
         if($opcao=='Confirmar'){
                $descontoDado = $_POST['desconto'];
                $qtdeComprada = $_POST['quantidade'];
                $valorSumario = $_POST['valor'];
                $codProduto=$_POST['codProduto'];
                
                Pedido::addNovoItem($codProduto,$valorSumario,$qtdeComprada,$descontoDado);
                echo "<script>window.location = '../view/pedidoAddProd.php';</script>";





        }else if($opcao=='Salvar'){
            $valorTotal = $_POST['valorTotal'];
            $opcaoPagamento=$_POST['formaPagamento'];
                if($opcaoPagamento=='parcelado'){
                    $formaPagamento=$_POST['numParcelas'].'x';
                    $valorParcelas=$_POST['valorParcela'];
                    
                    
                }else{
                    $formaPagamento='À vista';
                    $valorParcelas=0;
                }
                
            $dataEntrega=$_POST['dataEntrega'];
            $obsPedido=$_POST['obsPedido'];
            $dataVencimento=$_POST['dataVencimento'];
            session_start();
            $codPedido=$_SESSION['codPedido'];
            $ret= Pedido::finalizarPedido($valorTotal,$formaPagamento, $valorParcelas, $dataEntrega,$obsPedido,$codPedido,$dataVencimento);
            
            if($ret==1){
             unset( $_SESSION['codPedido'] );
             echo "<script>alert('Pedido cadastrado com sucesso!');</script>";
            echo "<script>window.location = '../view/menu.php';</script>";
            }else{
                unset( $_SESSION['codPedido'] );
                echo "<script>alert('Erro ao cadastrar pedido, tente novamente');</script>";
                echo "<script>window.location = '../view/menu.php';</script>";
            }
           
        }else if ($opcao=="Alterar data do pedido"){
            $codPedido=$_POST['codPedido'];
            $dataEntrega=$_POST['dataEntrega'];
           

             Pedido::alterarDataPedido($codPedido,$dataEntrega);
             echo "<script>window.location = '../view/pedidoDetalhes.php?codPedido=$codPedido';</script>";


        }else if ($opcao=="Entregue"){
            $codPedido=$_POST['codPedido'];
          
           

             Pedido::pedidoEntregue($codPedido);
             echo "<script>window.location = '../view/pgVerPedidos.php';</script>";

        }else if ($opcao=="CancelarPedido"){
            $codPedido=$_POST['codPedido'];
            $motivoCancel=$_POST['motivoCancel'];
           

             Pedido::cancelarPedido($codPedido,$motivoCancel);
             echo "<script>window.location = '../view/menu.php';</script>";
        }
}
?>