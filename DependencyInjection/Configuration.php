<?php

namespace FS\ExposeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fs_expose');
        $rootNode->children()
            ->arrayNode('request_suspension')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('impact')->defaultValue(7)->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
