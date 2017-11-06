<?php

namespace Exception;

use Hod\NbnAvailability\Exception\ServerResponseException;
use PHPUnit\Framework\TestCase;

class ServerResponseExceptionTest extends TestCase
{
    public function testConstructor()
    {
        $exception = new ServerResponseException('message', 100);
        $this->assertEquals('message', $exception->getMessage());
        $this->assertEquals(100, $exception->getCode());
    }
}
