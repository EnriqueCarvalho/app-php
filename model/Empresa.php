<?php

    class Empresa{
        public static function pesquisaEmpresa($codEmpresa){
            $conexao = new Conexao();
            $p = $conexao->conectar();
            $query = array();  
            try{
                $query= $p->query("select nomeEmpresa,codEmpresa from empresa where codEmpresa='$codEmpresa'");
                return $query;
            }catch(exception $e){
                echo "Erro :"+$e;
            }
           
        }
    }
?>