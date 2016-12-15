<?php

namespace Test;

use Bitly\BitlyClient;
use PHPUnit\Framework\TestCase;

class BitlyClientTest extends TestCase
{
    /**
     * testConstructor method
     *
     * @return void
     */
    public function testConstructor()
    {
        $bitlyClient = new BitlyClient();
        $this->assertTrue(is_a($bitlyClient, 'Bitly\BitlyClient'));
    }
}
