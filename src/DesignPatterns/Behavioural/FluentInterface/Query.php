<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface;

class Query
{
    private string $query = '';

    public function select(string $columns): self
    {
        $this->query .= sprintf('SELECT %s ', $columns);
        return $this;
    }

    public function from(string $table): self
    {
        $this->query .= sprintf('FROM %s ', $table);
        return $this;
    }

    public function where(string $condition): self
    {
        $this->query .= sprintf('WHERE %s ', $condition);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->query .= sprintf('ORDER BY %s %s ', $column, $direction);
        return $this;
    }

    public function getQuery(): string
    {
        return trim($this->query);
    }
}
