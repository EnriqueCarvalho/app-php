<?php

include "conexaoBD.php";

class Produto
{
    private $nome;
    private $valor;
    private $qtde;
    private $desconto;
    private $descricao;

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
    }
    public function getQtde()
    {
        return $this->qtde;
    }
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;
    }
    public function getDesconto()
    {
        return $this->desconto;
    }
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    public function cadastrarProduto()
    {
        $nome = $this->getNome();
        $descricao = $this->getDescricao();
        $qtde = $this->getQtde();
        $valor = $this->getValor();
        $valorFloat = str_replace([','], '.', $valor);
        $desconto = $this->getDesconto();

        $conexao = new Conexao();
        $p = $conexao->conectar();
        session_start();

        $codEmpresa = $_SESSION['codEmpresa'];
        try {
            $p->query("insert into  produto (codEmpresa,nomeProduto,descricaoProduto,qtdeEstoque,valorProduto,descontoMaximoValor)
                values ('$codEmpresa','$nome','$descricao','$qtde','$valorFloat','$desconto');");
            return 1;
        } catch (exception $e) {
            echo "Erro na tentativa de query: " + $e;
            return 0;
        }
    }

    public static function visualizarProduto($codEmpresa)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();
        try {
            $retorno = array();
            $retorno = $p->query("select codProduto,nomeProduto,descricaoProduto,qtdeEstoque,valorProduto,descontoMaximoValor from produto where codEmpresa=$codEmpresa;");
            return $retorno;
        } catch (exception $e) {
            echo "Erro na query" + $e->getMessage();
        }
    }
}
