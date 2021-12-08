<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/menuInicial.css">
    <title>Pedidos</title>
</head>
<?php

session_start();
if (isset($_SESSION['nomeFunc'])) {
} else {
    header("Location: index.php");
}
$nomeFunc = $_SESSION['nomeFunc'];
$nomeEmpresa = $_SESSION['nomeEmpresa'];




?>

<body>
    <div class="container-menu">

        <div class="nav">
            <a href="./menu.php"><img src="../model/img/return.png" alt="Voltar"></a>
            <div>
                <h2 style='margin-bottom:0px;'>Enrique</h2> <sub style='font-size:70%;padding-left:2%;'>Eustacio</sub><br>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="menu">
            <a href="./pgVerPedidos.php">
                <div>
                    <img src="../model/img/pedido.png">
                    <p>Pedidos em aberto</p>
                </div>
            </a>
            <a href="./pedidoSelCliente.php">
                <div>
                    <img src="../model/img/add.png">
                    <p> Novo Pedido</p>
                </div>
            </a>
           





        </div>

    </div>
</body>

</html>