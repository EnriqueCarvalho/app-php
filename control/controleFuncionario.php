<?php

    include "../model/Funcionario.php";
    include "../model/Empresa.php";

           
    if(isset($_POST['opcao'])){
        $opcao = $_POST['opcao'];
    if ($opcao=='Entrar'){
       
        $login  = $_POST['login'];
        $senha = $_POST['senha'];

        $func = new Funcionario();

        $func->setLogin($login);
        $func->setSenha($senha);
        $retorno  = $func->login();
      
        if($retorno==1){
            echo "<script>window.location = '../view/menu.php';</script>";
        }else if ($retorno==2){
            echo "<script>alert('Senha Incorreta!');</script>";
                    echo "<script>window.location = '../view/index.php';</script>";
        }else if ($retorno==3){
            echo "<script>alert('Login não encontrado!');</script>";
            echo "<script>window.location = '../view/index.php';</script>";
        }

    }
}
    else  if (isset($_GET["opcao"])){ 
		$opcao = $_GET['opcao'];
		
		if($opcao=='Sair'){
			session_start();
			session_destroy();
			header("Location: ../view/index.php");
			
		}
	}
        
    
?>