<?php

namespace AppBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class UserFixture extends AbstractResourceFixture
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode)
    {
        $resourceNode
            ->children()
            ->scalarNode('first_name')->cannotBeEmpty()->end()
            ->scalarNode('last_name')->cannotBeEmpty()->end()
            ->scalarNode('email')->cannotBeEmpty()->end()
            ->scalarNode('password')->cannotBeEmpty()->end()
            ->scalarNode('verified')->end()
            ->scalarNode('token')->end()
        ;
    }
}
