<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/menu.css">
    <title>Clientes</title>
</head>
<?php

session_start();
if (isset($_SESSION['nomeFunc'])) {
} else {
    header("Location: index.php");
}
$nomeFunc = $_SESSION['nomeFunc'];
$nomeEmpresa = $_SESSION['nomeEmpresa'];
$codCliente = $_GET['codCliente'];
$nomeCliente = $_GET['nomeCliente'];



?>

<body>
    <div class="container-menu">


        <div class="nav">
            <a href="./menu.php"><img src="../model/img/return.png" alt="Voltar"></a>
            <div>
                <p><?php echo "<div>$nomeCliente </div>" ?></p>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>
        

        <div class="menu">
           <?php echo "<a href='./clienteInformacoes.php?codCliente=$codCliente&nomeCliente=$nomeCliente'>" ?>
                <div>
                    <div class="menu1">
                        <img src="../model/img/info.png">

                    </div>
                    <p>Informações</p>
                </div>
            </a>
            <?php echo " <a href='./clienteVerPedidos.php?codCliente=$codCliente&nomeCliente=$nomeCliente'>"; ?>
                <div>
                    <div class="menu1">
                        <img src="../model/img/pedido.png">

                    </div>
                    <p>Pedidos</p>
                </div>
            </a>
            <a href="#">
                <div>
                    <div class="menu1">
                        <img src="../model/img/orcamento.png">

                    </div>
                    <p>Orçamentos</p>
                </div>
            </a>
            <?php echo " <a href='./clienteDividas.php?codCliente= $codCliente&nomeCliente=$nomeCliente'>"; ?>
            <div>
                <div class="menu1">
                    <img src="../model/img/pagamento.png">

                </div>
                <p>Dívidas</p>
            </div>
            </a>




        </div>

    </div>
</body>

</html>