<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Application\Model\Entity\Pedido;
use Application\Model\Entity\Produto;

class PedidoModel extends AbstractModel 
{
    
    protected $table = 'pedido';
    protected $schema = 'tecnofit';
    
    public function __construct(Adapter $adapter) 
    {
        $this->adapter = $adapter;
    }

    public function carrega($id = null) 
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select(new TableIdentifier($this->table, $this->getSchema()));
        if(!empty($id)) {
            $select->where('id = '. $id);
        }
        $select->order('total DESC');
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $className = '\\Application\\Model\\Entity\\Pedido';
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new $className($row);
            $entity->setProdutos($this->produtosPorPedido($entity->getId()));
            if(!empty($id)) {
                $entities = $entity;
            } else {
                $entities[] = $entity;
            }
        }
        return $entities;
    }

    public function cadastra(Pedido $ped)
    {
        $sql = new Sql($this->adapter);
        $insert = $sql->insert(new TableIdentifier($this->table, $this->getSchema()));
        $newData = array(
            'total'      => $ped->getTotal()
        );
        $insert->values($newData);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $resultSet = $statement->execute();
        $idNovoPed =  $resultSet->getGeneratedValue();
        if(!empty($idNovoPed)) {
            $arrProd = $ped->getProdutos();
            if(is_array($arrProd) && count($arrProd) > 0) {
                foreach($arrProd as $prod) {
                    $sql = <<<EOT
                        INSERT INTO detalhes_pedido
                        (
                            id_pedido,
                            id_produto
                        ) VALUES (
                            {$idNovoPed},
                            {$prod->getId()}
                        )
EOT;
        $statement = $this->adapter->query($sql);
        $resultSet =  $statement->execute();
                }
            }
        }
        return $idNovoPed;
    }

    public function calculaTotal($arrId)
    {
        $inId = implode(',', $arrId);
        $sql = <<<EOT
            SELECT
                SUM(preco) AS total
            FROM
                produto
            WHERE id IN ({$inId})
EOT;
        $statement = $this->adapter->query($sql);
        $resultSet =  $statement->execute();
        foreach ($resultSet as $row) {
            $total = $row['total'];
        }
        return $total;
    }

    public function produtosPorPedido($idPed)
    {
        $arrProdutos = array();
        $sql = <<<EOT
            SELECT
                p.id,
                p.nome,
                p.descricao,
                p.preco,
                p.sku
            FROM
                detalhes_pedido dp
            JOIN produto p ON dp.id_produto = p.id
            WHERE dp.id_pedido = {$idPed}
EOT;
        $statement = $this->adapter->query($sql);
        $resultSet =  $statement->execute();
        foreach ($resultSet as $row) {
            $prod = new Produto();
            $prod->setId($row['id']);
            $prod->setNome($row['nome']);
            $prod->setDescricao($row['descricao']);
            $prod->setPreco($row['preco']);
            $prod->setSku($row['sku']);
            $arrProdutos[] = $prod;
        }
        return $arrProdutos;
    }
}