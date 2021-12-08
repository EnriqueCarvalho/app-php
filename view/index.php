<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../model/css/reset.css">
    <link rel="stylesheet" href="../model/css/geral.css">
    <link rel="stylesheet" href="../model/css/index.css">
    <title>Login</title>
</head>
<?php
      
		session_start();
			if (isset($_SESSION['nomeFunc'])){
				header("Location: menu.php");
			}else {
				
            }
            
	

		

       ?>

<body>
    <div class="container-login">

        <div class="login">
            <h1>Login</h1>
            <form action="../control/controleFuncionario.php" method="POST">
                <label for="login">Seu login
                    <input type="text" id="login" placeholder="Digite seu login" required="treu" name="login">
                </label>
                <label for="senha">Sua senha
                    <input type="password" id="senha" placeholder="Digite sua senha" required="true" name="senha">
                </label>
                <input type="submit" value="Entrar" class="btn-entrar" name="opcao">
            </form>
        </div>
    </div>
</body>

</html>