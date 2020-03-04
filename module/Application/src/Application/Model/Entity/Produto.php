<?php

namespace Application\Model\Entity;

use Application\Model\Entity\AbstractEntity;

class Produto extends AbstractEntity
{
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $sku;

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
    function getNome() : string 
    {
        return $this->nome;
    }

    /**
     * @return string 
     */
    function getDescricao() : string 
    {
        return $this->descricao;
    }

    /**
     * @return float 
     */
    function getPreco() : float 
    {
        return $this->preco;
    }

    /**
     * @return string 
     */
    function getSku() : string 
    {
        return $this->sku;
    }

    /**
     * @param integer $id
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $nome
     */
    function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param string $descricao
     */
    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @param float $preco
     */
    function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @param string $sku
     */
    function setSku($sku)
    {
        $this->sku = $sku;
    }
}