<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface;

class Calculator
{
    private float $result = 0;

    public function add(float $value): self
    {
        $this->result += $value;
        return $this;
    }

    public function subtract(float $value): self
    {
        $this->result -= $value;
        return $this;
    }

    public function multiply(float $value): self
    {
        $this->result *= $value;
        return $this;
    }

    public function divide(float $value): self
    {
        if ($value === 0) {
            throw new \InvalidArgumentException("Division by zero.");
        }
        $this->result /= $value;
        return $this;
    }

    public function getResult(): float
    {
        return $this->result;
    }
}
