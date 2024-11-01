# Facade Pattern
The Facade Pattern is a structural design pattern that provides a simplified interface to a complex system of classes, libraries, or APIs. 
By using a Facade, you can hide the complexity of a subsystem and expose only what’s necessary to the client, making code cleaner and easier to maintain.

## When to Use
Use the Facade Pattern when:
- You want to provide a simple interface to a complex subsystem.
- You want to decouple client code from a complex system of classes.
- You’re working with a legacy system or third-party library that you want to shield with a cleaner, simpler interface.

## Real-World Examples

### 1. **Database Operations**
- Wrap multiple database CRUD operations in a single service to simplify how other components interact with the database.

### 2. **External APIs**
- Create a unified interface for interacting with multiple API endpoints, so your application can handle complex data sources more easily.

### 3. **Subsystem Management**
- Provide a single interface to handle interactions with subsystems like caching, logging, and authentication, reducing direct dependencies on these subsystems.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Structural   
            └── Facade  
                └── Subsystems  
                    └── PhaserService.php 
                    └── PowerService.php 
                    └── StabiliserService.php 
                    └── TargetingService.php   
                └── PhaserControl.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Structural  
                └── FacadeTest.php  
```

## Implementation Example
In this example, we’ll create a Facade that simplifies a complex series of actions into a single interface.

### Step 1: Define Subsystem Classes
```php
class PhaserService
{
    public function fire(): string
    {
        return "Phaser fired!";
    }
}

class PowerService
{
    public function initialise(): string
    {
        return "Power system online and ready.";
    }
}

class StabiliserService
{
    public function stabilise(): string
    {
        return "Ship stabilised.";
    }
}

class TargetingService
{
    public function lock(float $xCoordinate, float $yCoordinate): string
    {
        return "Target locked at coordinates {$xCoordinate}, {$yCoordinate}.";
    }
}
```

### Step 2: Create Facade
```php
class PhaserControl 
{
    protected PowerService $powerService;
    protected TargetinService $targetingService;
    protected StabiliserService $stabiliserSystem;
    protected PhaserService $phaserSystem;

    public function __construct() 
    {
        $this->powerService = new PowerService();
        $this->targetingService = new TargetingService();
        $this->stabiliserSystem = new StabiliserService();
        $this->phaserSystem = new PhaserService();
    }

    public function fire(float $xCoordinate, float $yCoordinate): string
    {
        return
            $this->powerService->initialise() . PHP_EOL .
            $this->targetService->lock($xCoordinate, $yCoordinate) . PHP_EOL .
            $this->stabiliserService->stabilizeShip() . PHP_EOL .
            $this->phaserService->fire() . PHP_EOL;
    }
}
```
### Files Overview
- **Subsystems/PhaserService.php, PowerService.php, StabiliserService.php, TargetingService.php**: These classes implement the individual subsystems for firing the phaser, each handling a specific aspect of the process, such as power management, targeting, and ship stabilisation.
- **PhaserControl.php**: The `Facade` class that coordinates the subsystems to simplify the phaser-firing process, providing a unified interface for controlling all necessary operations.
- **tests/Unit/DesignPatterns/Structural/FacadeTest.php**: Unit tests verifying the functionality of each subsystem and the Facade, ensuring the phaser system operates correctly as an integrated process.

### Implementation

```php
$phaserControl = new PhaserControl();
$result = $phaserControl->fire(1.5, 5.6);
```

### Advantages
- **Simplified Interface**: By using the `Facade`, interacting with multiple subsystems is made as simple as calling a single method, reducing complexity for client code and improving readability.
- **Decoupling**: The `Facade` hides the details of the subsystem implementations, which means client code does not need to depend directly on each subsystem. This makes the codebase more modular and easier to maintain or refactor.
- **Enhanced Maintainability**: Each subsystem focuses on a specific responsibility, so changes to individual components are less likely to impact the overall functionality, while updates can be made within subsystems without breaking the client-facing `Facade` interface.

### Disadvantages
- **Reduced Flexibility**: The `Facade` centralises control and simplifies functionality, but it can limit access to more granular subsystem methods. This might be restrictive if finer control over individual subsystems is required.
- **Risk of Monolithic Facade**: If too much functionality is added to the `Facade`, it can become overly complex, creating a new source of maintenance challenges. The `Facade` itself can grow into a monolithic component if not carefully managed, especially in larger code bases.
- **Less Transparency**: The `Facade` hides implementation details, which can make it harder for developers to understand or troubleshoot the inner workings of subsystems, especially when debugging complex interactions.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Structural/FacadeTest.php 
```