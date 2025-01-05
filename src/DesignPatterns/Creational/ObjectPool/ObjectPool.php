<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Creational\ObjectPool;

use InvalidArgumentException;

class ObjectPool
{
    /**
     * @var array<int, object>
     */
    private array $available = [];

    /**
     * @var array<int, object>
     */
    private array $inUse = [];

    public function __construct(private readonly string $objectType)
    {
        if (!class_exists($objectType)) {
            throw new InvalidArgumentException(sprintf('Class %s does not exist.', $objectType));
        }
    }

    public function acquire(): object
    {
        $object = $this->available === [] ? new $this->objectType() : array_pop($this->available);

        $this->inUse[spl_object_id($object)] = $object;
        return $object;
    }

    public function release(object $object): void
    {
        $objectId = spl_object_id($object);

        if (isset($this->inUse[$objectId])) {
            unset($this->inUse[$objectId]);
            $this->available[$objectId] = $object;
        }
    }

    public function getCountAvailable(): int
    {
        return count($this->available);
    }

    public function getCountInUse(): int
    {
        return count($this->inUse);
    }
}
