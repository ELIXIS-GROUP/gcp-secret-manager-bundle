<?php

/*
 * This file is part of the gcp-secret-manager-bundle application.
 * (c) Anthony Papillaud <apapillaud@elixis.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ElixisGroup\GcpSecretManagerBundle\Provider;

use ElixisGroup\GcpSecretManagerBundle\Exception\GcpSecretManagerException;
use Google\ApiCore\ApiException;
use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

class GcpSecretManagerProvider
{

    private $_secretManagerClient;
    
    private $_googleProjectId;

    public function __construct(SecretManagerServiceClient $secretManagerClient, $googleProjectId)
    {
        $this->_secretManagerClient = $secretManagerClient;
        $this->_googleProjectId = $googleProjectId;
    }

    public function get(string $secretId, string $version)
    {
        try {
            $secretName = $this->_secretManagerClient->secretVersionName($this->_googleProjectId, $secretId, $version);
            $secretResponse = $this->_secretManagerClient->accessSecretVersion($secretName);

            $secretPayload = $secretResponse->getPayload()->getData();

            return (is_null(json_decode($secretPayload, true))) ? $secretPayload : json_decode($secretPayload, true);
        } catch (ApiException $e) {
            $message = json_decode($e->getMessage(), true);
            throw new GcpSecretManagerException($message['message']);
        }
    }
}
