<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\DatabaseService;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Implementations\MySQLDatabase;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Implementations\PostgreSQLDatabase;

it('tests MySQL connection and user fetch', function () {
    $mysqlDatabase = new MySQLDatabase();
    $databaseService = new DatabaseService($mysqlDatabase);

    expect($databaseService->connect())->toEqual('Connecting to MySQL database.');
    expect($databaseService->getUser(1))->toEqual('Fetching user from MySQL with ID: 1');
});

it('tests PostgreSQL connection and user fetch', function () {
    $postgresqlDatabase = new PostgreSQLDatabase();
    $databaseService = new DatabaseService($postgresqlDatabase);

    expect($databaseService->connect())->toEqual('Connecting to PostgreSQL database.');
    expect($databaseService->getUser(1))->toEqual('Fetching user from PostgreSQL with ID: 1');
});

// Test for switching between database types
it('tests switching between MySQL and PostgreSQL databases', function () {
    $mysqlDatabase = new MySQLDatabase();
    $postgresqlDatabase = new PostgreSQLDatabase();

    // Initially MySQL
    $databaseService = new DatabaseService($mysqlDatabase);
    expect($databaseService->connect())->toEqual('Connecting to MySQL database.');

    // Switch to PostgreSQL
    $databaseService = new DatabaseService($postgresqlDatabase);
    expect($databaseService->connect())->toEqual('Connecting to PostgreSQL database.');
});

it('tests if connect is called only once per instance', function () {
    $mysqlDatabase = $this->createMock(MySQLDatabase::class);
    $mysqlDatabase->expects($this->once())
        ->method('connect')
        ->willReturn('Connecting to MySQL database.');

    $databaseService = new DatabaseService($mysqlDatabase);
    $databaseService->connect(); // Should call connect only once
});
