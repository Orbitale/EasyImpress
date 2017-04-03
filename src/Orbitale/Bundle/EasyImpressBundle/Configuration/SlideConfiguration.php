<?php

/**
 * This file is part of the EasyImpress package.
 *
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Orbitale\Bundle\EasyImpressBundle\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Validates one single Slide.
 */
class SlideConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('slides');

        $rootNode
            ->children()
                ->scalarNode('id')->isRequired()->end()

                ->scalarNode('content_type')->defaultValue('markdown')->end()
                ->scalarNode('content')->defaultValue(null)->end()

                ->variableNode('extra')->defaultValue(null)->end()

                ->arrayNode('data')
                    ->addDefaultsIfNotSet()
                    ->normalizeKeys(false)
                    ->children()
                        ->integerNode('x')->defaultValue(null)->end()
                        ->integerNode('y')->defaultValue(null)->end()
                        ->integerNode('z')->defaultValue(null)->end()
                        ->integerNode('rotate')->defaultValue(null)->end()
                        ->integerNode('rotate-x')->defaultValue(null)->end()
                        ->integerNode('rotate-y')->defaultValue(null)->end()
                        ->integerNode('rotate-z')->defaultValue(null)->end()
                    ->end()
                ->end()

                ->arrayNode('attr')
                    ->addDefaultsIfNotSet()
                    ->normalizeKeys(false)
                    ->children()
                        ->scalarNode('style')->defaultValue('')->end()
                        ->scalarNode('class')
                            ->defaultValue('step')
                            ->validate()
                            ->always(function($v){
                                if (false === strpos($v, 'step')) {
                                    $v = trim('step '.$v);
                                }

                                return $v;
                            })
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('reset')
                    ->addDefaultsIfNotSet()
                    ->normalizeKeys(false)
                    ->children()
                        ->booleanNode('x')->defaultValue(false)->end()
                        ->booleanNode('y')->defaultValue(false)->end()
                        ->booleanNode('z')->defaultValue(false)->end()
                        ->booleanNode('rotate')->defaultValue(false)->end()
                        ->booleanNode('rotate-x')->defaultValue(false)->end()
                        ->booleanNode('rotate-y')->defaultValue(false)->end()
                        ->booleanNode('rotate-z')->defaultValue(false)->end()
                    ->end()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }
}
