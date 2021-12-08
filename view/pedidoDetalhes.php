<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/Detalhes.css">
    <link rel="stylesheet" href="../model/css/modal.css">
    <script type="text/javascript" src="../model/js/pedido.js"></script>
    <title>Detalhes do pedido</title>
</head>
<?php
include "../model/Pedido.php";
date_default_timezone_set('America/Sao_Paulo');

session_start();
if (isset($_SESSION['nomeFunc'])) {
} else {
    header("Location: index.php");
}
$returnPage = 0; //variável para saber se o return da página irá ser para a página geral de pedidos, ou de pedidos de determinado cliente

if (isset($_GET['codCliente'])) {
    $returnPage = 1;
}

$nomeFunc = $_SESSION['nomeFunc'];
$nomeEmpresa = $_SESSION['nomeEmpresa'];
$codEmpresa = $_SESSION['codEmpresa'];
$codPedido = $_GET['codPedido'];
$query = Pedido::detalhesPedidos($codPedido);
$res = $query->fetchALL(PDO::FETCH_ASSOC);
$codCliente = $res[0]['codCliente'];

$queryDetalhes = Pedido::detalhesPedidosProdutos($codPedido);
$resprodutos = $queryDetalhes->fetchALL(PDO::FETCH_ASSOC);




?>

<body>
    <div class="container-produtos">

        <div class="nav">
            <?php
            if ($returnPage == 1) {
                $codCliente = $_GET['codCliente'];
                $nomeCliente = $_GET['nomeCliente'];
                echo "<a href='./clienteVerPedidos.php?codCliente=$codCliente&nomeCliente=$nomeCliente'><img src='../model/img/return.png' alt='Voltar'></a>";
            } else {
                echo "  <a href='./pgVerPedidos.php'><img src='../model/img/return.png' alt='Voltar'></a>";
            }

            ?>

            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>"; ?><br>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="produtos">



            <?php
            $today = date("Y-m-d");

            if ($res) {


                $dataEntrega = $res[0]['dataEntrega'];
                $dataPedido = $res[0]['horaFimPedido'];
                $dataVencimento = $res[0]['dataVencimento'];
                $dataPedido = date('d/m/Y', strtotime($dataPedido));
                $dataEntregaMod = date('d/m/Y', strtotime($dataEntrega));
                $dataVencimento = date('d/m/Y', strtotime($dataVencimento));
                $valorTotal = $res[0]['valorTotal'];
                $valorTotal = number_format($valorTotal, 2, ",", ".");

                $nomeCliente = $res[0]['nomeCliente'];
                $codPedido = $res[0]['codPedido'];
                $formaPagamento = $res[0]['formaPagamento'];
                $valorParcela = $res[0]['valorParcela'];
                $obsPedido = $res[0]['obsPedido'];
                $pago = $res[0]['pago'];


                $ruaCliente = $res[0]['ruaCliente'];
                $numEnd = $res[0]['numEnd'];
                $bairro = $res[0]['bairroCliente'];
                $cidade = $res[0]['cidadeCliente'];
                $uf = $res[0]['ufCliente'];
                $cep = $res[0]['cepCliente'];
                $fone = $res[0]['telefoneCliente'];




                echo "
                <div ";
                if (isset($_GET['verificador'])) {
                    echo " ><p>Status: Entregue</p>  </div>";
                } else {
                    if ($today == $dataEntrega) { //if para verificar se o pedido está atrasado ou se está no dia da entrega
                        echo "style='background-color:#ffc107;color:#000;'><p>Status:  Deve ser entregue hoje</p></div>";
                    } else if ($today > $dataEntrega) {
                        echo "style='background-color:#dc3545;color:#fff;'><p>Status: Atrasado</p> </div>";
                    }
                }

                echo "
                
                <div><p>Data de entrega:</p><p><a href='#abrirModal'><img src='../model/img/edit.png'></a> $dataEntregaMod</p></div>
                <div><p>Nome do cliente:</p><p> $nomeCliente</p></div>
                <div style='font-weight:bold;' ><p>Valor total:";
                if ($pago == 1) {
                    echo " &nbsp (Pago)";
                }
                echo "
                </p> <p >R$ $valorTotal</p></div>
                <div><p>Forma de pagamento:</p><p> $formaPagamento</p></div>
                <div><p>Valor da parcela:</p><p> 
                
                
                ";
                if ($formaPagamento == 'À vista') {
                    echo "-</p></div>";
                } else {
                    echo "$valorParcela</p></div>";
                }
                echo "
                <div><p>Vencimento:</p><p> $dataVencimento</p></div>
                <div><p>Data do pedido:</p><p> $dataPedido</p></div>
                <div style='border-bottom:none;font-weight:bold;padding-bottom:0px;' ><p >Observação:</p></div>
                <div style='padding-top:0px;' ><p> $obsPedido</p></div>
                <div class='detalhes'>Detalhes</div>";

                if ($resprodutos) {
                    for ($i = 0; $i < count($resprodutos); $i++) {
                        $qtdeItem = $resprodutos[$i]['qtdeItem'];
                        $nomeProduto = $resprodutos[$i]['nomeProduto'];
                        $subTotal = $resprodutos[$i]['subTotal'];
                        $subTotal = number_format($subTotal, 2, ",", ".");
                        $desconto = $resprodutos[$i]['desconto'];

                        echo "
                <div>
                <table>
                <tr>
                 <td style='font-weight:bold' colspan='2'>$nomeProduto</td>
               
                </tr>
                <tr>
                    <td>Qtd: $qtdeItem</td>
                    <td class='right'>Desconto: $desconto%</td> 
                </tr>
                <tr>
                <td> &nbsp;</td>
                    <td class='right'>R$ $subTotal</td>
                </tr>
                </table>
                  
                </div>
             ";
                    }
                }

                echo "
                    <div class='detalhes'>Endereço</div>
                    <div>Rua: $ruaCliente, nº $numEnd</div>
                    <div>Bairro: $bairro</div>
                    <div> $cidade - $uf</div>
                    <div> Cep: $cep</div>
                    <div> Fone: $fone</div>

                   
              
                ";
                if (!isset($_GET['verificador'])) {
                    echo "
                        <form method='post' action='../control/controlePedido.php' class='finalizar' id='pedidoEntregue'>
                                
                            <label>
                                <input type='button' value='Cancelar pedido' class='cancelarPedido' onclick='cancelarPedido();'>
                            </label>
                        
                            <label>
                                <input name='opcao' type='submit' value='Entregue' class='entregue'>
                            </label> 
                            <input name='codPedido' type='text' value='$codPedido'  style='display:none'>
                
                        </form>

                        <form method='post' action='../control/controlePedido.php' class='cancelamentoPedido' id='motivoCancelamento' >
                            
                            <label>
                                <textarea name='motivoCancel' type='text' placeholder='Digite aqui o motivo do cancelamento'  required='true' maxlength='250'></textarea>
                            </label> 
                            <input name='codPedido' type='text' value='$codPedido'  style='display:none'>
                            <label>
                                <button name='opcao' type='submit' value='CancelarPedido' class='cancelarPedido'>Cancelar Pedido</button>
                                
                            
                            </label> 
                    
                        </form>
                    
                    ";
                }else if ($_GET['verificador']==2){
                    $motivoCancel = $res[0]['motivoCancel'];
                    echo " <div> Motivo do Cancelamento: $motivoCancel</div>";
                }
            }
            ?>


        </div>
        <div id="abrirModal" class="modal">

            <h2>ATENÇÃO</h2>
            <p>Ao selecionar esta opção, o sistema irá alterar a data do pedido.
                Certifique-se que o cliente está ciente de tal modificação.
            <form action="../control/controlePedido.php" method="POST" style="margin-top: 20px;">
                <label for="" class="dataEntrega">Nova data de entrega:
                    <input name="dataEntrega" type="date" required="true" onchange="btnConfirmar()">
                    <input class='confirmar' name="opcao" id="confirmar" type="submit" required="true" value="Alterar data do pedido">
                    <?php echo " <input name='codPedido' id='codPedido' type='text' value='$codPedido' style='visibility:hidden'>"; ?>
                </label>
            </form>
            <a href="#fechar" title="Fechar" class="fechar">x</a>
            </p>


        </div>


    </div>
    <script type="text/javascript" src="../model/js/pedido.js"></script>
</body>

</html>