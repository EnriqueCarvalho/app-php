<?php
include "conexaoBD.php";

    class Cliente{
        private $codCliente;
        private $codEmpresa;
        private $nomeFantasia;
        private $razaoSocial;
        private $cnpjCliente;
        private $cpfCliente;
        private $cepCliente;
        private $ruaCliente;
        private $bairroCliente;
        private $numEnd;
        private $cidadeCliente;
        private $ufCliente;
        private $telefoneCliente;
        private $emailCliente;
        private $observacaoCliente;

        public function getCodCliente(){
            return $this->codCliente;
        }
        public function setCodCliente($cod){
            $this->codCliente=$cod;
        }  
          public function getCodEmpresa(){
            return $this->codEmpresa;
        }
        public function setCodEmpresa($cod){
            $this->codEmpresa=$cod;
        }

        public function getNomeFantasia(){
            return $this->nomeFantasia;
        }
        public function setNomeFantasia($nome){
            $this->nomeFantasia = $nome;
        }
        
        public function getRazaoSocial(){
            return $this->razaoSocial;
        }
        public function setRazaoSocial($razao){
            $this->razaoSocial = $razao;
        }

        public function getCnpjCliente(){
            return $this->cnpjCliente;
        }
        public function setCnpjCliente($cnpj){
            $this->cnpjCliente = $cnpj;
        }

      

        public function getCepCliente(){
            return $this->cepCliente;
        }
        public function setCepCliente($cep){
            $this->cepCliente = $cep;
        }

        public function getRuaCliente(){
            return $this->ruaCliente;
        }
        public function setRuaCliente($rua){
            $this->ruaCliente = $rua;
        }
        public function getBairroCliente(){
            return $this->bairroCliente;
        }
        public function setBairroCliente($bairro){
            $this->bairroCliente = $bairro;
        }

        public function getNumEnd(){
            return $this->numEnd;
        }
        public function setNumEnd($num){
            $this->numEnd = $num;
        }
        public function getCidadeCliente(){
            return $this->cidadeCliente;
        }
        public function setCidadeCliente($cidade){
            $this->cidadeCliente=$cidade;
        }
        public function getUfCliente(){
            return $this->ufCliente;
        }
        public function setUfCliente($uf){
            $this->ufCliente=$uf;
        }
        public function getTelefoneCliente(){
            return $this->telefoneCliente;
        }
        public function setTelefoneCliente($tel){
            $this->telefoneCliente=$tel;
        }
        public function getEmailCliente(){
            return $this->emailCliente;
        }
        public function setEmailCliente($email){
            $this->emailCliente=$email;
        }
        public function getObservacaoCliente(){
            return $this->observacaoCliente;
        }
        public function setObservacaoCliente($obs){
            $this->observacaoCliente=$obs;
        }



        public function cadastrarCliente(){
            $cod=$this->getCodEmpresa();
            $nomFant = $this->getNomeFantasia();
            $razSocial = $this->getRazaoSocial();
            $cnpj= $this->getCnpjCliente();         
            $cep= $this->getCepCliente();
            $rua=$this->getRuaCliente();
            $bairro=$this->getBairroCliente();
            $num=$this->getNumEnd();
            $cidade=$this->getCidadeCliente();
            $uf=$this->getUfCliente();
            $fone=$this->getTelefoneCliente();
            $email=$this->getEmailCliente();
            $obs=$this->getObservacaoCliente();

            $conexao = new Conexao();
            $p = $conexao->conectar();
            
            
            try{          
                $p->query("insert into cliente (codEmpresa,nomeFantasia,razaoSocial,cnpjCliente,cepCliente,
                ruaCliente,numEnd,bairroCliente,cidadeCliente,ufCliente,telefoneCliente,emailCliente,observacaoCliente) 
                values('$cod','$nomFant','$razSocial','$cnpj','$cep','$rua','$num','$bairro','$cidade','$uf',
                '$fone','$email','$obs');");  
                return 1;
            }
            catch(mysqli_sql_exception $e){
                return $e->getMessage();
            }
        }


        public function alterarDadosCliente(){
            $codCliente=$this->getCodCliente();
            $nomFant = $this->getNomeFantasia();
            $razSocial = $this->getRazaoSocial();
            $cnpj= $this->getCnpjCliente();         
            $cep= $this->getCepCliente();
            $rua=$this->getRuaCliente();
            $bairro=$this->getBairroCliente();
            $num=$this->getNumEnd();
            $cidade=$this->getCidadeCliente();
            $uf=$this->getUfCliente();
            $fone=$this->getTelefoneCliente();
            $email=$this->getEmailCliente();
            $obs=$this->getObservacaoCliente();

            $conexao = new Conexao();
            $p = $conexao->conectar();
            
            
            try{          
                $p->query("
                
                UPDATE cliente SET
                razaoSocial = '$razSocial',nomeFantasia='$nomFant',cnpjCliente='$cnpj',cepCliente='$cep',ruaCliente='$rua',numEnd='$num',
                bairroCliente='$bairro',cidadeCliente='$cidade',ufCliente='$uf',telefoneCliente='$fone',
                emailCliente='$email',observacaoCliente='$obs'
                WHERE codCliente=$codCliente;

                
                ");  
                return $codCliente;
            }
            catch(mysqli_sql_exception $e){
                echo  $e->getMessage();
            }
        }

        public static function numRegistros($codEmpresa){
            $conexao = new Conexao();
            $p = $conexao->conectar();

            try{
                $retorno = array();
                $retorno = $p->query("select count(codCliente) as numRegistros from cliente where codEmpresa =$codEmpresa;");
                
                return $retorno;

            }catch(exception $e){
                echo "Erro na query" +$e->getMessage();
            }
        }
        public static function sumCliente($codEmpresa,$inicio,$fim){
            
            $conexao = new Conexao();
            $p = $conexao->conectar();

            try{
                $retorno = array();
                $retorno = $p->query("select codCliente,nomeFantasia,razaoSocial,cnpjCliente,telefoneCliente from cliente where codEmpresa=$codEmpresa order by nomeFantasia limit $inicio,$fim ;");
                return $retorno;

            }catch(exception $e){
                echo "Erro na query" +$e->getMessage();
            }
        }


        public static function pesquisarCliente($codEmpresa,$valorPesquisa){
            $conexao = new Conexao();
            $p = $conexao->conectar();

            try{
                $retorno = array();
                $retorno = $p->query("select codCliente,nomeFantasia,razaoSocial,cnpjCliente,telefoneCliente from cliente
                 where codEmpresa=$codEmpresa 
                 and nomeFantasia like '%$valorPesquisa%' order by nomeFantasia;");
                return $retorno;

            }catch(exception $e){
                echo "Erro na query" + $e->getMessage();
            }
        }

        public static function informacoesCliente($codCliente){
            $conexao = new Conexao();
            $p = $conexao->conectar();

            try{
                $retorno = array();
                $retorno = $p->query("select * from cliente where codCliente = $codCliente");
                return $retorno;

            }catch(exception $e){
                echo "Erro na query" + $e->getMessage();
            }
        }
        
        

    }

?>