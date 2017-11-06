<?php

namespace Entity;

use Hod\NbnAvailability\Entity\AvailabilityStatus;
use PHPUnit\Framework\TestCase;

class AvailabilityStatusTest extends TestCase
{
    public function testConstructorFillsValues()
    {
        $status = new AvailabilityStatus(
            'serviceStatus',
            'technologyType',
            'serviceCategory',
            'availableDate'
        );
        $this->assertEquals('serviceStatus', $status->serviceStatus());
        $this->assertEquals('technologyType', $status->technologyType());
        $this->assertEquals('serviceCategory', $status->serviceCategory());
        $this->assertEquals('availableDate', $status->availableDate());
    }

    public function testJsonSerializeReturnsCorrectArray()
    {
        $status = new AvailabilityStatus(
            'serviceStatus',
            'technologyType',
            'serviceCategory',
            'availableDate'
        );

        $expected = [
            'serviceStatus' => 'serviceStatus',
            'technologyType' => 'technologyType',
            'serviceCategory' => 'serviceCategory',
            'availableDate' => 'availableDate',
        ];
        $this->assertEquals($expected, $status->jsonSerialize());
    }

    public function testToStringReturnsFormattedString()
    {
        $status = new AvailabilityStatus(
            'serviceStatus',
            'technologyType',
            'serviceCategory',
            'availableDate'
        );
        $expected = 'Hod\NbnAvailability\Entity\AvailabilityStatus:'.json_encode([
            'serviceStatus' => 'serviceStatus',
            'technologyType' => 'technologyType',
            'serviceCategory' => 'serviceCategory',
            'availableDate' => 'availableDate',
        ]);
        $this->assertEquals($expected, (string)$status);
    }
}
