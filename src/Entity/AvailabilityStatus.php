<?php

namespace Hod\NbnAvailability\Entity;

class AvailabilityStatus implements \JsonSerializable
{
    private $serviceStatus;
    private $technologyType;
    private $serviceCategory;
    private $availableDate;

    public function __construct(string $serviceStatus, string $technologyType, string $serviceCategory, string $availableDate)
    {
        $this->serviceStatus = $serviceStatus;
        $this->technologyType = $technologyType;
        $this->serviceCategory = $serviceCategory;
        $this->availableDate = $availableDate;
    }

    public function __toString(): string
    {
        return self::class.':'.json_encode($this);
    }

    public function jsonSerialize(): array
    {
        return [
            'serviceStatus' => $this->serviceStatus(),
            'techologyType' => $this->technologyType(),
            'serviceCategory' => $this->serviceCategory(),
            'availableDate' => $this->availableDate(),
        ];
    }

    public function serviceStatus(): string
    {
        return $this->serviceStatus;
    }

    public function technologyType(): string
    {
        return $this->technologyType;
    }

    public function serviceCategory(): string
    {
        return $this->serviceCategory;
    }

    public function availableDate(): string
    {
        return $this->availableDate;
    }
}
