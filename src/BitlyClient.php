<?php

namespace Bitly;

use GuzzleHttp\Client;

/**
 * Bitly client
 *
 */
class BitlyClient
{

    /**
     * Bitly API endpoint
     *
     * @var string URL
     */
    private $_apiEndpoint = "https://api-ssl.bitly.com";

    /**
     * Bitly API endpoint URL
     *
     * @var string URL
     */
    private $_apiEndpointUrl = "";

    /**
     * Access token
     *
     * @var string
     */
    private $_accessToken = "";

    /**
     * API Version
     *
     * @var string
     */
    private $_apiVersion = "v3";

    /**
     * HTTP Client
     *
     * @var object Cake\Http\Client
     */
    private $_httpClient;

    /**
     * Options passed in API request
     *
     * @var array
     */
    private $_requestOptions = [];

    /**
     * Available response formats
     *
     * @var array
     */
    private $_responseFormats = [
        'json',
        'xml',
        'txt'
    ];

    /**
     * constructor
     *
     */
    public function __construct($token = null)
    {
        if ($token !== null) {
            return $this->_accessToken;
        }

        $this->_apiEndpointUrl = $this->_apiEndpoint . '/' . $this->_apiVersion . '/';

        $this->_httpClient = new Client();
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
            return $this->_accessToken;
        }

        $this->_accessToken = $token;

        return true;
    }

    /**
     * Magic method for Bitly API based.
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
     * @param string $name Method name to use.
     * @param array $arguments Parameters to pass when calling methods.
     * @return mixed API Response.
     * @throws BadFunctionCallException If method does not exist.
     * @throws MissingAccessTokenException If access token is not set.
     */
    public function __call($name, $arguments = [])
    {
        $methodName = "_" . $name;
        if (!method_exists($this, $methodName)) {
            throw new BadFunctionCallException();
        }

        if (empty($this->_accessToken)) {
            throw new MissingAccessTokenException();
        }

        return $this->$methodName($arguments[0]);
    }

    /**
     * Returns a Bitlink
     *
     * The $options array accepts the following keys:
     *
     * - longUrl: long URL to be shortened (example: http://betaworks.com/).
     * - domain: (optional) the short domain to use; either bit.ly, j.mp, or bitly.com or a custom short domain.
     * - format: (optional) Response format (default: json).
     *
     * @param array $options List of options for this API method
     * @return mixed API Response
     */
    private function _shorten($options = [])
    {
        if (empty($options['longUrl'])) {
            throw new BadMethodCallException();
        }

        $options['longUrl'] = $options['longUrl'];
        $options += ['access_token' => $this->_accessToken];

        $endpoint = $this->_apiEndpointUrl . "shorten";

        $this->_requestOptions = $options;

        $response = $this->_httpClient->request('GET', $endpoint, ['query' => $options]);

        return $this->_processResponse($response);
    }

    /**
     * Processes response based on format
     *
     * @param Cake\Http\Client\Response $response Response
     * @return type
     */
    private function _processResponse($response)
    {
        $format = (!empty($this->_requestOptions['format']) && in_array($this->_requestOptions['format'], $this->_responseFormats)) ? $this->_requestOptions['format'] : 'json';

        if ('json' === $format) {
            return json_decode($response->getBody()->getContents());
        } elseif ('xml' === $format) {
            return simplexml_load_string($response->getBody()->getContents());
        } else {
            return $response->getBody()->getContents();
        }
    }
}
