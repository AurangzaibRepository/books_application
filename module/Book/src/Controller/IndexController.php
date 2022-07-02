<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * Index Manager
     * @var Book\Service\IndexManager
     */
    private $indexManager;

    public function __construct($indexManager)
    {
        $this->indexManager = $indexManager;
    }

    public function indexAction(): ViewModel
    {
        $bookList = $this->indexManager->getList();

        return new ViewModel([
            'bookList' => $bookList
        ]);
    }
}
