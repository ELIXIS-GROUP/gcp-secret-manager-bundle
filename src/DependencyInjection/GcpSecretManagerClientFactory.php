<?php

namespace ElixisGroup\GcpSecretManagerBundle\DependencyInjection;

use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

class GcpSecretManagerClientFactory{

    public static function createClient(String $keyfilepath): SecretManagerServiceClient
    {        
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $keyfilepath);
        return new SecretManagerServiceClient();
    }

}