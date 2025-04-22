<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\Singleton;

class Logger
{
    private static ?Logger $instance = null;

    private function __construct()
    {
        // private to prevent direct instantiation
    }

    public static function getInstance(): Logger
    {
        if (!self::$instance instanceof \HalfShellStudios\CodingTips\DesignPatterns\Creational\Singleton\Logger) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    public function log(string $message): void
    {
        echo "[LOG] " . $message . PHP_EOL;
    }
}
