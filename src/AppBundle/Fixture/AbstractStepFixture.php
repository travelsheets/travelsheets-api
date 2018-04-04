<?php

namespace AppBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

abstract class AbstractStepFixture extends AbstractResourceFixture
{
    /**
     * {@inheritdoc}
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode)
    {
        $resourceNode
            ->children()
            ->scalarNode('name')->end()
            ->scalarNode('summary')->end()
            ->scalarNode('date_start')->end()
            ->scalarNode('date_end')->end()
            ->scalarNode('price')->end()
            ->scalarNode('currency')->end()
            ->scalarNode('travel')->end()
        ;
    }
}