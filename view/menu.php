<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/menuInicial.css">
    <title>Menu</title>
</head>
<?php

		session_start();
			if (isset($_SESSION['nomeFunc'])){
				
			}else {
				header("Location: index.php");
            }
            $nomeFunc = $_SESSION['nomeFunc'];
            $nomeEmpresa = $_SESSION['nomeEmpresa'];
	

		

       ?>
<body>
    <div class="container-menu">
        
        <div class="nav">
        
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";?><br>
            </div>
            <p>Menu Inicial</p>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="menu">
          
            <a href="./pgcadastroClientes.php">
                <div>
                   <img src="../model/img/add-friend.png">
                    <p>Cadastrar cliente</p>
                </div>
            </a>
            <a href="./consultarCliente.php">
                <div>
                <img src="../model/img/search.png">
                    <p>Consultar clientes</p>
                </div>
            </a>
            <a href="./pgproduto.php">
                <div>
                <img src="../model/img/estoque.png">
                    <p>Estoque de produtos</p>
                </div>
            </a>
           
            <a href="./pedidosMenu.php">
                <div>
                <img src="../model/img/pedido.png">
                    <p>Pedidos</p>
                </div>
            </a>
         
            
        </div>

    </div>
</body>

</html>