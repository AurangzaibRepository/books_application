<?php

namespace Book\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Book\Service\PostManager;

/**
 * This factory class is used to instantiate post manager
 */
class PostManagerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new PostManager($entityManager);
    }
}
