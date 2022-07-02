<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Book\Form\PostForm;

class PostController extends AbstractActionController
{

    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var Book\Service\PostManager
     */
    private $postManager;

    public function __construct(
        $entityManager,
        $postManager
    ) {
        $this->entityManager = $entityManager;
        $this->postManager = $postManager;
    }

    public function addAction(): ViewModel
    {
        $form = new PostForm($this->entityManager);

        // If post request
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $this->postManager->add($data);
                return $this->redirect()->toRoute('book');
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function deleteAction()
    {
        $bookId = $this->params()->fromRoute('id', 0);
        $book = $this->postManager->getBook($bookId);

        if ($book === null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $this->postManager->delete($book);
        return $this->redirect()->toRoute('book');
    }


    public function editAction()
    {
        $form = new PostForm($this->entityManager);

        $bookId = $this->params()->fromRoute('id', 0);
        $book = $this->postManager->getBook($bookId);

        $form->setData($this->postManager->transformData($book));

        // If post request
        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());

            if ($form->isValid()) {
                //$this->postManager->update($book, $form->getData());
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }
}
