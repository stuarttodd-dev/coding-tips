# Prototype Pattern
The **Prototype Pattern** is a creational design pattern used to create objects by copying an existing object rather than instantiating a new one from scratch. This is useful when object creation is expensive or when we need multiple instances of an object with slight variations.

Instead of using `new`, we clone an existing object. This allows us to create copies with minor modifications without affecting the original instance.

## When to Use
- When object creation is expensive in terms of performance or resources.
- When the initialisation of an object is complex.
- When we need many objects with similar properties, but minor differences.
- When subclassing leads to excessive inheritance complexity.
- When an object structure includes deep hierarchies, and we want to clone the entire object graph efficiently.

## Real-World Examples
- **Game Development**: Cloning enemy NPCs instead of creating new ones from scratch.
- **Document Editors**: Duplicating templates or sections of a document.
- **CMS (Content Management Systems)**: Cloning existing pages or blog posts to reuse content structures.
- **Database Record Duplication**: Creating copies of existing records for testing or versioning.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Creational   
            └── Prototype  
                └── Interfaces  
                    └── Prototype.php 
                └── Book.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Creational  
                └── PrototypeTest.php  
```

## Implementation Example
### Step 1: Define Interface
```php
interface Prototype
{
    public function clone(): Prototype;
}
```

### Step 2: Create a Concrete Prototype Class
```php
class Document implements Prototype
{
    public string $title;
    public string $content;
    public string $author;

    public function __construct(
        public string $title, 
        public string $content, 
        public string $author
    ) {
        //
    }

    public function clone(): Prototype
    {
        return clone $this;
    }
}
```
### Files Overview
- **Interfaces/Prototype.php**: This file defines the `Prototype` interface, which declares the `clone()` method. Any class implementing this interface must provide its own cloning mechanism.
- **Book.php**: This file contains the `Book` class, a concrete implementation of the `Prototype` interface. It includes properties like title and author and implements the `clone()` method to create a copy of the book object.
- **tests/Unit/DesignPatterns/Creational/PrototypeTest.php**: This file contains unit tests for the `Prototype` Pattern implementation. It ensures that cloned objects retain expected values while remaining independent from the original instances.

### Implementation

```php
// Create the original document
$originalDoc = new Document("Prototype Pattern", "This document explains the prototype pattern.", "John Doe");

// Clone the original document
$clonedDoc = $originalDoc->clone();

// Modify the cloned document
$clonedDoc->title = "Cloned: Prototype Pattern";
$clonedDoc->author = "Jane Doe";

// Original Document: Prototype Pattern by John Doe
echo "Original Document: {$originalDoc->title} by {$originalDoc->author}\n";

// Cloned Document: Cloned: Prototype Pattern by Jane Doe
echo "Cloned Document: {$clonedDoc->title} by {$clonedDoc->author}\n";
```

### Advantages
- **Performance Optimisation** – Cloning is faster than instantiating new objects, especially for expensive creations.
- **Encapsulation of Object Creation** – Clients don’t need to know how objects are constructed, just that they can be cloned.
- **Avoids Subclass Explosion** – Instead of creating multiple subclasses for variations, clone and modify a prototype dynamically.
- **Simplifies Complex Object Creation** – Objects with intricate setups can be cloned efficiently.

### Disadvantages
- **Deep Cloning Complexity** – If an object has nested objects, a shallow copy (clone) might not be sufficient, requiring manual deep copying.
- **Cloning Might Require Extra Handling** – Some objects contain references to external resources (e.g., file handlers, database connections) that shouldn’t be cloned.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Creational/PrototypeTest.php 
```