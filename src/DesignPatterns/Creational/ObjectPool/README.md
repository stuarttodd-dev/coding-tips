# Object Pool Pattern
This project demonstrates the Object Pool Pattern in PHP by implementing a payment gateway system.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Creational   
            └── ObjectPool  
                ├── Resources
                    ├── DatabaseConnection.php   
                    ├── FileHandler.php   
                └── ObjectPool.php
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Creational  
                └── ObjectPoolTest.php  
```

### Files Overview
- **Resources/DatabaseConnection.php**: description
- **Resources/FileHandler.php**: description
- **ObjectPool.php**: description
- **tests/Unit/DesignPatterns/Creational/ObjectPoolTest.php**: description

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Creational/ObjectPoolTest.php 
```

## Object Pool Pattern
The Object Pool pattern is a Creational design pattern that allows for the reuse of objects from a pool instead of creating new ones every time they are needed, which can help improve performance, especially when creating objects is resource-intensive.

### Reusable Objects
First, we need a set of reusable objects, here’s some quick examples, a `DatabaseConnection` and a `FileHandler` class.

```php
class DatabaseConnection {
    public function connect(): void {
        // Connect to DB
    }

    public function disconnect(): void {
        // Disconnect from DB
    }
}

class FileHandler {
    private resource|false $file;

    public function open(string $filename, string $mode) {
        // Open File
    }

    public function close(): void {
        // Close File
    }
}
```

### Object Pool Class
This manages the pool of objects.

```php
class ObjectPool
{
    private array $available = [];
    private array $inUse = [];

    public function __construct(private string $objectType)
    {
        if (!class_exists($objectType)) {
            throw new InvalidArgumentException("Class $objectType does not exist.");
        }
    }

    public function acquire(): object
    {
        if (empty($this->available)) {
            $object = new $this->objectType();
        } else {
            $object = array_pop($this->available);
        }

        $this->inUse[spl_object_id($object)] = $object;
        return $object;
    }

    public function release(object $object): void
    {
        $objectId = spl_object_id($object);

        if (isset($this->inUse[$objectId])) {
            unset($this->inUse[$objectId]);
            $this->available[$objectId] = $object;
        }
    }

    public function getCountAvailable(): int
    {
        return count($this->available);
    }

    public function getCountInUse(): int
    {
        return count($this->inUse);
    }
}
```

Let’s down this class down.

- **available**: Stores unused instances.
- **inUse**: Tracks currently used instances.
- **acquire()**: Provides an object from the pool or creates a new one if none are available.
- **release()**: Returns an object to the pool for reuse.

Let’s see it in action.

```php
// Database Connect Example
$dbPool = new ObjectPool(DatabaseConnection::class);
$db1 = $dbPool->acquire(); // Creates new object.
$db1->connect();
$dbPool->release($db1);

$db2 = $dbPool->acquire(); // Uses existing object.
$db2->connect();
$dbPool->release($db2);

// File Handler Example
$filePool = new ObjectPool(FileHandler::class);
$file1 = $filePool->acquire();
$file1->open('example.txt');
$filePool->release($file1);
```