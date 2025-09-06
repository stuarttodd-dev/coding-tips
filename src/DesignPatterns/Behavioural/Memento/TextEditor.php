<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento;

class TextEditor
{
    private string $text = '';

    public function type(string $words): void
    {
        $this->text .= $words;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function save(): TextMemento
    {
        return new TextMemento($this->text);
    }

    public function restore(?TextMemento $memento): void
    {
        if (!$memento instanceof \HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Memento\TextMemento) {
            $this->text = '';
            return;
        }

        $this->text = $memento->getText();
    }
}
