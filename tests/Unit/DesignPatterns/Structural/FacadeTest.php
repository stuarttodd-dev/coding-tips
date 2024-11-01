<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\PhaserService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\PowerService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\StabiliserService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\TargetingService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\PhaserControl;

beforeEach(function (): void {
    $this->phaserControl = new PhaserControl();
});

it('initialises power system', function (): void {
    $powerService = new PowerService();
    expect($powerService->initialise())->toBe("Power system online and ready.");
});

it('stabilises the ship', function (): void {
    $stabiliserService = new StabiliserService();
    expect($stabiliserService->stabilise())->toBe("Ship stabilised.");
});

it('locks onto target coordinates', function (): void {
    $targetingService = new TargetingService();
    expect($targetingService->lock(1.5, 5.6))->toBe("Target locked at coordinates 1.5, 5.6.");
});

it('fires phaser', function (): void {
    $phaserService = new PhaserService();
    expect($phaserService->fire())->toBe("Phaser fired!");
});

it('coordinates subsystems to fire phaser using the facade', function (): void {
    $result = $this->phaserControl->fire(1.5, 5.6);

    expect($result)->toContain("Power system online and ready.")
        ->toContain("Target locked at coordinates 1.5, 5.6.")
        ->toContain("Ship stabilised.")
        ->toContain("Phaser fired!");
});
