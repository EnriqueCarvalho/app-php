<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/verPedidos.css">
    <title>Ver pedidos</title>
</head>
<?php
    include "../model/Pedido.php";
    date_default_timezone_set('America/Sao_Paulo');
    
		session_start();
			if (isset($_SESSION['nomeFunc'])){
				
			}else {
				header("Location: index.php");
            }
            $nomeFunc = $_SESSION['nomeFunc'];
            $nomeEmpresa = $_SESSION['nomeEmpresa'];
            $codCliente=$_GET['codCliente'];
            $nomeCliente=$_GET['nomeCliente'];

            
            $query = Pedido::visualizarPedidosCliente($codCliente);
            $res = $query->fetchALL(PDO::FETCH_ASSOC);
            
		

       ?>

<body >
    <div class="container-produtos">

    <div class="nav">
           <?php echo "  <a href='./clienteMenu.php?codCliente=$codCliente&nomeCliente=$nomeCliente'>";?><img src="../model/img/return.png" alt='Voltar'></a> 
            <div>
                <?php 
                echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";
                
                ?><br>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="produtos">
            <h2 style="font-size:120%;"><?php echo "$nomeCliente "; ?></h2>

            
                <?php
                $today=date("Y-m-d");
                    if ($res){

                        for($i=0;$i<count($res);$i++){
                            $dataEntregaRet = $res[$i]['dataEntrega'];
                            $dataEntrega=date('d/m/Y', strtotime($dataEntregaRet));
                            $valorTotal = $res[$i]['valorTotal'];  
                            $valorTotal = number_format($valorTotal,2,",",".");                                                                         
                            $codPedido = $res[$i]['codPedido'];
                            $entregue = $res[$i]['entregue'];
                            $cancelado=$res[$i]['cancelado'];
                            $dataFinalizacao=$res[$i]['dataFinalizacao'];
                            $dataFinalizacao=date('d/m/Y', strtotime($dataFinalizacao));
                            if($entregue==0 && $cancelado==0){
                                    
                                echo "
                                <a href='pedidoDetalhes.php?codPedido=$codPedido&codCliente=$codCliente&nomeCliente=$nomeCliente' >
                              
                                <div class='prod'";

                                if($today==$dataEntregaRet ){ //if para verificar se o pedido está atrasado ou se está no dia da entrega
                                    echo "style='background-color:#ffc107'";
                                }else if($today>$dataEntregaRet ){
                                    echo "style='background-color:#dc3545'";
                                }
                                
                                echo "
                                >

                                    <div class='nome'>
                                        <h3>Status: Pendente</h3>
                                    </div>

                                    <div class='dataEntrega'>
                                        <p>Data Entrega: $dataEntrega</p>
                                    </div>

                                    <div class='valor'>
                                        <p > R$ $valorTotal</p>
                                    </div>
                                
                                </div>
                                </a>
                            ";

                            }else if($entregue==1 && $cancelado==0){
                                
                            echo "
                         
                         
                            <a href='pedidoDetalhes.php?codPedido=$codPedido&codCliente=$codCliente&nomeCliente=$nomeCliente&verificador=1' >
                            <div class='prod'>
                         

                                <div class='nome'>
                                    <h3>Status: Entregue <img src='../model/img/confirm.png'></h3>
                                </div>

                                <div class='dataEntrega'>
                                    <p>Foi entregue em: $dataFinalizacao</p>
                                </div>

                                <div class='valor'>
                                    <p > R$ $valorTotal</p>
                                </div>
                            
                            </div>
                            </a>
                            ";
                            }else if ($cancelado==1 && $entregue==0){ //mudar ícone  e verificar a função remver item
                                echo "
                         
                         
                                <a href='pedidoDetalhes.php?codPedido=$codPedido&codCliente=$codCliente&nomeCliente=$nomeCliente&verificador=2' >
                                <div class='prod'>
                             
    
                                    <div class='nome'>
                                        <h3>Status: Cancelado <img src='../model/img/remover.png'></h3>
                                    </div>
    
                                    <div class='dataEntrega'>
                                        <p>Foi Cancelado: $dataFinalizacao</p>
                                    </div>
    
                                    <div class='valor'>
                                        <p > R$ $valorTotal</p>
                                    </div>
                                
                                </div>
                                </a>
                                ";
                            }
                            
                
                           
                        }
                        
                    }else{
                        echo "
                        <div>
                            <h3 style='margin:15px 0 0 10px;'>Nenhum pedido encontrado!</h3>
                        </div>
                        ";
                    }
                    ?>

        </div>
     

    </div>
    
</body>

</html>