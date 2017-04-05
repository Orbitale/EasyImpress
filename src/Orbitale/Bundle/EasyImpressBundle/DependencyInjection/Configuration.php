<?php

/**
 * This file is part of the EasyImpress package.
 *
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Orbitale\Bundle\EasyImpressBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('easy_impress');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('presentations_dir')
                    ->defaultNull()
                ->end()
                ->scalarNode('layout')
                    ->defaultValue('@EasyImpress/layout.html.twig')
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
