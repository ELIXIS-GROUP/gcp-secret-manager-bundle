<?php

/*
 * This file is part of the gcp-secret-manager-bundle application.
 * (c) Anthony Papillaud <apapillaud@elixis.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ElixisGroup\GcpSecretManagerBundle\Service;

use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

class GcpSecretManagerService
{
    public function __construct(SecretManagerServiceClient $secretManagerClient, string $keyfilepath, string $googleProjectId)
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.$keyfilepath);
    }
}
