<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/clientePagarDivida.css">
    <link rel="stylesheet" href="../model/css/modal.css">
    <title>Pagar Dívida</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="../model/js/jquery.maskMoney.min.js"></script>
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
$codPagamento = $_GET['codPagamento'];
$codCliente = $_GET['codCliente'];
$nomeCliente = $_GET['nomeCliente'];
$query = Pagamento::verDivida($codPagamento);
$res = $query->fetchALL(PDO::FETCH_ASSOC);



?>

<body>
    <div class="container-produtos">

        <div class="nav">
        <?php echo "<a href='./clienteDividas.php?codCliente=$codCliente&nomeCliente=$nomeCliente'><img src='../model/img/return.png' alt='Voltar'></a>";?>
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>"; ?><br>
            </div>

        </div>

        <div class="item">
      
            <?php
            $codPag = $res[0]['codPag'];

            $valorTotal = $res[0]['valorTotal'];
            $valorPago = $res[0]['valorPago'];
            $dataCompra = $res[0]['dataCompra'];
            $dataVenc = $res[0]['dataVenc'];
            $dataUltPag = $res[0]['dataUltPag'];
            $dataCompra = date('d/m/Y',  strtotime($dataCompra));
            $dataVenc = date('d/m/Y',  strtotime($dataVenc));
            $dataUltPag = date('d/m/Y',  strtotime($dataUltPag));
            $valorRestante = $valorTotal - $valorPago;
            $valorTotalFloat = str_replace(['.'], ',', $valorTotal);
            $valorPagoFloat = str_replace(['.'], ',', $valorPago);
            $valorRestanteFloat = str_replace(['.'], ',', $valorRestante);


            echo "
        
            <div class='dados'>
                <div class='valorTotal'>
                    <h3>Total: R$ $valorTotalFloat</h3>
                </div>
                <div class='dataCompra'>
                    <p>Data compra: $dataCompra</p>
                </div>
                <div class='valorPago'>
                    <p>Valor pago: $valorPagoFloat</p>
                </div>
                <div class='valorRestante'>
                    <p> Valor restante: $valorRestanteFloat</p>
                </div>
                <div class='dataUltPag'>
                    <p>Ult. Pag: $dataUltPag </p>
                </div> 
                <div class='dataVenc'>
                    <p>Vencimento: $dataVenc </p>
                </div>
               
                <div class='form'>
              
                    <form action='../control/controlePagamento.php' method='post'>
                        <label for=''>Novo pagamento:
                            <input name='valorProduto' id='valorProduto' type='text' placeholder='Restante: R$ $valorRestanteFloat' required='true'>
                            <input name='valorPago' id='valorPago' type='text' value='$valorPago' style='visibility:hidden'>
                            <input name='valorTotal' id='valorTotal' type='text' value='$valorTotal' style='visibility:hidden'>
                            <input name='codPagamento' id='codPagamento' type='text' value='$codPag' style='visibility:hidden'>
                            <input name='codCliente' id='codCliente' type='text' value='$codCliente' style='visibility:hidden'>
                            <input name='nomeCliente' id='nomeCliente' type='text' value='$nomeCliente' style='visibility:hidden'>
                            
                        </label>
                        <label for='tipoQuit'>Tipo de pagamento:

                            <select name='tipoQuit' id='tipoQuit' onChange='tipoPagamento();'>
                            <option value='1' selected>Pagamento</option>
                            <option value='2'>Quitado por Bonificação</option>
                            <option value='3'>Troca</option>
                            <option value='4'>Exclusão</option>
                            </select> 
                        </label>
             

                        <div class='add-item'>
                            <input name='opcao' type='submit' value='Confirmar' id='add-item-btn-confirmar'>

                        </div> 
                            
                      
                                <div class='cancelar-item'>
                                <a href='clienteDividas.php?codCliente=$codCliente&nomeCliente=$nomeCliente'>    <p>Cancelar</p> </a>
                                </div> 
                       


                    </form>
                </div>
               

            </div>
            ";
            ?>
            
        </div>

     
        
            <div id="abrirModal" class="modal">
                
                <h2>ATENÇÃO</h2>
                <p>Ao selecionar esta opção, o sistema irá salvar a dívida como paga. Caso não deseje isso, selecione a opção 
                    "Pagamento"
                    <a href="#fechar" title="Fechar" class="fechar">x</a>
                </p>
                
            
            </div>


    </div>
    <script type="text/javascript" src="../model/js/maskMoney.js"> </script>
    <script type="text/javascript" src="../model/js/pagamento.js"> </script>
</body>

</html>