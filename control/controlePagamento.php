<?php
include '../model/Pagamento.php';

if (isset($_GET['opcao'])) { //----------------------------GET---------------------------------------
    $opcao = $_GET['opcao'];
} else if (isset($_POST['opcao'])) { //----------------------------POST---------------------------------------
    $opcao = $_POST['opcao'];
    if ($opcao == 'Confirmar') {
        $valorPago = 0;
        $valorNovoPagamento = 0;
        if (!empty($_POST['valorProduto'])) { //caso o $_post esteja vazio 
            $valorNovoPagamento = $_POST['valorProduto'];
            $valorNovoPagamento = str_replace(['.'], '', $valorNovoPagamento);
            $valorNovoPagamento = str_replace([','], '.', $valorNovoPagamento); //conversão do número em formato BRL para a ling. PHP

        }

        $valorPago = $_POST['valorPago'];
        $valorTotal = $_POST['valorTotal'];
        $codPagamento = $_POST['codPagamento'];
        $opcaoPagamento = $_POST['tipoQuit'];
        $codCliente = $_POST['codCliente'];
        $nomeCliente = $_POST['nomeCliente'];
        $veri = $valorNovoPagamento + $valorPago;




        if ($opcaoPagamento == 1 && $veri < $valorTotal) { //verifica o tipo de pagamento (pagamento,troca,exclusão ou troca por bonificação), e se o valor total foi abatido por completo
            Pagamento::atualizarDivida($codPagamento, $veri);
        } else {
            Pagamento::quitarDividaPagamento($codPagamento, $veri, $opcaoPagamento);
        }

        
        echo "<script>window.location = '../view/clienteDividas.php?codCliente=$codCliente&nomeCliente=$nomeCliente';</script>";
    }
}
