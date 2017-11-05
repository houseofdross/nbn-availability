<?php

namespace HodTest\NbnAvailability;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Hod\NbnAvailability\AvailabilityChecker;
use PHPUnit\Framework\TestCase;

class AvailabilityCheckerTest extends TestCase
{
    public function testCheckAvailabilityMapsNotAvailableResponse()
    {
        $successfulResponse = new Response(
            200,
            [],
            json_encode([
                'servingArea' => [
                    'serviceType' => 'other',
                    'csaId' => 'CSA300000010862',
                    'serviceStatus' => 'proposed',
                    'techTypeMapLabel' => '<b>nbn</b>™ Hybrid Fibre Coaxial (HFC)',
                    'description' => 'XDA',
                    'techTypeLabel' => 'Hybrid Fibre Coaxial (HFC)',
                    'id' => 'other:3TNB-A0025',
                    'rfsMessage' => 'Jul-Sep 2018',
                    'addressStatus' => '0',
                    'techTypeDescription' => 'An <b>nbn</b>™ Hybrid Fibre Coaxial (HFC) connection is used in circumstances where the existing ‘pay TV’ or cable network can be used to make the final part of the <b>nbn</b>™ broadband access network connection.',
                    'serviceCategory' => 'brownfields',
                    'isDisconnectionDatePassed' =>  false,
                ],
                'serviceAvailableAddress' => false,
            ])
        );
        $mockedClient = \Mockery::mock(Client::class);
        $mockedClient
            ->shouldReceive('request')
            ->withArgs(['GET', 'https://www.nbnco.com.au/api/map/search.html?lat=100&lng=200', \Mockery::any()])
            ->once()
            ->andReturn($successfulResponse);

        $availabilityChecker = new AvailabilityChecker($mockedClient);
        $result = $availabilityChecker->checkAvailability(100, 200);

        $this->assertEquals('proposed', $result->serviceStatus());
        $this->assertEquals('Hybrid Fibre Coaxial (HFC)', $result->technologyType());
        $this->assertEquals('brownfields', $result->serviceCategory());
        $this->assertEquals('Jul-Sep 2018', $result->availableDate());
    }

    public function testCheckAvailabilityMapsIsAvailableResponse()
    {
        /*
        {
            "servingArea":{
                "serviceType":"other",
                "csaId":"CSA300000000325",
                "serviceStatus":"available",
                "techTypeMapLabel":"Fixed line",
                "description":"XDA",
                "techTypeLabel":null,
                "id":"other:3NPR-A0096",
                "rfsMessage":"",
                "addressStatus":"0",
                "techTypeDescription":null,
                "serviceCategory":"brownfields",
                "isDisconnectionDatePassed":false
            },
            "serviceAvailableAddress":false}"
        */

        $successfulResponse = new Response(
            200,
            [],
            json_encode([
                'servingArea' => [
                    'serviceType' => 'other',
                    'csaId' => 'CSA300000000325',
                    'serviceStatus' => 'available',
                    'techTypeMapLabel' => 'Fixed line',
                    'description' => 'XDA',
                    'techTypeLabel' => null,
                    'id' => 'other:3NPR-A0096',
                    'rfsMessage' => '',
                    'addressStatus' => '0',
                    'techTypeDescription' => '',
                    'serviceCategory' => 'brownfields',
                    'isDisconnectionDatePassed' =>  false,
                ],
                'serviceAvailableAddress' => false,
            ])
        );
        $mockedClient = \Mockery::mock(Client::class);
        $mockedClient
            ->shouldReceive('request')
            ->withArgs(['GET', 'https://www.nbnco.com.au/api/map/search.html?lat=100&lng=200', \Mockery::any()])
            ->once()
            ->andReturn($successfulResponse);

        $availabilityChecker = new AvailabilityChecker($mockedClient);
        $result = $availabilityChecker->checkAvailability(100, 200);

        $this->assertEquals('available', $result->serviceStatus());
        $this->assertEquals('Fixed line', $result->technologyType());
        $this->assertEquals('brownfields', $result->serviceCategory());
        $this->assertEquals('', $result->availableDate());
    }
}
