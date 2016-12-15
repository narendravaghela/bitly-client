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
        $this->assertEmpty($bitlyClient->accessToken());
        unset($bitlyClient);

        $token = 'access-token';
        $bitlyClient = new BitlyClient($token);
        $this->assertEquals($bitlyClient->accessToken(), $token);
        unset($bitlyClient);
    }

    /**
     * testCallFunction method
     *
     * @return void
     */
    public function testMissingToken()
    {
        $this->expectException(\Bitly\Exception\MissingAccessTokenException::class);
        $bitlyClient = new BitlyClient();
        $bitlyClient->info();
    }

    /**
     * testInvalidMethod method
     *
     * @return void
     */
    public function testInvalidMethod()
    {
        $this->expectException(\BadFunctionCallException::class);
        $bitlyClient = new BitlyClient('access-token');
        $bitlyClient->wrongApiMethod();
    }
}
