<?php

namespace Exception;

use Hod\NbnAvailability\Exception\ClientRequestException;
use PHPUnit\Framework\TestCase;

class ClientRequestExceptionTest extends TestCase
{
    public function testConstructor()
    {
        $exception = new ClientRequestException('message', 1);
        $this->assertEquals('message', $exception->getMessage());
        $this->assertEquals(1, $exception->getCode());
    }
}
