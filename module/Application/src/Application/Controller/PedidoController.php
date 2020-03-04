<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\PedidoModel;
use Application\Model\ProdutoModel;
use Application\Model\Entity\Pedido;
use Application\Model\Entity\Produto;
use Zend\Debug\Debug;

class PedidoController extends AbstractActionController
{

    public function getDbAdapter()
    {
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }

    public function indexAction()
    {
        $pm = new PedidoModel($this->getDbAdapter());
        $pedidos = $pm->carrega();
        return new ViewModel(array(
            'pedidos' => $pedidos
        ));
    }

    public function cadastrarAction()
    {
        $pedM = new PedidoModel($this->getDbAdapter());
        $prodM = new ProdutoModel($this->getDbAdapter());
        $request = $this->getRequest();
        if($request->isPost()) {
            $data = $request->getPost();
            $arrProd = array();
            $ped = new Pedido();
            $ped->setTotal($data['total']);
            if(!empty($data['prods_id'])) {
                $arrProdId = json_decode($data['prods_id'], true);
                if(is_array($arrProdId) && count($arrProdId) > 0) {
                    foreach($arrProdId as $prodId) {
                        $prod = $prodM->carrega($prodId);
                        $arrProd[] = $prod;
                    }
                    $ped->setProdutos($arrProd);
                }
            }
            $idNovo = $pedM->cadastra($ped);
            $this->flashMessenger()->addSuccessMessage('Pedido gerado com sucesso!');
            return $this->redirect()->toRoute('pedido');
        }
        $prods = $prodM->carrega();
        return new ViewModel(array(
            'prods' => $prods
        ));
    }

    public function totalAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost();
            $pedM = new PedidoModel($this->getDbAdapter());
            $total = $pedM->calculaTotal($request['prods_id']);
        }
        $viewModel->setVariable('total', $total);
        return $viewModel;
    }
}
