<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Singleton\Logger;

test('singleton always returns the same instance', function (): void {
    $logger1 = Logger::getInstance();
    $logger2 = Logger::getInstance();

    expect($logger1)->toBeInstanceOf(Logger::class);
    expect($logger1)->toBe($logger2);
});
