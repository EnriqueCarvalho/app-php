<?php

    Class Conexao{
        private $pdo;

        public function conectar(){
            try{
                $this->pdo = new PDO("mysql:dbname=appprosoftrs;host=187.45.196.218","appprosoftrs","W8cyvh22#",
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                )
            );
                return $this->pdo;
            }catch (exception $e){
                echo "Erro na tentantiva de conexão com o Banco de Dados".$e->getMessage();
            }
        }
    }
?>