<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components\File;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components\Folder;

it('calculates the size of a single file', function () {
    $file = new File("example.php", 20);
    expect(calculateSize($file))->toBe(20); // The size of the file is 20 KB
});

it('calculates the size of a folder with files', function () {
    $file1 = new File("index.php", 15);
    $file2 = new File("style.css", 10);
    $folder = new Folder("assets");

    $folder->addItem($file1);
    $folder->addItem($file2);

    expect(calculateSize($folder))->toBe(25); // Total size of folder is 15 + 10
});

it('calculates the size of a nested folder structure', function () {
    $file1 = new File("index.php", 15);
    $file2 = new File("style.css", 10);
    $file3 = new File("script.js", 25);
    $file4 = new File("readme.txt", 5);

    $folder1 = new Folder("assets");
    $folder2 = new Folder("src");

    $folder1->addItem($file1);
    $folder1->addItem($file2);
    $folder2->addItem($file3);
    $folder2->addItem($file4);

    $rootFolder = new Folder("project");
    $rootFolder->addItem($folder1);
    $rootFolder->addItem($folder2);

    expect(calculateSize($rootFolder))->toBe(80); // Total size: 15 + 10 + 25 + 5 + 25
});

it('calculates the size of an empty folder', function () {
    $folder = new Folder("empty_folder");
    expect(calculateSize($folder))->toBe(0); // No items, so size is 0
});
