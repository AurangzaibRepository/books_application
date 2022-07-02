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
        $form = new PostForm();

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

    public function save(PostForm $form, array $data): void
    {
        $data = $form->getData();
        $this->postManager->add($data);
    }
}
