<?php

namespace Bitly\Module;

use BadMethodCallException;

/**
 * Links
 *
 */
class Links extends BaseModule
{

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
