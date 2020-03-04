<?php

namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Authentication\AuthenticationService;
use Zend\Db\TableGateway\AbstractTableGateway;

abstract class AbstractModel extends AbstractTableGateway
{
    public function getClassName()
    {
        $class = explode('\\', get_class($this));
        return end($class);
    }
    
    public function getSchema()
    {
        return isset($this->schema) ? $this->schema : null;
    }
}