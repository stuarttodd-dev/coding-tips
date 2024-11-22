<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface;

class Car
{
    private array $attributes = [];

    public function setColor(string $color): self
    {
        $this->attributes['color'] = $color;
        return $this;
    }

    public function setEngine(string $engine): self
    {
        $this->attributes['engine'] = $engine;
        return $this;
    }

    public function addFeature(string $feature): self
    {
        $this->attributes['features'][] = $feature;
        return $this;
    }

    public function getConfiguration(): array
    {
        return $this->attributes;
    }
}