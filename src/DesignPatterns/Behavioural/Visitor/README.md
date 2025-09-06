# Visitor Pattern
This project demonstrates the use of the Visitor Pattern to perform operations on different entities, such as counting pages or words in documents and books. It includes implementations of multiple visitors, each encapsulating a specific operation.

## Directory Structure

```  
└── src  
    └── DesignPatterns  
        └── Behavioural  
            └── Visitor  
                ├── Book.php  
                ├── Chapter.php  
                ├── Document.php  
                ├── PageCountVisitor.php  
                ├── WordCountVisitor.php  
                └── Interfaces  
                    └── VisitableInterface.php  
                    └── VisitorInterface.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── VisitorTest.php  
```

### Files Overview
- **Book.php**: Represents a book with chapters. Implements VisitableInterface.
- **Chapter.php**: Represents a chapter of a book with pages and content.
- **Document.php**: Represents a document with pages and content. Implements VisitableInterface.
- **PageCountVisitor.php**: Counts the total number of pages in a book or document.
- **WordCountVisitor.php**: Counts the total number of words in a book or document.
- **Interfaces/VisitorInterface.php**: Ensures visitor classes implement methods for all visitable entities.
- **Interfaces/VisitableInterface.php**: Ensures entities implement the accept() method for visitors.
- **tests/Unit/DesignPatterns/Behavioural/VisitorTest.php**: Contains tests that validate page and word count operations.

## Running Tests

You can execute the tests using the following command:
```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/VisitorTest.php 
```

## Advantages
- **Separation of Concerns**: Each visitor handles a specific functionality, keeping entities like Book and Document clean.
- **Open/Closed Principle**: You can add new operations by creating a new visitor without modifying existing entities.
- **Consistency Across Entities**: Each visitor defines how it handles all entities, avoiding duplicated logic.
- **Avoids Type Checking**: Eliminates the need for instanceof checks since double dispatch ensures the correct method is called.
- **Ease of Extension**: Adding a new visitor for another operation, like exporting content to PDF, does not require changes to the entities.

```php
$book = new Book([
    new Chapter(5, 'some text'),
    new Chapter(7, 'some more text'),
    new Chapter(2, 'even more text'),
]);
$document = new Document(20, 'Hello world');

$visitors = [
    new PageCountVisitor(),
    new WordCountVisitor(),
];

foreach ($visitors as $visitor) {
    $book->accept($visitor);
    echo "Book result: {$visitor->count}" . PHP_EOL;

    $document->accept($visitor);
    echo "Document result: {$visitor->count}" . PHP_EOL;
}
```

## Disadvantages
- **Tightly Coupled to Entity Structure**: Adding a new entity requires updating every visitor interface and visitor class.
- **Overkill for Simple Use Cases**: For a single operation or small project, a visitor may add unnecessary complexity.
- **Can Break Encapsulation**: Visitors often need access to internal data, which might require exposing getters or internal state.
- **State Management**: Visitors often store results internally ($count), which may not be ideal in some contexts.

## Code Example
```php
class PageCountVisitor implements VisitorInterface
{
    public int $count = 0;

    public function visitBook(Book $book): void
    {
        $this->count = 0;
        foreach ($book->getChapters() as $chapter) {
            $this->count += $chapter->getPageCount();
        }
    }

    public function visitDocument(Document $document): void
    {
        $this->count = $document->getPageCount();
    }
}

class WordCountVisitor implements VisitorInterface
{
    public int $count = 0;

    public function visitBook(Book $book): void
    {
        $this->count = 0;
        foreach ($book->getChapters() as $chapter) {
            $this->count += str_word_count($chapter->getContent());
        }
    }

    public function visitDocument(Document $document): void
    {
        $this->count = str_word_count($document->getContent());
    }
}
```

## Key Takeaways
The Visitor pattern is perfect when you have:
- Multiple entities with stable structure.
- Multiple operations that need to be performed across entities.
- A desire to keep entity classes clean and focused.

If you constantly find yourself writing `instanceof` checks or bloating entities with unrelated methods, the Visitor pattern is a clean, maintainable solution.