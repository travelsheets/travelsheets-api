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
            ->scalarNode('first_name')->end()
            ->scalarNode('last_name')->end()
            ->scalarNode('email')->end()
            ->scalarNode('password')->end()
            ->scalarNode('verified')->end()
            ->scalarNode('token')->end()
        ;
    }
}
