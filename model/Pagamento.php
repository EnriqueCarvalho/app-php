<?php
include "../model/conexaoBD.php";
     class Pagamento{

        public static function  dividasCliente($codEmpresa,$codCliente){
            $conexao = new Conexao();
            $p = $conexao->conectar();
            
            try{
                $ret = array();
            $ret= $p->query("select codVendaApp,nomeFuncionario,codPag,valorTotal,valorPago,dataCompra,dataVenc FROM pagamento 
            WHERE codEmpresa= $codEmpresa and codCli=$codCliente AND status=0 order by nomeFuncionario;" );
            return $ret;
            }catch(Exception $e){
                echo $e;
            }
        }

        public static function verDivida($codPagamento){
            $conexao = new Conexao();
            $p = $conexao->conectar();
            
            try{
                $ret = array();
            $ret= $p->query("select * FROM pagamento WHERE codPag= $codPagamento ;" );
            return $ret;
            }catch(Exception $e){
                echo $e;
            }
        }
        public static function atualizarDivida($codPagamento,$novoValor){
            $conexao = new Conexao();
            $p = $conexao->conectar();
            
            try{
                $ret = array();
                $p->query("
                UPDATE pagamento
                SET valorPago=$novoValor,dataUltPag=Now()
                WHERE codPag=$codPagamento; ");
            return $ret;
            }catch(Exception $e){
                echo $e;
            }
        } 
        public static function quitarDividaPagamento($codPagamento,$novoValor,$status){
            $conexao = new Conexao();
            $p = $conexao->conectar();
            
            try{
                $ret = array();
                $p->query("
                UPDATE pagamento
                SET valorPago=$novoValor,dataUltPag=Now(),dataQuit=Now(),status=$status
                WHERE codPag=$codPagamento; ");
            return $ret;
            }catch(Exception $e){
                echo $e;
            }
        }

    }
