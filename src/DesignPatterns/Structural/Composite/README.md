# Composite Pattern
The _Composite Pattern_ is a structural design pattern that allows you to compose objects into tree-like structures to represent part-whole hierarchies. It treats individual objects and compositions of objects uniformly, enabling clients to treat single objects and compositions of objects the same way.

In simpler terms:

- You have a collection of objects that are either individual components or compositions of components.
- You can treat both the individual objects and composite objects in the same way, allowing you to manage complex tree-like structures.

Components are categorised into two types:
- **Leaf**: A component that doesn't have children. It's an end node in the tree structure. In our example, a `File` is a leaf — it can't contain anything.
- **Composite**: A component that can have children, which can be either other composites or leaves. In our example, a `Folder` is a composite — it can contain files and other folders.

The brilliance of the pattern is that both leaf and composite implement the same interface, so they can be treated the same.

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
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Structural  
                └── Composite  
                    └── CompositeTest.php  
```

### Files Overview
- **Components/File.php**: The `File` class represents a leaf component in the composition. It is a basic file with no child components. It has its own specific behaviour, like calculating size or displaying content.
- **Components/Folder.php**: The `Folder` class represents a composite component. It can contain other `File` or `Folder` objects (children). It allows for adding/removing child components and delegates behaviour to its children, such as calculating the total size of all its contents.
- **Components/Item.php**: The `Item` interface defines common behaviour for both files and folders. Both `File` and `Folder` implement this interface, allowing them to be treated uniformly.
- **tests/Unit/DesignPatterns/Structural/CompositeTest.php**: Unit tests for the above classes, testing the behaviour of individual files, folders, and composite operations.

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
    public function getName(): string;
    public function find(string $name): ?Item;
    public function list(int $depth = 0): void;
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

    public function find(string $name): ?Item
    {
        return $this->name === $name ? $this : null;
    }
    
    public function list(int $depth = 0): void
    {
        echo str_repeat("  ", $depth) . "- " . $this->name . " (" . $this->size . " KB)\n";
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

    public function find(string $name): ?Item
    {
        if ($this->name === $name) {
            return $this;
        }

        foreach ($this->items as $item) {
            $found = $item->find($name);
            if ($found !== null) {
                return $found;
            }
        }

        return null;
    }
    
    public function list(int $depth = 0): void
    {
        echo str_repeat("  ", $depth) . "+ " . $this->name . " (" . $this->getSize() . " KB)\n";
        foreach ($this->items as $item) {
            $item->list($depth + 1);
        }
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
$file5 = new File("logo.png", 50);

// Create subfolders
$imgFolder = new Folder("images");
$imgFolder->addItem($file5);

// Create higher-level folders
$folder1 = new Folder("assets");
$folder1->addItem($file1);
$folder1->addItem($file2);
$folder1->addItem($imgFolder); // nested folder

$folder2 = new Folder("src");
$folder2->addItem($file3);
$folder2->addItem($file4);

// Create root folder
$root = new Folder("project");
$root->addItem($folder1);
$root->addItem($folder2);

// Print total size
echo "Total Project Size: " . $root->getSize() . " KB\n";

// Search for a file
$foundItem = $root->find("logo.png");

if ($foundItem) {
    echo "Found: " . $foundItem->getName() . " (" . $foundItem->getSize() . " KB)\n";
} else {
    echo "File not found.\n";
}

// Print directory structure
echo "\nProject Structure:\n";
$root->list();
```

You can now add new payment gateways without modifying the `PaymentService` class.

### Advantages
- **Uniform Treatment**: Treats both files and folders uniformly through the shared Item interface, simplifying logic.
- **Flexibility**: Easily add new file or folder types (e.g., symbolic links, compressed folders) without modifying existing logic.
- **Extensibility**: New behaviours (like calculating size, listing contents, or permissions) can be added to files or folders independently without changing the core structure.

### Disadvantages
- **Complexity**: Overusing nested folders or deeply recursive structures can lead to a more complex system than necessary.
- **Harder to Understand**: Tracing and debugging deeply nested folder structures may be difficult in large-scale file systems.
