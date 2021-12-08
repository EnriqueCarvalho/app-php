<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/clienteDividas.css">
    <title>Dívidas</title>
</head>
<?php
include "../model/Pagamento.php";
session_start();
if (isset($_SESSION['nomeFunc'])) {
} else {
    header("Location: index.php");
}
$nomeFunc = $_SESSION['nomeFunc'];
$nomeEmpresa = $_SESSION['nomeEmpresa'];
$codEmpresa = $_SESSION['codEmpresa'];
$codCliente = $_GET['codCliente'];
$nomeCliente = $_GET['nomeCliente'];
$query = Pagamento::dividasCliente($codEmpresa, $codCliente);
$res = $query->fetchALL(PDO::FETCH_ASSOC);


?>
  <!--
            No select, puxar o nome do funcionario(empresa) que realizou o pedido e
            agrupar ela pesquisa pelo nome do funcionário. E validar nessa página para verificar se precisa
            digitar de novo o nome do funcionário ou não. Ex.

            $nomeFunc = $res[$i][nomeFuncionario];
            blocoRepetição{
            if ($nomeFunc==$_res[$i][nomeFunc]){
                echo "<div>Empresa: $nomeFunc</div>"
            }
            segue o programa

            }

     

        -->

<body>
    <div class="container-produtos">

        <div class="nav">
            <?php echo "<a href='./clienteMenu.php?codCliente=$codCliente&nomeCliente=$nomeCliente'><img src='../model/img/return.png' alt='Voltar'></a>"; ?>
            <div>
                <h2 style='margin-bottom:0px;'>Enrique</h2> <sub style='font-size:70%;padding-left:2%;'>Eustacio</sub><br>
            </div>

            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="produtos">

            <?php

           
            if ($res) {
                $nomeFuncionario=$res[0]['nomeFuncionario'];
                echo "<h1>Dívidas em aberto: " . count($res) . "</h1>";
                for ($i = 0; $i < count($res); $i++) {
                    $codPag = $res[$i]['codPag'];
                    $codVendaApp = $res[$i]['codVendaApp'];
                    $valorTotal = $res[$i]['valorTotal'];
                    $valorPago = $res[$i]['valorPago'];
                    $dataCompra = $res[$i]['dataCompra'];
                    $dataVenc = $res[$i]['dataVenc'];
                    $dataCompra = date('d/m/Y',  strtotime($dataCompra));
                    $dataVenc = date('d/m/Y',  strtotime($dataVenc));
                    $valorRestante = $valorTotal - $valorPago;
                    $valorTotalFloat = str_replace(['.'], ',', $valorTotal);
                    $valorPagoFloat = str_replace(['.'], ',', $valorPago);
                    $valorRestanteFloat = str_replace(['.'], ',', $valorRestante);
                    echo $nomeFuncionario;




                    echo "
                            <h3 style='color:#000;background-color:#ccc;'>asdasd</h3>
                                    <div class='prod'>
                                        <div class='total'>
                                            <h3>Valor total: R$ $valorTotalFloat</h3>
                                         
                                        </div>
                                        <div class='dataCompra'>
                                             <p>
                                             $dataCompra
                                             ";

                    if ($codVendaApp != 0) {
                        echo "<img src='../model/img/cel.png'>";
                    }else{
                        echo "<img src='../model/img/ps.png'>";
                    }

                    echo " 
                                              
                                           
                                            <p>
                                     
                                         </div>
                                        
                                        <div class='valorPago'>
                                            <div>Valor pago: R$  $valorPagoFloat  </div> 
                                        </div>
                                        <div class='dataUltPag'>
                                            <p>Valor restante: $valorRestanteFloat</p>
                                        </div>
                                        <div class='dataVenc'>
                                            <p>Vencimento:  $dataVenc</p>
                                        </div>
                                        <a class='pagar' href='clientePagarDivida.php?codPagamento=$codPag&codCliente=$codCliente&nomeCliente=$nomeCliente'>
                                            <div >
                                                Pagar
                                            </div>
                                        </a>
                            
                                
                                    </div>
                                   
                                
                                ";
                }
            } else {
                echo "<h3>Nenhuma dívida em aberto</h3>";
            }
            ?>























        </div>
        <div class="add-produto">

            <a href="addproduto.php">
                <div>+ Adicionar Produtos</div>
            </a>


        </div>

    </div>
</body>

</html>