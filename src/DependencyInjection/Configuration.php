<?php

/*
 * This file is part of the gcp-secret-manager-bundle application.
 * (c) Anthony Papillaud <apapillaud@elixis.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ElixisGroup\GcpSecretManagerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('gcp_secret_manager');
        
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('secret_manager_client_config')
                    ->children()
                        ->scalarNode('project_id')->end()
                        ->scalarNode('keyfilepath')->end()
                    ->end()
                ->end()
                ->scalarNode('delimiter')->defaultValue(':')->end()
                ->scalarNode('ignore')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
