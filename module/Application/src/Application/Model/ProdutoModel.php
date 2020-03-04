<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Application\Model\Entity\Produto;

class ProdutoModel extends AbstractModel 
{
    
    protected $table = 'produto';
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
        $select->order('nome');
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $className = '\\Application\\Model\\Entity\\Produto';
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new $className($row);
            if(!empty($id)) {
                $entities = $entity;
            } else {
                $entities[] = $entity;
            }
        }
        return $entities;
    }

    public function cadastra(Produto $prod)
    {
        $sql = new Sql($this->adapter);
        $insert = $sql->insert(new TableIdentifier($this->table, $this->getSchema()));
        $newData = array(
            'nome'      => $prod->getNome(),
            'sku'      => $prod->getSku(),
            'descricao' => $prod->getDescricao(),
            'preco'    => $prod->getPreco()
        );
        $insert->values($newData);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $resultSet = $statement->execute();
        return $resultSet->getGeneratedValue();
    }

    public function altera(Produto $prod)
    {
        $data = array(
            'nome'      => $prod->getNome(),
            'sku'      => $prod->getSku(),
            'descricao' => $prod->getDescricao(),
            'preco'    => $prod->getPreco()
        );
        $sql = new Sql($this->adapter);
        $update = $sql->update(new TableIdentifier($this->table, $this->getSchema()));
        $update->set($data);
        $update->where('id = '. $prod->getId());
        $statement = $sql->prepareStatementForSqlObject($update);
        $statement->execute();
    }
    
    public function excluir($id)
    {
        $sql = new Sql($this->adapter);
        $update = $sql->delete(new TableIdentifier($this->table, $this->getSchema()));
        $update->where('id = '. $id);
        $statement = $sql->prepareStatementForSqlObject($update);
        $statement->execute();
    }

    public function pedidosPorProduto($idProd)
    {
        $arrPedidos = array();
        $sql = <<<EOT
            SELECT
                dp.id_pedido
            FROM
                detalhes_pedido dp
            WHERE dp.id_produto = {$idProd}
EOT;
        $statement = $this->adapter->query($sql);
        $resultSet =  $statement->execute();
        foreach ($resultSet as $row) {
            $arrPedidos[] = $row['id_pedido'];
        }
        return $arrPedidos;
    }
}