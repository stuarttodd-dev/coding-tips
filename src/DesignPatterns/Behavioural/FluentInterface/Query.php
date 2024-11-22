<?php

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\FluentInterface;

class Query
{
    private string $query = '';

    public function select(string $columns): self
    {
        $this->query .= "SELECT {$columns} ";
        return $this;
    }

    public function from(string $table): self
    {
        $this->query .= "FROM {$table} ";
        return $this;
    }

    public function where(string $condition): self
    {
        $this->query .= "WHERE {$condition} ";
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->query .= "ORDER BY {$column} {$direction} ";
        return $this;
    }

    public function getQuery(): string
    {
        return trim($this->query);
    }
}
