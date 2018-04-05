<?php

namespace AppBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class TransportationStepFixture extends AbstractResourceFixture
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'transportation_step';
    }

    /**
     * @inheritDoc
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode)
    {
        parent::configureResourceNode($resourceNode);

        $resourceNode
            ->children()
            ->scalarNode('company')->end()
            ->scalarNode('booking_number')->end()
            ->scalarNode('flight_number')->end()
            ->scalarNode('opening_luggage')->end()
            ->scalarNode('closing_luggage')->end()
            ->scalarNode('seat')->end()
        ;
    }
}
