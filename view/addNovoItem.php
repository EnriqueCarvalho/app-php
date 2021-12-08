<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/addNovoitem.css">
    <title>Editar item</title>
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
    <div class="container-produtos">

    <div class="nav">
            <a href="javascript: history.go(-1)"><img src="../model/img/return.png" alt="Voltar"></a>
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";?><br>
            </div>
    
        </div>

        <div class="item">
            <h2>EDITAR ITEM</h2>
            <?php

                $codProduto = $_GET['codProduto'];
                $query  = Pedido::selecionarProduto($codProduto);

                $res = $query->fetchALL(PDO::FETCH_ASSOC);
                $nome = $res[0]['nomeProduto'];
                $qtde = $res[0]['qtdeEstoque'];
                $descri = $res[0]['descricaoProduto'];
                $valor = $res[0]['valorProduto'];
                $desconto = $res[0]['descontoMaximoValor'];
                $valorFloat = str_replace(['.'],',',$valor);

                echo"
                            <div class='it'>
                            <div class='nome'>
                                <h3>$nome</h3>
                            </div>
                            <div class='qtde'>
                                <p>Qtd: $qtde</p>
                            </div>
                            <div class='descri'>
                                <p>$descri</p>
                            </div>
                            <div class='desconto'>
                                <p> Desc. $desconto%</p>
                            </div>
                            <div class='valor'>
                                <p> R$ $valorFloat</p>
                            </div>
                            <div class='form'>
                                <form action='../control/controlePedido.php' method='post'>
                                    <label for=''>Desconto  %
                                        <input name='desconto' id='add-desconto' type='number' max='$desconto' required='required' pattern='[0-9]+$'>
                                    </label>
                                    <label for=''>Quantidade
                                        <input name='quantidade' id='add-quantidade' type='number' max='$qtde' required='required' pattern='[0-9]+$'>
                                    </label>
                                    <div class='lab-calc' onclick='calcular($valor);' >
                                        <p>Calcular sub-total</p>
                                    </div>
                                    <label>
                                        <p>Valor: R$ <span id='valorSumario'></span></p>
                                    </label>
                                
                                    <label >
                                        <input name='valor' type='text'   id='valor-sum' class='valor' required='true' style='visibility: hidden;' >
                                        <input name='codProduto' type='text'   value='$codProduto' class='valor' style='visibility: hidden;' >
                                    </label>
                                
                                
                                    <div class='add-item'>
                                        <input name='opcao' type='submit' value='Confirmar' id='add-item-btn-confirmar' >

                                    </div>


                                </form>
                            </div>


                        </div>
                ";
                
            ?>




        


        </div>


    </div>
    <script src="../model/js/addItem.js" type="text/javascript"></script>
</body>

</html>