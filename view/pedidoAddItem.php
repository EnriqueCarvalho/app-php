<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/produtos.css">
    <title>Selecionar Produtos</title>
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
            $codEmpresa = $_SESSION['codEmpresa'];
            $codPedido = $_SESSION['codPedido'];

            
            $query = Pedido::verProdutosNaoSelecionados($codPedido,$codEmpresa);
            $res = $query->fetchALL(PDO::FETCH_ASSOC);
            
		

       ?>

<body>
    <div class="container-produtos">

    <div class="nav">
            <a href="javascript: history.go(-1)"><img src="../model/img/return.png" alt="Voltar"></a>
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>";?><br>
            </div>
    
        </div>

        <div class="produtos">
            <h2>SELECIONAR PRODUTOS</h2>

            
                <?php
                    if ($res){

                        for($i=0;$i<count($res);$i++){
                            $nome = $res[$i]['nomeProduto'];
                            $qtde = $res[$i]['qtdeEstoque'];
                            $descri = $res[$i]['descricaoProduto'];
                            $valor = $res[$i]['valorProduto'];
                            $desconto = $res[$i]['descontoMaximoValor'];
                            $codProduto = $res[$i]['codProduto'];
                            echo "
                            <a href='./addNovoItem.php?codProduto=$codProduto'>
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
                                    <p> R$ $valor</p>
                                </div>
                             
                            </div>
                            </a>
                            ";
                        }
                        
                    }
                    ?>

                
                
               
               
                
                
            
       
           

        </div>
        

    </div>
</body>

</html>