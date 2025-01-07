<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Builder;

class SmartHomeBuilder
{
    private string $walls;

    private string $roof;

    private string $doors;

    /** @var string[] */
    private array $smartDevices = [];

    private bool $solarPanels = false;

    private ?string $securitySystem = null;

    private ?string $energySystem = null;

    private ?string $garageType = null;

    private ?string $poolType = null;

    public function setWalls(string $walls): self
    {
        $this->walls = $walls;
        return $this;
    }

    public function setRoof(string $roof): self
    {
        $this->roof = $roof;
        return $this;
    }

    public function setDoors(string $doors): self
    {
        $this->doors = $doors;
        return $this;
    }

    public function addSmartDevice(string $device): self
    {
        $this->smartDevices[] = $device;
        return $this;
    }

    public function setSecuritySystem(string $system): self
    {
        $this->securitySystem = $system;
        return $this;
    }

    public function setEnergySystem(string $system): self
    {
        $this->energySystem = $system;
        return $this;
    }

    public function enableSolarPanels(): self
    {
        $this->solarPanels = true;
        return $this;
    }

    public function setGarageType(string $type): self
    {
        $this->garageType = $type;
        return $this;
    }

    public function setPoolType(string $type): self
    {
        $this->poolType = $type;
        return $this;
    }

    public function build(): SmartHome
    {
        return new SmartHome(
            $this->walls,
            $this->roof,
            $this->doors,
            $this->smartDevices,
            $this->solarPanels,
            $this->securitySystem,
            $this->energySystem,
            $this->garageType,
            $this->poolType
        );
    }
}
