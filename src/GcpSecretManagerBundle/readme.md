```
#config/packages/gcp_secret_manager.yaml
gcp_secret_manager:
    secret_manager_client_config:
        project_id: 'projectId'
        keyfilepath: '%kernel.project_dir%/google_application_credentials.json'
    delimiter: ':'
    ignore: false
```
```
#config/services.yaml

parameters:
    secret_env_var: '%env(gcp:SECRET_ENV_VAR)%'
```
```
#.env

SECRET_ENV_VAR=SECRET_NAME:SECRET_VERSION
```
```
#Controller/AcmeController.php

use GoogleCloudSecretManager\SecretManagerBundle\Provider\GcpSecretManagerProvider;

class AcmeController extends AbstractController
{
    public function index(GcpSecretManagerProvider $secretProvider){
        $secretValueFromParameter = $this->getParameter('secret_env_var');
        $secretValue = $secretProvider->get('SECRET_NAME', SECRET_VERSION);
    }
}
```