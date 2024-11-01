<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade;

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\PhaserService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\PowerService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\StabiliserService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Facade\Subsystems\TargetingService;

class PhaserControl
{
    protected PowerService $powerService;

    protected TargetingService $targetingService;

    protected StabiliserService $stabiliserService;

    protected PhaserService $phaserService;

    public function __construct()
    {
        $this->powerService = new PowerService();
        $this->targetingService = new TargetingService();
        $this->stabiliserService = new StabiliserService();
        $this->phaserService = new PhaserService();
    }

    public function fire(float $xCoordinate, float $yCoordinate): string
    {
        return
            $this->powerService->initialise() . PHP_EOL .
            $this->targetingService->lock($xCoordinate, $yCoordinate) . PHP_EOL .
            $this->stabiliserService->stabilise() . PHP_EOL .
            $this->phaserService->fire() . PHP_EOL;
    }
}
