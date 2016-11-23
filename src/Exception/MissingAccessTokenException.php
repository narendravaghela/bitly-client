<?php

namespace Bitly\Exception;

use Exception;

/**
 * MissingAccessTokenException class.  This exception will be thrown from
 * \Bitly\BitlyClient when access token is missing.
 */
class MissingAccessTokenException extends Exception
{
    /**
     * Constructor
     *
     * @param string|null $message If no message is given 'Missing token' will be the message
     * @param int $code Status code, defaults to 400
     */
    public function __construct($message = null, $code = 400)
    {
        if (empty($message)) {
            $message = 'Missing token';
        }
        parent::__construct($message, $code);
    }
}
