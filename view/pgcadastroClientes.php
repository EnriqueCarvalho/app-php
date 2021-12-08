<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/addclientes.css">
    <title>Adicionar Clientes</title>


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
            <h2>ADICIONAR CLIENTES</h2>
            <div class="add-clientes">

                <form action="../control/controleClientes.php" method="POST">
                    <div class="nomeFantasia">
                        <label for="nomeFantasia">Nome Fantasia
                            <input type="text" id="nomeFantasia" placeholder="Digite o nome fantasia do cliente"
                                required="true" name="nomeFantasia" maxlength="100">
                        </label>
                    </div>
                    <div class="razaoSocial">
                        <label for="razaoSocial">Razão Social
                            <input type="text" id="razaoSocial" placeholder="Digite a razão social do cliente"
                                required="true" name="razaoSocial" maxlength="100">
                        </label>
                    </div>
                    <div class="cnpjCliente">
                        <label for="cnpjCliente">CNPJ/CPF
                            <input type="text" id="cnpjCliente" name="cnpjCliente"
                                class="cnpj" required="true"  pattern="[0-9]+$" maxlength='14' minlength="11"
                                placeholder="Digite o CPF/CNPJ sem formatação ' \ ', ' - ' ou ' . '">
                        </label>
                    </div>
                  
                    <div class="cepCliente">
                        <label for="cepCliente">CEP
                            <input type="text" id="cepCliente" placeholder="9999-999" name="cepCliente" 
                                class="cep" onblur="pesquisacep(this.value);cepWeb();" >
                        </label>
                        <label for="semCep" id="lsemCep">Não sei meu CEP:
                            <input type="checkbox" id="semCep" placeholder="9999-999" name="semCep" class="semCep" onclick="cepCheck();">
                        </label>
                    </div>

                    <div class="ruaCliente">
                        <label for="ruaCliente">Rua
                            <input type="text" id="rua" name="ruaCliente"
                                required="true" maxlength="100" readonly="true" style="visibility:hidden;">
                        </label>
                    </div>
                    <div class="numEnd">
                        <label for="numEnd">Nº
                            <input type="number" id="numEnd" placeholder="Nº do endereço" name="numEnd" required="true"
                                pattern="[0-9]+$" class="menor">
                        </label>
                    </div>
                    <div class="bairroCliente">
                        <label for="bairroCliente">Bairro
                            <input type="text" id="bairro" name="bairroCliente" required="true" readonly="true" style="visibility:hidden;">
                        </label>
                    </div>
                    <div class="cidadeCliente">
                        <label for="cidadeCliente">Cidade
                            <input type="text" id="cidade"  name="cidadeCliente"
                                required="true" maxlength="50" readonly="true" style="visibility:hidden;">
                        </label>
                    </div>
                    <div class="ufCliente">
                        <label for="ufCliente">UF
                            <input type="text" id="uf"  name="ufCliente" required="true" maxlength="5"
                                class="menor" readonly="true" style="visibility:hidden;">
                        </label>
                    </div>
                    <div class="telefoneCliente">
                        <label for="telefoneCliente">Telefone
                            <input type="text" id="telefoneCliente" placeholder="(99) 99999-9999" name="telefoneCliente"
                                required="true" maxlength="20">
                        </label>
                    </div>
                    <div class="emailCliente">
                        <label for="emailCliente">E-mail
                            <input type="email" id="emailCliente" placeholder="email@email.com" name="emailCliente"
                                required="true" maxlength="100">
                        </label>
                    </div>

                    <div class="observacaoCliente">
                        <label for="observacaoCliente">Observação
                            <textarea type="text" id="observacaoCliente" placeholder="Observação sobre o cliente"
                                required="true" name="observacaoCliente" maxlength="250"></textarea>
                        </label>
                    </div>
                    <div>
                        <p style="font-size: 70%;">
                            * Os campos CPF e CNPJ devem ser preenchidos conforme a situação do cliente (pessoa física
                            ou pessoa jurídica)
                        </p>
                    </div>




                    <input type="submit" value="Salvar" class="btn-cadastrar" name="opcao">

                </form>
            </div>


        </div>


    </div>
    <script src="../model/js/webServiceCep.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="../model/js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="../model/js/mascaras.js" type="text/javascript"></script>
    <script src="../model/js/app.js" type="text/javascript"></script>

</body>

</html>