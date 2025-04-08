# Bridge Pattern
The Bridge Pattern is a structural design pattern that separates the abstraction from its implementation, allowing the two to evolve independently.
By using the Bridge, you can decouple abstraction from the details, making the system more flexible and maintainable.

## When to Use
Use the Bridge Pattern when:
- You have a hierarchy of classes with multiple variations of both abstraction and implementation.
- You want to allow the abstraction and the implementation to vary independently.
- You want to decouple the client code from specific implementations or details.

## Real-World Examples

### 1. **Graphics Systems**
- A graphical drawing system where the shapes (like circles, rectangles) are independent of the rendering mechanism (e.g., vector vs raster).

### 2. **Device Control**
- If you have devices like TVs, Radios, and other electronics, the remote control interface might be independent of the type of device.

### 3. **Database Access Layers**
- A data access layer where different types of databases (MySQL, PostgreSQL) can have different query implementations, but the abstraction remains the same.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Structural   
            └── Bridge  
                └── OriginalCode
                    └── MySQLService.php  
                    └── PostgreSQLService.php  
                └── Implementations  
                    └── MySQLDatabase.php 
                    └── PostgreSQLDatabase.php 
                └── DatabaseInterface.php 
                └── DatabaseManager.php 
                └── DatabaseService.php 
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Structural  
                └── BridgeTest.php  
```

## Implementation Example
The Bridge Pattern helps separate the abstraction (e.g., user management) from the implementation (e.g., MySQL or PostgreSQL). Here's a breakdown of how the pattern works:

### Step 1: Create an Interface for Database Operations
```php
interface DatabaseInterface
{
    public function connect(): string;
    public function getUser(int $id): string;
}
```

### Step 2: Concrete Implementations of the Database Interface
```php
class MySQLDatabase implements DatabaseInterface
{
    public function connect(): string
    {
        return "Connecting to MySQL database.";
    }

    public function getUser(int $id): string
    {
        return "Fetching user from MySQL with ID: {$id}";
    }
}

class PostgreSQLDatabase implements DatabaseInterface
{
    public function connect(): string
    {
        return "Connecting to PostgreSQL database.";
    }

    public function getUser(int $id): string
    {
        return "Fetching user from PostgreSQL with ID: {$id}";
    }
}
```

### Step 3: Create the Abstraction
```php
abstract class DatabaseManager
{
    public function __construct(protected DatabaseInterface $database)
    {
    
    }

    abstract public function connect(): string;
    abstract public function getUser(int $id): string;
}
```

### Step 4: Concrete Class that Extends the Abstraction
```php
class DatabaseService extends DatabaseManager
{
    public function connect(): string
    {
        return $this->database->connect();
    }

    public function getUser(int $id): string
    {
        return $this->database->getUser($id);
    }
}
```

### File Overview
- **OriginalCode/MySQLService.php**: Contains code tightly coupled to MySQL for user management, directly handling database operations.
- **OriginalCode/PostgreSQLService.php**: Contains code tightly coupled to PostgreSQL for user management, directly handling database operations.
- **Implementations/MySQLDatabase.php**: Defines concrete class for database system (MySQL).
- **Implementations/PostgreSQLDatabase.php**: Defines concrete class for database system (PostgreSQL).
- **DatabaseInterface.php**: Defines an interface for database systems (MySQL and PostgreSQL).
- **DatabaseManager.php**: The base class that delegates the actual database operations (connecting, fetching user) to the injected `DatabaseInterface` implementation.
- **DatabaseService.php**: Concrete class that extends `DatabaseManager` and provides implementation for the abstract methods. It interacts with the actual `DatabaseInterface` implementation.
- **tests/Unit/DesignPatterns/Structural/BridgeTest.php**: Contains Pest tests to verify that the Bridge pattern works as expected. It tests both database managers and ensures the correct interaction between the abstractions and concrete implementations.

### Advantages
- **Separation of Concerns**: Decouples abstraction from implementation, making each easier to change independently.
- **Flexibility**: Allows you to easily mix and match different abstractions and implementations.
- **Maintainability**: Changes in the implementation (e.g., database or file system) do not affect the abstraction layer.

### Disadvantages
- **Complexity**: Introduces additional layers, which may increase the system's complexity.
- **Too Many Classes**: Can result in an increase in the number of classes, leading to potential maintenance overhead.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Structural/BridgeTest.php 
```

## Bridge Pattern vs Strategy Pattern
While the Bridge Pattern and the Strategy Pattern are similar in that they both involve defining a set of algorithms or implementations and allowing them to be interchangeable, they are used in slightly different contexts:

### Strategy Pattern
The Strategy Pattern is focused on enabling the selection of an algorithm at runtime. In the Strategy pattern, you define different algorithms (or strategies) and allow the client to choose which one to use.

It is typically used when you have multiple variations of an algorithm, but the choice of which algorithm to use does not need to be separate from the object using the algorithm. For example, you might have a set of sorting strategies (e.g., quick sort, merge sort) and need to select one dynamically based on user input or a system condition.

### Bridge Pattern
The Bridge Pattern, on the other hand, is used to decouple an abstraction from its implementation so that both can vary independently. It is useful when you want to separate the "what" (abstraction) from the "how" (implementation) of a system.

In the case of the Bridge Pattern, the abstraction and the implementation are usually not interchangeable at runtime (though you can switch the implementation in some cases), but rather designed to allow for independent evolution of both parts. A real-world analogy might be the difference between "drawing a circle" (abstraction) and the "method of drawing a circle" (implementation, e.g., vector vs. raster).

### Key Differences:
Strategy focuses on making interchangeable strategies for a specific action or algorithm.

Bridge focuses on decoupling an abstraction from its implementation, allowing both to vary independently.

### In summary:
- Use `Strategy` when you want to switch algorithms dynamically.
- Use `Bridge` when you want to decouple an abstraction from its implementation, and allow both to evolve independently without affecting the client code.