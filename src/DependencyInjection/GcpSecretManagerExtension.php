<?php

namespace ElixisGroup\GcpSecretManagerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use Symfony\Component\Config\FileLocator;

class GcpSecretManagerExtension extends Extension{

    public function load(array $configs, ContainerBuilder $container)
    {
                
        $configs = $this->processConfiguration(new Configuration(), $configs);
        $container->setParameter('gcp.secret_manager.project_id', $configs['secret_manager_client_config']['project_id']);
        $container->setParameter('gcp.secret_manager.keyfilepath', $configs['secret_manager_client_config']['keyfilepath']);
        $container->setParameter('gcp.secret_manager.ignore', $configs['ignore']);
        $container->setParameter('gcp.secret_manager.delimiter', $configs['delimiter']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

    }

    public function prepend(ContainerBuilder $container)
    {}
    
    public function getAlias()
    {
        return parent::getAlias();
    }

}