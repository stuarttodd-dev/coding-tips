<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DSA\ArrayExample\Demo;

it('creates an array', function (): void {
    $arrayDemo = new Demo();
    $array = $arrayDemo->createArray();

    expect($array)->toBe([1, 2, 3, 4, 5]);
});

it('retrieves an element from the array', function (): void {
    $arrayDemo = new Demo();
    $array = $arrayDemo->createArray();

    expect($arrayDemo->getElement($array, 2))->toBe(3);
    expect($arrayDemo->getElement($array, 10))->toBeNull();
});

it('inserts an element into the array', function (): void {
    $arrayDemo = new Demo();
    $array = $arrayDemo->createArray();

    $arrayDemo->insertElement($array, 2, 99);

    expect($array)->toBe([1, 2, 99, 3, 4, 5]);
});

it('deletes an element from the array', function (): void {
    $arrayDemo = new Demo();
    $array = $arrayDemo->createArray();

    $arrayDemo->deleteElement($array, 2);

    expect($array)->toBe([1, 2, 4, 5]);
});

it('handles deletion with a non-existent index gracefully', function (): void {
    $arrayDemo = new Demo();
    $array = $arrayDemo->createArray();

    $arrayDemo->deleteElement($array, 10);

    expect($array)->toBe([1, 2, 3, 4, 5]);
});