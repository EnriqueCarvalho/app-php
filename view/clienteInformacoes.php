<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/Detalhes.css">
    <link rel="stylesheet" href="../model/css/modal.css">


    <title>Detalhes do pedido</title>
</head>
<?php
include "../model/Cliente.php";
date_default_timezone_set('America/Sao_Paulo');

session_start();
if (isset($_SESSION['nomeFunc'])) {
} else {
    header("Location: index.php");
}
$nomeFunc = $_SESSION['nomeFunc'];
$nomeEmpresa = $_SESSION['nomeEmpresa'];
$codEmpresa = $_SESSION['codEmpresa'];
$codCliente = $_GET['codCliente'];
$nomeCliente = $_GET['nomeCliente'];

$query = Cliente::informacoesCliente($codCliente);
$res = $query->fetchALL(PDO::FETCH_ASSOC);







?>

<body>
    <div class="container-produtos">

        <div class="nav">
            <?php echo " <a href='./clienteMenu.php?codCliente=$codCliente&nomeCliente=$nomeCliente'><img src='../model/img/return.png' alt='Voltar'></a> "; ?>
            <div>
                <?php echo "<h2 style='margin-bottom:0px;'>$nomeFunc</h2> <sub style='font-size:70%;padding-left:2%;'>$nomeEmpresa</sub>"; ?><br>
            </div>
            <a href="../control/controleFuncionario.php?opcao=Sair"><img src="../model/img/logout.png"></a>
        </div>

        <div class="produtos">

            <?php

            if ($res) {
                //informações gerais
                $razaoSocial = $res[0]['razaoSocial'];
                $nomeFantasia = $res[0]['nomeFantasia'];
                $cnpj = $res[0]['cnpjCliente'];
                $telefone = $res[0]['telefoneCliente'];
                $emailCliente = $res[0]['emailCliente'];
                $observacao = $res[0]['observacaoCliente'];
                //endereço
                $ruaCliente = $res[0]['ruaCliente'];
                $numEnd = $res[0]['numEnd'];
                $bairro = $res[0]['bairroCliente'];
                $cidade = $res[0]['cidadeCliente'];
                $uf = $res[0]['ufCliente'];
                $cep = $res[0]['cepCliente'];
                $fone = $res[0]['telefoneCliente'];



                echo "
                <form action='../control/controleClientes.php' method='post' class='edicao'>
                        <input type='text' name='codCliente' value='$codCliente' style='display:none;'>
                        
            
                        <div><label>Razão Social:<input type='text' name='razaoSocial' value='$razaoSocial' readonly class='editar'></label> </div>

                        <div><label>Nome Fantasia:<input type='text' name='nomeFantasia' value='$nomeFantasia' readonly class='editar'></label> </div>

                        <div><label>CNPJ/CPF: <input  type='text' name='cnpj' value='$cnpj' readonly class='editar'></label> </div>

                        <div><label>Telefone:<input type='text' name='telefone' value='$telefone' readonly class='editar'></label> </div>

                        <div><label>E-mail:<input type='email' name='emailCliente' value='$emailCliente' readonly class='editar'></label> </div>

                        <div><label>Observação :<textarea type='text' name='observacaoCliente'  readonly class='editar'> $observacao</textarea></label> </div>


                        <div class='detalhes'>Endereço</div>

                        <div><label>Rua:<input type='text' name='ruaCliente' value='$ruaCliente' readonly class='editar'></label> </div>

                        <div><label>Nº:<input type='text' name='numEnd' value='$numEnd' readonly class='editar'></label> </div>

                        <div><label>Bairro:<input type='text' name='bairro' value='$bairro' readonly class='editar'></label> </div>

                        <div><label>Cidade:<input type='text' name='cidade' value='$cidade' readonly class='editar'></label> </div>

                        <div><label>UF:<input type='text' name='uf' value='$uf' readonly class='editar'></label> </div>

                        <div><label>CEP:<input type='text' name='cep' value='$cep' readonly class='editar'></label> </div>

                    <button type='submit' value='Alterar' name='opcao' class='confirmarAlteracao btn-edit' id='confirmarAlteracao'>Confirmar Alteração</button>
                </form>


                <button onclick='habilitarEdicao();' class='habilitarEdicao btn-edit' id='habilitarEdicao'>Editar</button>
                <button onclick='desabilitarEdicao();' class='cancelarAlteracao btn-edit' id='cancelarAlteracao'>Cancelar</button>
                    
                ";
            }
            ?>


        </div>


    </div>
    <script type="text/javascript" src="../model/js/geral.js"></script>

</body>

</html>