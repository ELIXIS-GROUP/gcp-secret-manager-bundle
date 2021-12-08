<?php

namespace GcpSecretManager\GcpSecretManagerBundle\Provider;

use GcpSecretManager\GcpSecretManagerBundle\Exception\GcpSecretManagerException;
use Google\ApiCore\ApiException;
use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;

class GcpSecretManagerProvider{

    public function __construct(SecretManagerServiceClient $secretManagerClient, $googleProjectId)
    {
        $this->_secretManagerClient = $secretManagerClient;
        $this->_googleProjectId = $googleProjectId;
    }

    public function get(String $secretId, String $version){

        try{

            $secretName = $this->_secretManagerClient->secretVersionName($this->_googleProjectId, $secretId, $version);
            $secretResponse = $this->_secretManagerClient->accessSecretVersion($secretName);
        
            $secretPayload = $secretResponse->getPayload()->getData();
            return ( is_null(json_decode($secretPayload, true)) )? $secretPayload :  json_decode($secretPayload, true);

        }catch( ApiException $e ){

            $message = json_decode($e->getMessage(), true);
            throw new GcpSecretManagerException($message['message']);
        }

    }

}