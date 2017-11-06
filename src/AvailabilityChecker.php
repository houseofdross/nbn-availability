<?php

namespace Hod\NbnAvailability;

use GuzzleHttp\Client;
use Hod\NbnAvailability\Entity\AvailabilityStatus;
use Hod\NbnAvailability\Exception\ClientRequestException;
use Hod\NbnAvailability\Exception\ServerResponseException;

class AvailabilityChecker
{
    /** @var Client */
    private $client;

    public function __construct(Client $client=null)
    {
        if ($client === null) {
            $client = new Client();
        }
        $this->client = $client;
    }

    public function checkAvailability(float $latitude, float $longitude): AvailabilityStatus
    {
        $requestUri = sprintf(
            'https://www.nbnco.com.au/api/map/search.html?lat=%s&lng=%s',
            $latitude,
            $longitude
        );

        $response = $this->client->request('GET', $requestUri, [
            'headers' => [
                'Referer' => 'https://www.nbnco.com.au/when-do-i-get-it/rollout-map.html',
            ],
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400 && $statusCode < 500) {
            throw new ClientRequestException($response->getBody(), $response->getStatusCode());
        }
        if ($statusCode >= 500 && $statusCode < 600) {
            throw new ServerResponseException($response->getBody(), $response->getStatusCode());
        }

        $availability = \GuzzleHttp\json_decode($response->getBody(), true);
        $availabilityStatus = $availability['servingArea'] ?? [];

        $nbnAvailability = new AvailabilityStatus(
            $availabilityStatus['serviceStatus'] ?? '',
            $availabilityStatus['techTypeLabel'] ?? $availabilityStatus['techTypeMapLabel'] ?? '',
            $availabilityStatus['serviceCategory'] ?? '',
            $availabilityStatus['rfsMessage'] ?? ''
        );

        return $nbnAvailability;
    }
}
