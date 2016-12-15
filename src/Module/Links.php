<?php

namespace Bitly\Module;

use BadMethodCallException;

/**
 * Links
 *
 * API methods related to links - see http://dev.bitly.com/links.html
 */
class Links extends BaseModule
{

    /**
     * Returns the page title for a given Bitlink
     *
     * The $options array accepts the following keys:
     *
     * - shortUrl: refers to Bitlink e.g.: http://bit.ly/1RmnUT.
     * - hash: (optional) refers to bitly hashes e.g.: 2bYgqR.
     * - format: (optional) Response format (default: json).
     *
     * For example:
     *
     * $bitlyClient = new BitlyClient('Your access token');
     * $options = ['shortUrl' => 'http://bit.ly/1RmnUT'];
     * $response = $bitlyClient->info($options);
     *
     * @param array $options List of options for this API method
     * @return mixed API Response
     */
    public function info($options = [])
    {
        if (empty($options['shortUrl'])) {
            throw new BadMethodCallException("Required parameter is missing: shortUrl");
        }

        if (!empty($options['hash'])) {
            $options['hash'] = $options['hash'];
        }

        $options['shortUrl'] = $options['shortUrl'];
        $options += ['access_token' => $this->accessToken];

        $endpoint = $this->apiEndpointUrl . "info";

        $this->requestOptions = $options;

        $response = $this->httpClient->request('GET', $endpoint, ['query' => $options]);

        return $this->processResponse($response);
    }

    /**
     * Returns the target (long) URL
     *
     * The $options array accepts the following keys:
     *
     * - shortUrl: refers to Bitlink e.g.: http://bit.ly/1RmnUT.
     * - hash: (optional) refers to bitly hashes e.g.: 2bYgqR.
     * - format: (optional) Response format (default: json).
     *
     * For example:
     *
     * $bitlyClient = new BitlyClient('Your access token');
     * $options = ['shortUrl' => 'http://bit.ly/1RmnUT'];
     * $response = $bitlyClient->expand($options);
     *
     * @param array $options List of options for this API method
     * @return mixed API Response
     */
    public function expand($options = [])
    {
        if (empty($options['shortUrl'])) {
            throw new BadMethodCallException("Required parameter is missing: shortUrl");
        }

        if (!empty($options['hash'])) {
            $options['hash'] = $options['hash'];
        }

        $options['shortUrl'] = $options['shortUrl'];
        $options += ['access_token' => $this->accessToken];

        $endpoint = $this->apiEndpointUrl . "expand";

        $this->requestOptions = $options;

        $response = $this->httpClient->request('GET', $endpoint, ['query' => $options]);

        return $this->processResponse($response);
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
     * For example:
     *
     * $bitlyClient = new BitlyClient('Your access token');
     * $options = ['longUrl' => 'http://www.example.com?foo=bar&john=doe'];
     * $response = $bitlyClient->shorten($options);
     *
     * @param array $options List of options for this API method
     * @return mixed API Response
     */
    public function shorten($options = [])
    {
        if (empty($options['longUrl'])) {
            throw new BadMethodCallException("Required parameter is missing: longUrl");
        }

        $options['longUrl'] = $options['longUrl'];
        $options += ['access_token' => $this->accessToken];

        $endpoint = $this->apiEndpointUrl . "shorten";

        $this->requestOptions = $options;

        $response = $this->httpClient->request('GET', $endpoint, ['query' => $options]);

        return $this->processResponse($response);
    }
}
