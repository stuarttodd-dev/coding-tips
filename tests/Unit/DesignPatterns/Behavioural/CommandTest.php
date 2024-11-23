<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Receivers\LocalStorage;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\Receivers\CloudStorage;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\ConcreteCommands\OpenFileCommand;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\ConcreteCommands\SaveFileCommand;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\ConcreteCommands\CloseFileCommand;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\CommandInvoker;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Command\AlternativeVersion\FileManager;

it('executes all queued commands in the invoker (LocalStorage)', function () {
    $fileManager = new LocalStorage();
    $fileName = 'example.txt';
    $openCommand = new OpenFileCommand($fileManager, $fileName);
    $saveCommand = new SaveFileCommand($fileManager, $fileName);
    $closeCommand = new CloseFileCommand($fileManager, $fileName);

    $invoker = new CommandInvoker();
    $invoker->addCommand($openCommand);
    $invoker->addCommand($saveCommand);
    $invoker->addCommand($closeCommand);

    $response = $invoker->executeAll();

    expect($response)->toEqual([
        'Opening local file: example.txt' . PHP_EOL,
        'Saving local file: example.txt' . PHP_EOL,
        'Closing local file: example.txt' . PHP_EOL,
    ]);
});

it('executes all queued commands in the invoker (CloudStorage)', function () {
    $fileManager = new CloudStorage();
    $fileName = 'example.txt';
    $openCommand = new OpenFileCommand($fileManager, $fileName);
    $saveCommand = new SaveFileCommand($fileManager, $fileName);
    $closeCommand = new CloseFileCommand($fileManager, $fileName);

    $invoker = new CommandInvoker();
    $invoker->addCommand($openCommand);
    $invoker->addCommand($saveCommand);
    $invoker->addCommand($closeCommand);

    $response = $invoker->executeAll();

    expect($response)->toEqual([
        'Connecting to cloud storage...' . PHP_EOL . 'Opening cloud file: example.txt' . PHP_EOL,
        'Saving file to cloud storage: example.txt' . PHP_EOL,
        'Closing connection for cloud file: example.txt' . PHP_EOL,
    ]);
});

it('opens a local file', function () {
    $fileManager = new FileManager('LocalStorage');
    $fileName = 'example.txt';

    $output = $fileManager->open($fileName);

    expect($output)->toBe("Opening local file: {$fileName}\n");
});

it('saves a local file', function () {
    $fileManager = new FileManager('LocalStorage');
    $fileName = 'example.txt';

    ob_start();
    $fileManager->save($fileName);
    $output = ob_get_clean();

    expect($output)->toBe("Saving data to local file: {$fileName}\n");
});

it('closes a local file', function () {
    $fileManager = new FileManager('LocalStorage');
    $fileName = 'example.txt';

    $output = $fileManager->close($fileName);

    expect($output)->toBe("Closing local file: {$fileName}\n");
});

it('opens a cloud file', function () {
    $fileManager = new FileManager('CloudStorage');
    $fileName = 'example.txt';

    $output = $fileManager->open($fileName);

    expect($output)->toBe(
        "Connecting to cloud storage...\n" .
        "Opening cloud file: {$fileName}\n"
    );
});

it('saves a cloud file', function () {
    $fileManager = new FileManager('CloudStorage');
    $fileName = 'example.txt';

    ob_start();
    $fileManager->save($fileName);
    $output = ob_get_clean();

    expect($output)->toBe("Saving data to cloud file: {$fileName}\n");
});

it('closes a cloud file', function () {
    $fileManager = new FileManager('CloudStorage');
    $fileName = 'example.txt';

    $output = $fileManager->close($fileName);

    expect($output)->toBe("Closing connection to cloud storage for file: {$fileName}\n");
});

it('returns null for unsupported storage type', function () {
    $fileManager = new FileManager('UnsupportedStorage');
    $fileName = 'example.txt';

    $openOutput = $fileManager->open($fileName);
    $saveOutput = $fileManager->save($fileName);
    $closeOutput = $fileManager->close($fileName);

    expect($openOutput)->toBeNull();
    expect($saveOutput)->toBeNull();
    expect($closeOutput)->toBeNull();
});


