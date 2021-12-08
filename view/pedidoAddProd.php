<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/pedidoAddProd.css">
    <title>Pedido</title>
</head>
        <?php
            include "../model/Pedido.php";
            session_start();
                if (isset($_SESSION['nomeFunc'])){
                    
                }else {
                    header("Location: index.php");
                }
                $nomeFunc = $_SESSION['nomeFunc'];
                $nomeEmpresa = $_SESSION['nomeEmpresa'];
                $codPedido = $_SESSION['codPedido'];
        
       ?>

<body>
    <div class="container-pedidos">

    <div class="nav">
            
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc
                </h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";?><br>
            
            </div>
            
    </div>

        <div class="pedidos">
            <h2>PEDIDO</h2>
            

            <?php
                $valorTotal = 0;
                
                $query = Pedido::verItensDoPedido($codPedido);
                if(isset($query)){

               
                $res = $query->fetchALL(PDO::FETCH_ASSOC);              
                
                
               
                if($res){
                    for($i=0;$i<count($res);$i++){
                        $qtdeItem = $res[$i]['qtdeItem'];
                        $desconto = $res[$i]['desconto'];
                        $codProduto = $res[$i]['codProduto'];
                        $subTotal = $res[$i]['subTotal'];
                       

                        $queryDetalhes = Pedido::detalhesProdutos($codProduto);
                        $resDetalhes = $queryDetalhes->fetchALL(PDO::FETCH_ASSOC);

                        $nomeProduto = $resDetalhes[0]['nomeProduto'];
                        $descricaoProduto = $resDetalhes[0]['descricaoProduto'];
                        $codProduto = $resDetalhes[0]['codProduto'];
                        
                       
                        


                        echo "
                        <div class='ped'>

                                <div class='nome'>
                                    <h3>$nomeProduto</h3>
                                </div>
                                <div class='qtde'>
                                    <p>Qtd: $qtdeItem</p>
                                </div>
                                <div class='descri'>
                                    <p>$descricaoProduto</p>
                                </div>
                                <div class='desconto'>
                                    <p> Desc. $desconto%</p>
                                </div>
                                <div class='valor'>
                                    <p> R$ $subTotal</p>
                                </div> 
                                <div class='remover' >
                                    <a href='../control/controlePedido.php?opcao=RemoverItem&codProduto=$codProduto&codPedido=$codPedido&qtdeItem=$qtdeItem' class='btn-remover'>
                                        <div> <img src='../model/img/remover.png' alt='Remover'> </div>
                                    </a>
                                </div>
        
                        </div>
                        ";
                        $valorTotal = $valorTotal+$subTotal;
                    }
                }
                echo "<div class='soma'>
                         <p>Total: $valorTotal</p>
                 
                    </div>";
            }
            ?>

            


        </div>
        <div class="opcoes" id="opcoes">

            <a href="../control/controlePedido.php?opcao=addItem" class="add-item">
                <div>+ Adicionar </div>
            </a>
            <a  class="btn-finalizar" onclick="finalizar();">
                <div>Finalizar Pedido</div>
            </a>
             <a href="../control/controlePedido.php?opcao=CancelarPedido" class="cancelar">
                <div>Cancelar Pedido</div>
            </a>


        </div>
        <div class="finalizar" id="finalizar-pedido" >
            <form action="../control/controlePedido.php" method="post">
                  
            <label for="" class="valorTotal">Valor Total
                <input id="valorTotal" name="valorTotal"  type="text" value='<?php echo $valorTotal; ?>' readonly>
            </label> 
            
            <label for="formaPagamento" class="formaPag">Forma de pagamento
               <select id="formaPagamento" name="formaPagamento"   onchange="formaDePagamento();">
                    <option  value="avista" selected>Á vista</option>
                    <option value="parcelado">Parcelado</option>
                </select>
            </label>
            <label for="" class="dataVencimento">Vencimento
                <input name="dataVencimento"  type="date"  required="true">
            </label>
            
            <label for="numParc" class="numParc" id='lbl-NumParcela'>Número de parcelas
               <select id='numParc' name="numParcelas" onchange="calcularParcela()">
                    <option value="0">--</option>
                    <option value="2">2x</option>
                    <option value="3">3x</option>
                    <option value="4">4x</option>
                    <option value="5">5x</option>
                    <option value="6">6x</option>
                </select>
            </label> 
            <label for="" id ="lbl-valorParcela"    class="valorParcela">Valor da parcela
                <input id='valorParcela' name="valorParcela"  type="text"  readonly>
            </label>
           
            <label for="" class="dataEntrega">Data de entrega
                <input name="dataEntrega"  type="date"  required="true">
            </label>
            <label for="obsPedido" class="obsPedido">Observação
                    <textarea type="text" id="obsPedido" 
                    required="true" name="obsPedido" maxlength="250"></textarea>
            </label> 
            <div  class="btn-salvar">
                <input name="opcao"  type="submit" value="Salvar" >
            </div>
            <a href="../control/controlePedido.php?opcao=CancelarPedido" class="cancelar">
                <div>Cancelar </div>
            </a>

          
                         
            </form>
        </div>

    </div>
    <script type="text/javascript" src="../model/js/finalizarPedido.js"></script>
</body>

</html>