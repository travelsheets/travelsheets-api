<?php

namespace AppBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * @author Loïc Frémont <loic@mobizel.com>
 */
class TravelFixture extends AbstractResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'travel';
    }

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
            ->scalarNode('user')->end()
        ;
    }
}
