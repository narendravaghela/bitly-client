<?php

namespace Bitly;

use BadFunctionCallException;
use Bitly\Exception\MissingAccessTokenException;

/**
 * Bitly client
 *
 */
class BitlyClient
{

    /**
     * Access token
     *
     * @var string
     */
    protected $token = "";

    /**
     * API Modules
     *
     * @var array
     */
    protected $apiModules = [
        'Links'
    ];

    /**
     * constructor
     *
     */
    public function __construct($token = null)
    {
        if ($token !== null) {
            $this->accessToken($token);
        }
    }

    /**
     * Gets/Sets access token
     *
     * @param string $token Authentication token
     * @return mixes String if $token is empty, true otherwise
     */
    public function accessToken($token = null)
    {
        if ($token === null) {
            return $this->token;
        }

        $this->token = $token;

        return true;
    }

    /**
     * Magic method to call Bitly API methods.
     *
     * For example:
     *
     * $bitlyClient = new BitlyClient('Your access token');
     * OR
     * $bitlyClient = new BitlyClient();
     * $bitlyClient->accessToken('Your access token');
     *
     * $options = ['longUrl' => 'http://www.example.com?foo=bar&john=doe'];
     * $response = $bitlyClient->shorten($options);
     *
     * @param string $methodName Method name to use.
     * @param array $arguments Parameters to pass when calling methods.
     * @return mixed API Response.
     * @throws BadFunctionCallException If method does not exist.
     * @throws MissingAccessTokenException If access token is not set.
     */
    public function __call($methodName, $arguments = [])
    {
        if (empty($this->token)) {
            throw new MissingAccessTokenException();
        }

        foreach ($this->apiModules as $module) {
            $className = '\Bitly\Module\\' . $module;
            if (method_exists($className, $methodName)) {
                $apiModule = new $className($this->accessToken());
                break;
            }
        }

        if (!isset($apiModule)) {
            throw new BadFunctionCallException("Invalid API method!");
        }

        return $apiModule->$methodName(!empty($arguments[0]) ? $arguments[0] : null);
    }
}
