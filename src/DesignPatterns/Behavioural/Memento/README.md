# Memento Pattern
This project demonstrates the use of the Memento Pattern to implement undo functionality in a text editor. It includes a `TextEditor` (Originator), `TextMemento` (Memento), and `History` (Caretaker).

## Directory Structure

```  
└── src  
    └── DesignPatterns  
        └── Behavioural  
            └── Memento  
                ├── History.php  
                ├── TextEditor.php  
                ├── TextMemento.php   
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── MementoTest.php  
```

### Files Overview
- **History.php**: Caretaker that manages a stack of `TextMemento` objects.
- **TextEditor.php**: Originator that creates and restores mementos of its state.
- **TextMemento.php**: Snapshot object that stores the editor’s state.
- **tests/Unit/DesignPatterns/Behavioural/MementoTest.php**: Unit tests validating save/restore behaviour.

## Running Tests

You can execute the tests using the following command:
```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/MementoTest.php 
```

## Advantages
- Provides undo/redo functionality without exposing internal details.
- Separates state management from business logic.
- Makes it easy to implement rollback or save points.

## Code Example
```php
<?php

// Memento
class TextMemento
{
    public function __construct(
        private readonly string $text
    ) {}

    public function getText(): string
    {
        return $this->text;
    }
}

// Originator
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

    public function restore(TextMemento $memento): void
    {
        $this->text = $memento->getText();
    }
}

// Caretaker
class History
{
    /** @var TextMemento[] */
    private array $mementos = [];

    public function push(TextMemento $memento): void
    {
        $this->mementos[] = $memento;
    }

    public function pop(): ?TextMemento
    {
        return array_pop($this->mementos);
    }
}

// Client code
$editor = new TextEditor();
$history = new History();

$editor->type("Hello ");
$history->push($editor->save());

$editor->type("World!");
$history->push($editor->save());

echo $editor->getText(); // Hello World!

// Undo
$editor->restore($history->pop());
echo "\nUndo: " . $editor->getText(); // Hello 

// Undo again
$editor->restore($history->pop());
echo "\nUndo again: " . $editor->getText(); // (empty string)
```

## Disadvantages
- Can be memory heavy if many snapshots are stored.
- Might introduce performance issues if the state is large.
- Requires discipline to avoid exposing or misusing the Memento.

## Key Takeaways
- Use Memento when you need undo/rollback functionality.
- Keep Memento objects immutable.
- Be mindful of memory consumption with large histories.
