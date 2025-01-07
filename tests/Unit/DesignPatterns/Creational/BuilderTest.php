<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Builder\SmartHome;
use HalfShellStudios\CodingTips\DesignPatterns\Creational\Builder\SmartHomeBuilder;

it('creates a SmartHome with correct features', function (): void {
    $builder = new SmartHomeBuilder();

    $smartHome = $builder
        ->setWalls("Reinforced concrete walls")
        ->setRoof("Energy-efficient green roof")
        ->setDoors("Biometric access doors")
        ->addSmartDevice("Smart thermostat")
        ->addSmartDevice("Smart fridge")
        ->addSmartDevice("Smart security cameras")
        ->setSecuritySystem("AI-driven facial recognition")
        ->setEnergySystem("Off-grid solar battery storage")
        ->enableSolarPanels()
        ->setGarageType("EV charging-enabled garage")
        ->setPoolType("Heated infinity pool")
        ->build();

    expect($smartHome)->toBeInstanceOf(SmartHome::class);
    expect($smartHome->walls)->toBe("Reinforced concrete walls");
    expect($smartHome->roof)->toBe("Energy-efficient green roof");
    expect($smartHome->doors)->toBe("Biometric access doors");
    expect($smartHome->smartDevices)->toContain("Smart thermostat", "Smart fridge", "Smart security cameras");
    expect($smartHome->securitySystem)->toBe("AI-driven facial recognition");
    expect($smartHome->energySystem)->toBe("Off-grid solar battery storage");
    expect($smartHome->solarPanels)->toBeTrue();
    expect($smartHome->garageType)->toBe("EV charging-enabled garage");
    expect($smartHome->poolType)->toBe("Heated infinity pool");
});

it('creates a SmartHome with no additional features', function (): void {
    $builder = new SmartHomeBuilder();

    $smartHome = $builder
        ->setWalls("Standard walls")
        ->setRoof("Standard roof")
        ->setDoors("Standard doors")
        ->build();

    expect($smartHome)->toBeInstanceOf(SmartHome::class);
    expect($smartHome->walls)->toBe("Standard walls");
    expect($smartHome->roof)->toBe("Standard roof");
    expect($smartHome->doors)->toBe("Standard doors");
    expect($smartHome->smartDevices)->toBeEmpty();
    expect($smartHome->solarPanels)->toBeFalse();
    expect($smartHome->securitySystem)->toBeNull();
    expect($smartHome->energySystem)->toBeNull();
    expect($smartHome->garageType)->toBeNull();
    expect($smartHome->poolType)->toBeNull();
});
