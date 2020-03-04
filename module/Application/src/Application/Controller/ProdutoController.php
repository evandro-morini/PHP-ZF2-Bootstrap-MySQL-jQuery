<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\ProdutoModel;
use Application\Model\Entity\Produto;
use Zend\Debug\Debug;

class ProdutoController extends AbstractActionController
{

    public function getDbAdapter()
    {
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }

    public function indexAction()
    {
        $pm = new ProdutoModel($this->getDbAdapter());
        $produtos = $pm->carrega();
        return new ViewModel(array(
            'produtos' => $produtos
        ));
    }

    public function cadastrarAction()
    {
        $pm = new ProdutoModel($this->getDbAdapter());
        $idAtual = (int)$this->params()->fromRoute('id');
        $dataView = array();
        if(!empty($idAtual)) {
            $prodAtual = $pm->carrega($idAtual);
            $dataView = array('prod' => $prodAtual);
        }

        $request = $this->getRequest();
        if($request->isPost()) {
            $data = $request->getPost();
            $prod = new Produto();
            $prod->setNome($data['nome']);
            $prod->setSku($data['sku']);
            $prod->setPreco($data['preco']);
            if(!empty(trim($data['descricao']))) {
                $prod->setDescricao($data['descricao']);
            } 
            if(!empty($idAtual)) {
                $prod->setId($data['id']);
                $pm->altera($prod);
                $this->flashMessenger()->addSuccessMessage('Produto alterado com sucesso!');
            } else {
                $idNovo = $pm->cadastra($prod);
                $this->flashMessenger()->addSuccessMessage('Produto cadastrado com sucesso!');
            }
            return $this->redirect()->toRoute('produto');
        }
        return new ViewModel($dataView);
    }
    
    public function excluirAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if(!empty($id)) {
            $pm = new ProdutoModel($this->getDbAdapter());
            $arrPed = $pm->pedidosPorProduto($id);
            if(count($arrPed)) {
                $this->flashMessenger()->addErrorMessage('Erro ao excluir! Produto pendente em um ou mais pedidos.');
            } else {
                $pm->excluir($id);
                $this->flashMessenger()->addSuccessMessage('Produto excluído com sucesso!');
            }
            return $this->redirect()->toRoute('produto');
        }

    }
}
