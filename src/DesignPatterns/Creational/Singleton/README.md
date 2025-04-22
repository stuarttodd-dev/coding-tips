# Singleton Pattern
The **Singleton Pattern** is a Creational design pattern that ensures a class has only one instance and provides a global point of access to it. 

It's often used when exactly one object is needed to coordinate actions across a system—like a configuration manager, logger, or connection pool.

## When to Use
- You want to control access to shared resources (e.g., file system, DB connection).
- There should only ever be one instance of a class.
- You need lazy initialisation of expensive objects.
- You want to share state across the system in a controlled way.

## When NOT to Use
- When unit testing is important - singletons can introduce hidden state.
- In cases where dependency injection is preferred.
- When the app requires multiple instances (e.g., multi-tenant logic).
- If you want to avoid global state or tight coupling.

## Real-World Examples
- Database connection handler.
- Logging class.
- Configuration manager.
- Caching layer (e.g., in-memory cache).

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Creational   
            └── Singleton  
                └── Logger.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Singleton  
                └── SingletonTest.php  
```

## Implementation Example
Lets build one...

### Step 1: Create the Singleton class
```php
class Logger
{
    private static ?Logger $instance = null;

    private function __construct()
    {
        // private to prevent direct instantiation
    }

    public static function getInstance(): Logger
    {
        if (self::$instance === null) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    public function log(string $message): void
    {
        echo "[LOG] " . $message . PHP_EOL;
    }
}
```

### Step 2: Usage Example
```php
$logger = Logger::getInstance();
$logger->log('Singleton pattern in action!');

$anotherLogger = Logger::getInstance();
var_dump($logger === $anotherLogger); // true
```

### Files Overview
- **Logger.php**: The singleton implementation.
- **SingletonTest.php**: Ensures only one instance exists and behaviour is as expected.

### Advantages
- Controlled access to a single instance.
- Lazy-loaded.
- Prevents accidental duplication.
- Simple to implement and use.

### Disadvantages
- Global state can introduce hidden dependencies
- Harder to test (no dependency injection)
- Can lead to tight coupling
- Not thread-safe without extra work in some environments

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Creational/SingletonTest.php 
```