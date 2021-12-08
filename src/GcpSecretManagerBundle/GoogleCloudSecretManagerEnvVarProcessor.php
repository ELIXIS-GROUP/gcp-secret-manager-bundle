<?php

namespace GcpSecretManager\GcpSecretManagerBundle;

use Closure;
use GcpSecretManager\GcpSecretManagerBundle\Exception\GcpSecretManagerException;
use GcpSecretManager\GcpSecretManagerBundle\Provider\GcpSecretManagerProvider;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;

class GcpSecretManagerEnvVarProcessor implements EnvVarProcessorInterface
{

    /**
     * @var GcpSecretManagerProvider
     */
    private $_provider;

    /**
     * @var bool
     */
    private $_ignore;

    /**
     * @var string
     */
    private $_delimiter;

    public function __construct(GcpSecretManagerProvider $provider, bool $ignore = false, string $delimiter = ',')
    {
        $this->_provider = $provider;
        $this->_ignore = $ignore;
        $this->_delimiter = $delimiter;
    }

    /**
     * Returns the value of the given variable as managed by the current instance.
     *
     * @param string   $prefix The namespace of the variable
     * @param string   $name   The name of the variable within the namespace
     * @param \Closure $getEnv A closure that allows fetching more env vars
     *
     * @return mixed
     *
     * @throws RuntimeException on error
     */
    public function getEnv(string $prefix, string $name, Closure $getEnv)
    {
        if( $this->_ignore === true ){
            return $getEnv($name);
        }

        $value = $getEnv($name);
        if( "" !== $value ){

            $parts = explode($this->_delimiter, $value);

            if( 1 == count($parts) ){
                throw new GcpSecretManagerException("Env Var for get secret is not formatted correctly. See Documentation for more information : http://....fr.");
            }
            
            list($secretId, $secretVersion) = $parts;
            $value = $this->_provider->get($secretId, $secretVersion);

        }
        return $value;
    }

    /**
     * @return string[] The PHP-types managed by getEnv(), keyed by prefixes
     */
    public static function getProvidedTypes()
    {
        return [
            'gcp' => 'bool|int|float|string',
        ];
    }

}