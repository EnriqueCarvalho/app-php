<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/addproduto.css">
    <title>Login</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
    <script type="text/javascript" src="../model/js/jquery.maskMoney.min.js"></script>
 
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
    <div class="container-produtos">

        <div class="nav">
            <a href="javascript: history.go(-1)"><img src="../model/img/return.png" alt="Voltar"></a>
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";?><br>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="produtos">
            <h2>Adicionar Produtos</h2>
            <div class="add-produtos">

                <form action="../control/controleProduto.php" method="POST">
                    <div class="nome">
                        <label for="nome">Nome
                            <input type="text" id="nome" placeholder="Digite o nome do produto" required="true"
                                name="nome" maxlength="50" >
                        </label>
                    </div>
                    <div class="valorProduto">
                        <label for="valorProduto">Valor
                            <input  type="text" id="valorProduto" placeholder="00,00" required="true"
                                name="valorProduto" class="menor" >
                        </label>
                    </div>
                    <div class="descontoMaximo">
                        <label for="descontoMaximo">Desconto %
                            <input type="number" id="descontoMaximo" placeholder="0" required="true"
                                name="descontoMaximo" class="menor" pattern="[0-9]+$">
                        </label>
                    </div>
                    <div class="qtdeEstoque">
                        <label for="qtdeEstoque">Qtd. em estoque
                            <input type="number" id="qtdeEstoque" placeholder="0" required="true" name="qtdeEstoque"
                                class="menor" pattern="[0-9]+$">
                        </label>
                    </div>
                    <div class="descricaoProduto">
                        <label for="descricaoProduto">Descrição
                            <textarea type="text" id="descricaoProduto" placeholder="Digite a descrição do produto"
                                required="true" name="descricaoProduto" maxlength="250"></textarea>
                        </label>
                    </div>




                    <input type="submit" value="Salvar" class="btn-cadastrar" name="opcao">
                    
                </form>
            </div>


        </div>


    </div>
    
    <script type="text/javascript" src="../model/js/maskMoney.js"> </script>
</body>

</html>