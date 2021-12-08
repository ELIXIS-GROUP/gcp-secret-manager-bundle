<?php

namespace ElixisGroup\GcpSecretManagerBundle\Service;

use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

class GcpSecretManagerService{

    public function __construct(SecretManagerServiceClient $secretManagerClient, String $keyfilepath, String $googleProjectId)
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $keyfilepath);
    }

}