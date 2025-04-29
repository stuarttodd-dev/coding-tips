# Composite Pattern
The _Composite Pattern_ is a structural design pattern that allows you to compose objects into tree-like structures to represent part-whole hierarchies. It treats individual objects and compositions of objects uniformly, enabling clients to treat single objects and compositions of objects the same way.
In simpler terms:

- You have a collection of objects that are either individual components or compositions of components.
- You can treat both the individual objects and composite objects in the same way, allowing you to manage complex tree-like structures.

## Directory Structure
Here’s the full directory structure for our Composite Pattern example:

```
└── src  
    └── DesignPatterns  
        └── Structural   
            └── Composite  
                └── Components  
                    └── File.php  
                    └── Folder.php  
                    └── Item.php  
                └── Client.php  
                └── FileSystem.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Composite  
                └── CompositeTest.php  
```

### Files Overview
- **Components/File.php**: The `File` class represents a leaf component in the composition. It is a basic file with no child components. It has its own specific behavior, like calculating size or displaying content.
- **Components/Folder.php**: The `Folder` class represents a composite component. It can contain other `File` or `Folder` objects (children). It allows for adding/removing child components and delegates behavior to its children, such as calculating the total size of all its contents.
- **Components/Item.php**: The `Item` interface defines common behavior for both files and folders. Both `File` and `Folder` implement this interface, allowing them to be treated uniformly.
- **FileSystem.php**: The `FileSystem` class is responsible for managing the entire collection of items (files and folders). It can iterate over the items and perform operations like calculating total size, listing files, or managing the structure.
- **Client.php**: The `Client` class demonstrates how to use the FileSystem and interact with both files and folders, treating them uniformly.
- **tests/Unit/DesignPatterns/Structural/CompositeTest.php**: Unit tests for the above classes, testing the behavior of individual files, folders, and composite operations.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Structural/CompositeTest.php 
```

## The Problem It Solves
Imagine you're building a file system manager that supports both individual files and folders. You have individual files like text files and images, but you also need to handle composite folders that can contain multiple files and even other folders.

Here's how you'd normally approach it (bad example):

```php
function calculateSize($item)
{
    if ($item instanceof File) {
        return $item->getSize(); // For File, return the file's size
    } elseif ($item instanceof Folder) {
        $totalSize = 0;
        foreach ($item->getItems() as $subItem) {
            $totalSize += calculateSize($subItem); // Recursively calculate the size of the folder's contents
        }
        return $totalSize; // Return total size of the folder
    }
}
```

### Why This Is Bad?
- **Hard-Coded Logic**: The `calculateSize` function explicitly checks each type of item (`File`, `Folder`), making it difficult to add new types or change behaviour without modifying the function.
- **Violation of Open/Closed Principle**: Every time you introduce a new type of item (e.g., a new type of file or custom folder), you have to modify the `calculateSize` function.
- **Difficult to Manage Nested Structures**: Handling nested folder structures becomes more complex as you add more types of items or items that behave differently.

## The Solution
The Composite Pattern fixes this problem by:

- Defining a common interface (`Item`) for both individual files and composite folders.
- Using `Leaf` objects for individual files (e.g., `File`), and `Composite` objects for folders that can contain other files or folders.
- Treating both individual files and folders uniformly by interacting with them through the common `Item` interface, so no special logic is required when dealing with files, folders, or their nested structures.

```php
interface Item
{
    public function getSize(): float;
}

class File implements Item
{
    public function __construct(private string $name, private float $size)
    {
        //
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class Folder implements Item
{
    private array $items = [];

    public function __construct(private string $name)
    {
        //
    }

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getSize(): float
    {
        $totalSize = 0;
        foreach ($this->items as $item) {
            $totalSize += $item->getSize();
        }
        return $totalSize;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
```

### Implementation
Here’s how you'd use it:

```php
// Create files
$file1 = new File("index.php", 15);
$file2 = new File("style.css", 10);
$file3 = new File("script.js", 25);
$file4 = new File("readme.txt", 5);

// Create folders
$folder1 = new Folder("assets");
$folder2 = new Folder("src");

// Add files to folders
$folder1->addItem($file1);
$folder1->addItem($file2);
$folder2->addItem($file3);
$folder2->addItem($file4);

// Create a root folder
$rootFolder = new Folder("project");
$rootFolder->addItem($folder1);
$rootFolder->addItem($folder2);

// Calculate total size of the project
echo "Total Size of Project: " . $rootFolder->getSize() . " KB\n"; // Outputs the total size of the entire project
```

You can now add new payment gateways without modifying the `PaymentService` class.

### Advantages
- **Uniform Treatment**: Treats both files and folders uniformly through the shared Item interface, simplifying logic.
- **Flexibility**: Easily add new file or folder types (e.g., symbolic links, compressed folders) without modifying existing logic.
- **Extensibility**: New behaviours (like calculating size, listing contents, or permissions) can be added to files or folders independently without changing the core structure.

### Disadvantages
- **Complexity**: Overusing nested folders or deeply recursive structures can lead to a more complex system than necessary.
- **Harder to Understand**: Tracing and debugging deeply nested folder structures may be difficult in large-scale file systems.
