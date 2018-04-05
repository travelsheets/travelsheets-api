<?php

namespace AppBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class AccomodationStepFixture extends AbstractResourceFixture
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'accomodation_step';
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
        ;
    }
}
