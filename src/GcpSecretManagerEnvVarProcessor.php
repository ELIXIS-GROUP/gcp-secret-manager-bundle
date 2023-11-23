<?php

/*
 * This file is part of the gcp-secret-manager-bundle application.
 * (c) Anthony Papillaud <apapillaud@elixis.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ElixisGroup\GcpSecretManagerBundle;

use Closure;
use ElixisGroup\GcpSecretManagerBundle\Exception\GcpSecretManagerException;
use ElixisGroup\GcpSecretManagerBundle\Provider\GcpSecretManagerProvider;
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
    public function getEnv(string $prefix, string $name, Closure $getEnv): mixed
    {
        if (true === $this->_ignore) {
            return $getEnv($name);
        }

        $value = $getEnv($name);
        if ('' !== $value) {
            $parts = explode($this->_delimiter, $value);

            if (1 == count($parts)) {
                throw new GcpSecretManagerException('Env Var for get secret is not formatted correctly. See Documentation for more information : http://....fr.');
            }

            list($secretId, $secretVersion) = $parts;
            $value = $this->_provider->get($secretId, $secretVersion);
        }

        return $value;
    }

    /**
     * @return string[] The PHP-types managed by getEnv(), keyed by prefixes
     */
    public static function getProvidedTypes(): array
    {
        return [
            'gcp' => 'bool|int|float|string',
        ];
    }
}
