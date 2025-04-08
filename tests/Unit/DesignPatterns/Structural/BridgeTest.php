<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\DatabaseBridge;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Implementations\MySQLConnection;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Implementations\PostgreSQLConnection;

it('connects and fetches user using MySQL', function (): void {
    $service = new DatabaseBridge(new MySQLConnection());

    expect($service->connect())
        ->toBe('Connecting to MySQL database.');

    expect($service->getUser(42))
        ->toBe('Fetching user from MySQL with ID: 42');
});

it('connects and fetches user using PostgreSQL', function (): void {
    $service = new DatabaseBridge(new PostgreSQLConnection());

    expect($service->connect())
        ->toBe('Connecting to PostgreSQL database.');

    expect($service->getUser(42))
        ->toBe('Fetching user from PostgreSQL with ID: 42');
});

it('can switch connection types dynamically', function (): void {
    $mysql = new DatabaseBridge(new MySQLConnection());
    $pgsql = new DatabaseBridge(new PostgreSQLConnection());

    expect($mysql->connect())->toBe('Connecting to MySQL database.');
    expect($mysql->getUser(1))->toBe('Fetching user from MySQL with ID: 1');

    expect($pgsql->connect())->toBe('Connecting to PostgreSQL database.');
    expect($pgsql->getUser(1))->toBe('Fetching user from PostgreSQL with ID: 1');
});
