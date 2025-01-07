<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Builder;

class SmartHome
{
    public function __construct(
        public string $walls,
        public string $roof,
        public string $doors,
        /** @var string[] */
        public array $smartDevices = [],
        public ?bool $solarPanels = null,
        public ?string $securitySystem = null,
        public ?string $energySystem = null,
        public ?string $garageType = null,
        public ?string $poolType = null
    ) {
    }
}
