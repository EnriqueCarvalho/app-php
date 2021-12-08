<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/produtos.css">
    <title>Login</title>
</head>
<?php
    include "../model/Produto.php";
		session_start();
			if (isset($_SESSION['nomeFunc'])){
				
			}else {
				header("Location: index.php");
            }
            $nomeFunc = $_SESSION['nomeFunc'];
            $nomeEmpresa = $_SESSION['nomeEmpresa'];
            $codEmpresa = $_SESSION['codEmpresa'];

            
            $query = Produto::visualizarProduto($codEmpresa);
            $res = $query->fetchALL(PDO::FETCH_ASSOC);
            
		

       ?>

<body>
    <div class="container-produtos">

    <div class="nav">
            <a href="./menu.php"><img src="../model/img/return.png" alt="Voltar"></a>
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";?><br>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="produtos">
            <h2>PRODUTOS</h2>

            
                <?php
                    if ($res){

                        for($i=0;$i<count($res);$i++){
                            $nome = $res[$i]['nomeProduto'];
                            $qtde = $res[$i]['qtdeEstoque'];
                            $descri = $res[$i]['descricaoProduto'];
                            $valor = $res[$i]['valorProduto'];
                            $desconto = $res[$i]['descontoMaximoValor'];
                            $valorFloat = str_replace(['.'],',',$valor);
                            echo "
                            <a href='#'>
                                <div class='prod'>
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
                                
                                </div>
                                </a>
                            ";
                        }
                        
                    }
                    ?>

                
                
               
               
                
                
            
       
           

        </div>
        <div class="add-produto">
            
                <a href="addproduto.php"><div>+ Adicionar Produtos</div></a>
           
            
        </div>

    </div>
</body>

</html>