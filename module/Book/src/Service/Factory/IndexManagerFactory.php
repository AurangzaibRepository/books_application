<?php

namespace Book\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Book\Service\IndexManager;

/**
 * This is the factory for IndexManager which is used to instantiate the service.
 */
class IndexManagerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new IndexManager($entityManager);
    }
}
