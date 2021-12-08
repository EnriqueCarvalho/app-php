<?php
 
    
  
    include "conexaoBD.php";

    Class Funcionario{
        private  $login;
        private  $senha;
        
        public function getLogin(){
            return $this->login;
        }
        public function setLogin($log){
            $this->login = $log;
        }

        public function getSenha(){
            return $this->senha;
        }
        public function setSenha($sen){
            $this->senha =$sen;
        }

        

        
        public  function login(){
            $conexao = new Conexao();
            $p = $conexao->conectar();
            $query = array();  
            try{
                $query = $p->query("select loginFunc,senhaFunc,codEmpresa,nomeFunc,codFunc from funcionario") ;
               
            }catch (exception $e){
                echo "Erro na tentativa de query: "+$e;
            }

            $res = $query->fetchALL(PDO::FETCH_ASSOC);

            for($i=0;$i<count($res);$i++){
                $retLog = $res[$i]['loginFunc'];
                $retSen = $res[$i]['senhaFunc'];
            
                
               
            
                if ($this->login==$retLog){
                    if($this->senha==$retSen){
                        $retNome = $res[$i]['nomeFunc'];
                        $retCodEmpresa=$res[$i]['codEmpresa'];    
                        $retCodFunc = $res[$i] ['codFunc'];                  
    
    
                        $queryEmpresa = Empresa::pesquisaEmpresa($retCodEmpresa);   //Codigo para achar a empresa em que o func trabalha
                        $retCodigoEmpresa = $queryEmpresa->fetchAll(PDO::FETCH_ASSOC);
    
                        session_start();
                        $_SESSION['nomeFunc']=$retNome; 
                        $_SESSION['codFunc']=$retCodFunc;

                        $_SESSION['nomeEmpresa']= $retCodigoEmpresa[0]['nomeEmpresa'];
                        $_SESSION['codEmpresa']= $retCodigoEmpresa[0]['codEmpresa'];
                        
                        return 1;
                        
                        
                    }else{
                        return 2;
                        
                    }
                }
                
            }
                return 3;
            
                
              
                   
               
    
    
        }
    }

   
?>