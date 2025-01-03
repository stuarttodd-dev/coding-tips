<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DSA;

class ArrayDemo
{
    /**
     * @return int[]
     */
    public function createArray(): array
    {
        return [1, 2, 3, 4, 5];
    }

    /**
     * @param int[] $array
     */
    public function getElement(array $array, int $index): ?int
    {
        return $array[$index] ?? null;
    }

    /**
     * @param int[] $array
     * @return int[]
     */
    public function insertElement(array &$array, int $index, int $value): array
    {
        array_splice($array, $index, 0, [$value]);
        return $array;
    }

    /**
     * @param int[] $array
     * @return int[]
     */
    public function deleteElement(array &$array, int $index): array
    {
        if (array_key_exists($index, $array)) {
            unset($array[$index]);
            $array = array_values($array);
        }
        return $array;
    }
}
