<?php

namespace Bitly\Module;

use Bitly\Exception\MissingAccessTokenException;
use GuzzleHttp\Client;

/**
 * BaseModule class
 *
 */
class BaseModule
{

    /**
     * Bitly API endpoint
     *
     * @var string URL
     */
    protected $apiEndpoint = "https://api-ssl.bitly.com";

    /**
     * Bitly API endpoint URL
     *
     * @var string URL
     */
    protected $apiEndpointUrl = "";

    /**
     * API Version
     *
     * @var string
     */
    protected $apiVersion = "v3";

    /**
     * Access token
     *
     * @var string
     */
    protected $accessToken = "";

    /**
     * HTTP Client
     *
     * @var object Cake\Http\Client
     */
    protected $httpClient;

    /**
     * Options passed in API request
     *
     * @var array
     */
    protected $requestOptions = [];

    /**
     * Available response formats
     *
     * @var array
     */
    protected $responseFormats = [
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
        if ($token === null) {
            throw new MissingAccessTokenException;
        }

        $this->apiEndpointUrl = $this->apiEndpoint . '/' . $this->apiVersion . '/';
        $this->accessToken = $token;
        $this->httpClient = new Client();
    }

    /**
     * Processes response based on format
     *
     * @param Cake\Http\Client\Response $response Response
     * @return type
     */
    protected function processResponse($response)
    {
        $format = (!empty($this->requestOptions['format']) && in_array($this->requestOptions['format'], $this->responseFormats)) ? $this->requestOptions['format'] : 'json';

        if ('json' === $format) {
            return json_decode($response->getBody()->getContents());
        } elseif ('xml' === $format) {
            return simplexml_load_string($response->getBody()->getContents());
        } else {
            return $response->getBody()->getContents();
        }
    }
}
