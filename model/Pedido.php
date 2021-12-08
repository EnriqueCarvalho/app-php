<?php
include "../model/conexaoBD.php";
class Pedido
{


    public static function novoPedido($codigoCliente, $codEmpresa, $codFunc, $nomeFunc, $nomeCliente)
    {

        $conexao = new Conexao();
        $p = $conexao->conectar();
        try {
            $p->query("insert into pedido (codCliente,codEmpresa,horaInicioPedido,codFuncionario,nomeFuncionario,nomeCliente) values ('$codigoCliente','$codEmpresa',Now(),'$codFunc','$nomeFunc','$nomeCliente');");
            $lastId = $p->lastInsertId();
            return $lastId;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function  detalhesProdutos($codPedido)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select nomeProduto,descricaoProduto,codProduto FROM produto WHERE codProduto= $codPedido;");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }
    public static function verItensDoPedido($codigoPedido)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select subTotal,qtdeItem,desconto,codProduto FROM item WHERE item.codPedido= $codigoPedido");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function verProdutosNaoSelecionados($codigoPedido, $codEmpresa)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select codProduto,nomeProduto,descricaoProduto,qtdeEstoque,valorProduto,descontoMaximoValor
                 FROM produto WHERE codEmpresa=$codEmpresa and codProduto NOT IN
                 (SELECT produto.codProduto FROM produto, item WHERE item.codPedido= $codigoPedido 
                 AND item.codProduto= produto.codProduto)");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function selecionarProduto($codProduto)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select codProduto,nomeProduto,descricaoProduto,qtdeEstoque,valorProduto,descontoMaximoValor
                FROM produto where codProduto=$codProduto");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function addNovoItem($codProduto, $subTotal, $qtdeItem, $desconto)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();
        session_start();
        $codPedido = $_SESSION['codPedido'];

        try {
            $ret = array();
            $ret = $p->query("insert into item (codPedido,codProduto,subTotal,qtdeItem,desconto)
                
                values ('$codPedido','$codProduto','$subTotal','$qtdeItem','$desconto'); ");
            $ret = $p->query("
                UPDATE produto 
                SET qtdeEstoque =qtdeEstoque- $qtdeItem
                WHERE codProduto=$codProduto;
                ");
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function removerItemPedido($codProduto, $codPedido, $qtdeItem)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();


        try {
            $ret = array();
            $ret = $p->query("delete from item where codProduto=$codProduto and codPedido = $codPedido; ");
            $ret = $p->query("
                    UPDATE produto 
                    SET qtdeEstoque =qtdeEstoque+ $qtdeItem
                    WHERE codProduto=$codProduto;
                ");
        } catch (Exception $e) {
            echo $e;
        }
    }
    public static function removerPedido($codPedido)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();


        try {
            $ret = array();
            $ret = $p->query("select codProduto, qtdeItem from item where codPedido = $codPedido");
            $item = $ret->fetchALL(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($item); $i++) {
                $qtde = $item[$i]['qtdeItem'];
                $codProd = $item[$i]['codProduto'];

                $p->query("
                        UPDATE produto 
                        SET qtdeEstoque =qtdeEstoque+ $qtde
                        WHERE codProduto=$codProd;
                    ");
            }


            $p->query("delete from pedido where codPedido=$codPedido; ");
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function finalizarPedido($valorTotal, $formaPagamento, $valorParcelas, $dataEntrega, $obsPedido, $codPedido, $dataVencimento)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $p->query("
               UPDATE pedido
               SET valorTotal=$valorTotal, formaPagamento='$formaPagamento',valorParcela=$valorParcelas,dataEntrega='$dataEntrega',
               obsPedido='$obsPedido',horaFimPedido=Now(),dataVencimento='$dataVencimento'
               WHERE codPedido=$codPedido; ");



            $query = $p->query("select codCliente, codEmpresa, horaFimPedido,nomeFuncionario from pedido where codPedido=$codPedido");
            $res = $query->fetchALL(PDO::FETCH_ASSOC);
            $codCli = $res[0]['codCliente'];
            $codEmp = $res[0]['codEmpresa'];
            $dataPed = $res[0]['horaFimPedido'];
            $nomeFuncionario = $res[0]['nomeFuncionario'];
            $dataPed = date('Y/m/d',  strtotime($dataPed));


            $p->query("insert into pagamento (codEmpresa,codCli,codVendaApp,dataCompra,valorTotal,dataVenc,nomeFuncionario) values 
                ('$codEmp','$codCli','$codPedido','$dataPed','$valorTotal','$dataVencimento','$nomeFuncionario')
                ;");


            return 1;
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }

    public static function visualizarPedidos($codEmpresa)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select dataEntrega,valorTotal,codPedido,nomeCliente from pedido where codEmpresa=$codEmpresa and entregue=0 and cancelado =0 order by dataEntrega ");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function detalhesPedidos($codPedido)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select c.ruaCliente,c.numEnd,c.bairroCliente,c.cidadeCliente,c.ufCliente,c.telefoneCliente,c.cepCliente,
            p.codPedido,p.nomeCliente,p.codCliente,p.valorTotal,p.formaPagamento,p.motivoCancel,
            p.valorParcela,p.dataEntrega,p.dataVencimento,p.obsPedido,p.horaFimPedido,p.nomeFuncionario,p.pago from pedido p
            join cliente c
            on c.codCliente = p.codCliente
            where codPedido=$codPedido ");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }
    public static function detalhesPedidosProdutos($codPedido)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select i.qtdeItem,i.desconto,i.subTotal,p.nomeProduto from item i            
            join produto p
            on i.codProduto = p.codProduto
            where i.codPedido=$codPedido");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function alterarDataPedido($codPedido, $dataEntrega)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $p->query("
            UPDATE pedido
            SET dataEntrega='$dataEntrega' WHERE codPedido=$codPedido; ");
        } catch (Exception $e) {
            echo $e;
        }
    } 
    public static function pedidoEntregue($codPedido)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $p->query("
            UPDATE pedido
            SET entregue=1,foiEntregue=Now() WHERE codPedido=$codPedido; ");
        } catch (Exception $e) {
            echo $e;
        }
    } 
    public static function cancelarPedido($codPedido,$motivoCancel)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select codProduto, qtdeItem from item where codPedido = $codPedido");
            $item = $ret->fetchALL(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($item); $i++) {
                $qtde = $item[$i]['qtdeItem'];
                $codProd = $item[$i]['codProduto'];

                $p->query("
                        UPDATE produto 
                        SET qtdeEstoque =qtdeEstoque+ $qtde
                        WHERE codProduto=$codProd;
                    ");
            }

            $p->query("
            UPDATE pedido
            SET motivoCancel='$motivoCancel',cancelado=1,dataFinalizacao=Now() WHERE codPedido=$codPedido; ");
        } catch (Exception $e) {
            echo $e;
        }
    }

    
    public static function visualizarPedidosCliente($codCliente)
    {
        $conexao = new Conexao();
        $p = $conexao->conectar();

        try {
            $ret = array();
            $ret = $p->query("select dataEntrega,valorTotal,codPedido,nomeCliente,entregue,cancelado,dataFinalizacao   from pedido where codCliente=$codCliente    order by entregue ASC,cancelado ASC,dataEntrega");
            return $ret;
        } catch (Exception $e) {
            echo $e;
        }
    }

    
   
}
