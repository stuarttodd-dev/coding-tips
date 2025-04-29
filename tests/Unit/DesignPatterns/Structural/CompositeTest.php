<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components\File;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components\Folder;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Composite\Components\Item;

it('ensures File implements Item interface', function (): void {
    $file = new File("example.php", 20);
    expect($file)->toBeInstanceOf(Item::class);
});

it('ensures Folder implements Item interface', function (): void {
    $folder = new Folder("my_folder");
    expect($folder)->toBeInstanceOf(Item::class);
});

it('calculates the size of a single file', function (): void {
    $file = new File("example.php", 20);
    expect($file->getSize())->toBe(20.0); // The size of the file is 20 KB
});

it('calculates the size of a folder with files', function (): void {
    $file1 = new File("index.php", 15);
    $file2 = new File("style.css", 10);
    $folder = new Folder("assets");

    $folder->addItem($file1);
    $folder->addItem($file2);

    expect($folder->getSize())->toBe(25.0); // Total size of folder is 15 + 10
});

it('calculates the size of a nested folder structure', function (): void {
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

    expect($rootFolder->getSize())->toBe(55.0); // Total size: 15 + 10 + 25 + 5 + 25
});

it('calculates the size of an empty folder', function (): void {
    $folder = new Folder("empty_folder");
    expect($folder->getSize())->toBe(0.0); // No items, so size is 0
});

it('finds a file inside a folder', function (): void {
    $file = new File("logo.png", 50);
    $folder = new Folder("images");
    $folder->addItem($file);

    expect($folder->find("logo.png"))->toBe($file);
});

it('finds a nested file in a folder tree', function (): void {
    $file = new File("logo.png", 50);
    $images = new Folder("images");
    $images->addItem($file);

    $assets = new Folder("assets");
    $assets->addItem($images);

    $project = new Folder("project");
    $project->addItem($assets);

    expect($project->find("logo.png"))->toBe($file);
});

it('returns null when item is not found', function (): void {
    $file = new File("logo.png", 50);
    $folder = new Folder("images");
    $folder->addItem($file);

    expect($folder->find("missing.png"))->toBeNull();
});

it('lists a single file', function (): void {
    $file = new File("logo.png", 50);

    ob_start();
    $file->list();
    $output = ob_get_clean();

    expect($output)->toBe("- logo.png (50 KB)\n");
});

it('lists a folder with nested files', function (): void {
    $file1 = new File("logo.png", 50);
    $file2 = new File("style.css", 10);

    $folder = new Folder("assets");
    $folder->addItem($file1);
    $folder->addItem($file2);

    ob_start();
    $folder->list();
    $output = ob_get_clean();

    expect($output)->toBe(
        "+ assets (60 KB)\n" .
        "  - logo.png (50 KB)\n" .
        "  - style.css (10 KB)\n"
    );
});

it('lists a deeply nested folder tree', function (): void {
    $file1 = new File("index.php", 15);
    $file2 = new File("style.css", 10);
    $file3 = new File("script.js", 25);
    $file4 = new File("readme.txt", 5);

    $assets = new Folder("assets");
    $assets->addItem($file1);
    $assets->addItem($file2);

    $src = new Folder("src");
    $src->addItem($file3);
    $src->addItem($file4);

    $project = new Folder("project");
    $project->addItem($assets);
    $project->addItem($src);

    ob_start();
    $project->list();
    $output = ob_get_clean();

    expect($output)->toBe(
        "+ project (55 KB)\n" .
        "  + assets (25 KB)\n" .
        "    - index.php (15 KB)\n" .
        "    - style.css (10 KB)\n" .
        "  + src (30 KB)\n" .
        "    - script.js (25 KB)\n" .
        "    - readme.txt (5 KB)\n"
    );
});
