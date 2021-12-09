# Example: Configure Doctrine Bundle in Symfony to GCP Secret Manager Bundle

## Step #1 : Create secret in GCP Console
Begin to create secret in Gcp Console : For memory see official documentation
[https://cloud.google.com/secret-manager/docs/creating-and-accessing-secrets#secretmanager-create-secret-console](https://cloud.google.com/secret-manager/docs/creating-and-accessing-secrets#secretmanager-create-secret-console).    

For this example let's say secret contain value DATABASE_URL for the database configuration:    
```
Secret Name : EXAMPLE_DATBASE_URL_CONFIGURATION
Secret Value : mysql://{db_user}:{db_password}@db_ip:{db_port}/{db_name}?serverVersion=8.0
Secret Version : 1
```
_* For this sample replace var {db_****} by your values _

## Step #2 : Load Secret in env var
Add the following to .env :
```
# .env

DOCRTINE_DATBASE_URL_CONFIG=EXAMPLE_DATBASE_URL_CONFIGURATION:1
```

## Step #3 : Configure Doctrine
To confgigure doctrine with your secret add the following to config/packages/doctrine.yaml
```
# config/packages/doctrine.yaml

doctrine:
    dbal:
        url: '%env(gcp:DOCRTINE_DATBASE_URL_CONFIG)%'
```

[[back to README]](https://github.com/ELIXIS-GROUP/gcp-secret-manager-bundle/blob/master/readme.md)
