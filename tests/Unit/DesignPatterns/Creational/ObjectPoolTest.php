<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Creational\ObjectPool\ObjectPool;

class DummyClass {}

it('throws an exception if the class does not exist', function (): void {
    new ObjectPool('NonExistentClass');
})->throws(InvalidArgumentException::class, 'Class NonExistentClass does not exist.');

it('can acquire an object from the pool', function (): void {
    $pool = new ObjectPool(DummyClass::class);

    $object = $pool->acquire();

    expect($object)->toBeInstanceOf(DummyClass::class);
    expect($pool->getCountAvailable())->toBe(0);
    expect($pool->getCountInUse())->toBe(1);
});

it('releases an object back into the pool', function (): void {
    $pool = new ObjectPool(DummyClass::class);

    $object = $pool->acquire();
    $pool->release($object);

    expect($pool->getCountAvailable())->toBe(1);
    expect($pool->getCountInUse())->toBe(0);
});

it('can reuse objects from the pool', function (): void {
    $pool = new ObjectPool(DummyClass::class);

    $object1 = $pool->acquire();
    $pool->release($object1);

    $object2 = $pool->acquire();

    expect($object1)->toBe($object2);
    expect($pool->getCountAvailable())->toBe(0);
    expect($pool->getCountInUse())->toBe(1);
});

it('creates new objects when none are available in the pool', function (): void {
    $pool = new ObjectPool(DummyClass::class);

    expect($pool->getCountAvailable())->toBe(0);
    expect($pool->getCountInUse())->toBe(0);

    $object1 = $pool->acquire();
    $pool->release($object1);

    expect($pool->getCountAvailable())->toBe(1);
    expect($pool->getCountInUse())->toBe(0);
});
