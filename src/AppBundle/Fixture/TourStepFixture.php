<?php

namespace AppBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class TourStepFixture extends AbstractResourceFixture
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'tour_step';
    }

    /**
     * @inheritDoc
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode)
    {
        parent::configureResourceNode($resourceNode);

        $resourceNode
            ->children()
//            ->scalarNode('place')->end()
            ->scalarNode('booking_number')->end()
            ->scalarNode('type')->end()
        ;
    }
}