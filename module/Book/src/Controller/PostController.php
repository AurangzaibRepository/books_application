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

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $this->save($form, $data);
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

        return new ViewModel([
            'form' => $form
        ]);
    }


    public function save(PostForm $form, array $data): void
    {
        $data = $form->getData();
        $this->postManager->add($data);
    }
}
