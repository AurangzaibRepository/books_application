<?php

namespace Book\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Book\Controller\IndexController;
use Book\Service\IndexManager;

/**
 * This is factory which is used to instantiate book index controller
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestName,
        array $options = null
    ) {
        $indexManager = $container->get(IndexManager::class);

        return new IndexController($indexManager);
    }
}
