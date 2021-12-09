# GCP Secret Manager Bundle for Symfony
*Version 1.0.0* Created *2021/08/12* Last Update *2021/09/12*    

Use GCP Secrets as service container parameters in Symfony, and provided provider class to access secrets value.

## Prerequisites
---
Configure Secret Manager in your project Google Cloud, see following article who explain how create and configure Google Secret Manager [https://cloud.google.com/secret-manager/docs/configuring-secret-manager](https://cloud.google.com/secret-manager/docs/configuring-secret-manager).    

*Warning in local dev environment, you need create a service account to set global var GOOGLE_APPLICATION_CREDENTIALS. See [https://cloud.google.com/iam/docs/service-accounts#user-managed](https://cloud.google.com/iam/docs/service-accounts#user-managed).*

## Installation
---
```
$ composer require gcp-secret-manager-bundle
```
## Configuration
---
By default, configuration for this bundle is loaded from config/packages/gcp_secret_manager.yaml file or its environment specific.    

The following configuration properties are available:
```
#config/packages/gcp_secret_manager.yaml

gcp_secret_manager:
    secret_manager_client_config:
        project_id: 'projectId' # Google Cloud project id
        keyfilepath: '%kernel.project_dir%/google_application_credentials.json' # Google Credentials path
    delimiter: ':' # Delimiter to separate secret name from secret version
    ignore: false # Pass through GCP Secret Manager (for local dev environments set to "true").
```
## Default usage
---
Set an env var to an AWS Secret Manager Secret name and Secret version separate by the separator define in config or the default one, like so:
```
#.env

SECRET_ENV_VAR=SECRET_NAME:SECRET_VERSION
```
    
Set a parameter to this environment variable with the gcp processor:

```
#config/services.yaml

parameters:
    secret_env_var: '%env(gcp:SECRET_ENV_VAR)%'
```
## Service Container Usage
---
A standalone service container is also available if you don't want use a service container parameters.

```
#Controller/AcmeController.php

use ElixisGroup\GcpSecretManagerBundle\Provider\GcpSecretManagerProvider;

class AcmeController extends AbstractController
{
    public function index(GcpSecretManagerProvider $secretProvider){
        $secretValue = $secretProvider->get('SECRET_NAME', SECRET_VERSION);
    }
}
```

## Examples
---

* [Configure Doctrine Bundle in Symfony to GCP Secret Manager Bundle](https://github.com/ELIXIS-GROUP/gcp-secret-manager-bundle/blob/master/doc/sample_doctrine_connection.md)


