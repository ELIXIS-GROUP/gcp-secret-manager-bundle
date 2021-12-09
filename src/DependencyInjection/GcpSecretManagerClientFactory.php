<?php

/*
 * This file is part of the gcp-secret-manager-bundle application.
 * (c) Anthony Papillaud <apapillaud@elixis.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ElixisGroup\GcpSecretManagerBundle\DependencyInjection;

use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

class GcpSecretManagerClientFactory
{
    public static function createClient(?string $keyfilepath): SecretManagerServiceClient
    {

        if( !is_null($keyfilepath) ){
            putenv('GOOGLE_APPLICATION_CREDENTIALS='.$keyfilepath);
        }

        return new SecretManagerServiceClient();
        
    }
}
