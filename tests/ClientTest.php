<?php

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testInstantiation()
    {
        $client = new \nanobananaproprompt\Client();
        $this->assertNotNull($client);
    }
}