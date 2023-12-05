<?php

/*
 * This file is part of the gcp-secret-manager-bundle application.
 * (c) Anthony Papillaud <apapillaud@elixis.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ElixisGroup\GcpSecretManagerBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GcpSecretManagerBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
    }
}
