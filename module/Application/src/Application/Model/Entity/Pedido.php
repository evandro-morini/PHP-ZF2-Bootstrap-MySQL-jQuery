<?php

namespace Application\Model\Entity;

use Application\Model\Entity\AbstractEntity;

class Pedido extends AbstractEntity
{
    private $id;
    private $dt_pedido;
    private $total;
    private $produtos;

    /**
     * @return integer 
     */
    function getId() : int 
    {
        return $this->id;
    }

    /**
     * @return string 
     */
    function getDtPedido() : string 
    {
        return $this->dt_pedido;
    }

    /**
     * @return float 
     */
    function getTotal() : float 
    {
        return $this->total;
    }

    /**
     * @return array 
     */
    function getProdutos() : array 
    {
        return $this->produtos;
    }

    /**
     * @param integer $id
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $dt_pedido
     */
    function setDtPedido($dt_pedido)
    {
        $this->dt_pedido = $dt_pedido;
    }
    
    /**
     * @param float $total
     */
    function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @param array $produtos
     */
    function setProdutos($produtos)
    {
        $this->produtos = $produtos;
    }
}