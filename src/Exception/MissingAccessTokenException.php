<?php

namespace Bitly\Exception;

use RuntimeException;

/**
 * MissingAccessTokenException class.  This exception will be thrown from
 * \Bitly\BitlyClient when access token is missing.
 */
class MissingAccessTokenException extends RuntimeException
{
}
