# Builder Pattern
The Builder Pattern is a creational design pattern used to simplify the construction of complex objects. It allows for the creation of objects in a step-by-step manner, which helps manage complexity and provides greater flexibility when dealing with objects that have numerous optional components. The Builder Pattern separates the construction logic from the actual object, making the code more modular and maintainable.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Creational   
            └── Builder  
                └── SmartHome.php
                └── SmartHomeBuilder.php
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Creational  
                └── BuilderTest.php  
```

### Files Overview
- **SmartHome.php**: Contains the `SmartHome` class, representing a complex smart home system with multiple configuration options.
- **SmartHomeBuilder.php**: The builder class responsible for constructing the `SmartHome` object step by step, with flexibility to add different features.
- **tests/Unit/DesignPatterns/Creational/BuilderTest.php**: Contains the unit tests to validate the correctness of the builder pattern implementation.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Creational/BuilderTest.php 
```

## Builder Pattern
The Builder Pattern helps in creating complex objects by separating the construction process from the actual object itself. Instead of passing all parameters through a constructor, which can lead to cumbersome and error-prone code, the Builder Pattern allows for the gradual construction of objects in a clear and understandable way. This makes it especially useful for objects that have many optional attributes or configurations.

### SmartHome Class
The `SmartHome` class represents a complex structure with multiple configurable features such as walls, roof, doors, smart devices, and more. The constructor takes multiple parameters, some of which are optional, and defines the state of the home. Here's how the class is structured:

```php
class SmartHome {
    public function __construct(
        public string $walls,
        public string $roof,
        public string $doors,
        public array $smartDevices,
        public bool $solarPanels = false,
        public ?string $securitySystem = null,
        public ?string $energyManagementSystem = null,
        public ?string $garageType = null,
        public ?string $poolType = null
    ) {}
}
```

### SmartHomeBuilder Class
The `SmartHomeBuilder` class provides a clean and flexible way to create instances of the SmartHome class. It uses methods to set each attribute of the smart home object, allowing the creation process to be customized as needed. It also ensures that the construction logic is kept separate from the business logic, making the code easier to maintain and update.

```php
class SmartHomeBuilder {
    private string $walls;
    private string $roof;
    private string $doors;
    private array $smartDevices = [];
    private bool $solarPanels = false;
    private ?string $securitySystem = null;
    private ?string $energyManagementSystem = null;
    private ?string $garageType = null;
    private ?string $poolType = null;
    private ?string $irrigationSystem = null;
    private ?string $voiceAssistant = null;
    private ?string $emergencyBackup = null;

    public function setWalls(string $walls): self {
        $this->walls = $walls;
        return $this;
    }

    public function setRoof(string $roof): self {
        $this->roof = $roof;
        return $this;
    }

    public function setDoors(string $doors): self {
        $this->doors = $doors;
        return $this;
    }

    public function addSmartDevice(string $device): self {
        $this->smartDevices[] = $device;
        return $this;
    }

    public function setSecuritySystem(string $system): self {
        $this->securitySystem = $system;
        return $this;
    }

    public function setEnergyManagementSystem(string $system): self {
        $this->energyManagementSystem = $system;
        return $this;
    }

    public function enableSolarPanels(): self {
        $this->solarPanels = true;
        return $this;
    }

    public function setGarageType(string $type): self {
        $this->garageType = $type;
        return $this;
    }

    public function setPoolType(string $type): self {
        $this->poolType = $type;
        return $this;
    }

    public function setIrrigationSystem(string $system): self {
        $this->irrigationSystem = $system;
        return $this;
    }

    public function setVoiceAssistant(string $assistant): self {
        $this->voiceAssistant = $assistant;
        return $this;
    }

    public function setEmergencyBackup(string $backup): self {
        $this->emergencyBackup = $backup;
        return $this;
    }

    public function build(): SmartHome {
        return new SmartHome(
            $this->walls,
            $this->roof,
            $this->doors,
            $this->smartDevices,
            $this->securitySystem,
            $this->energyManagementSystem,
            $this->solarPanels,
            $this->garageType,
            $this->poolType,
            $this->irrigationSystem,
            $this->voiceAssistant,
            $this->emergencyBackup
        );
    }
}
```

## Benefits of the Builder Pattern
- **Improved Readability**: Instead of dealing with a large constructor with numerous parameters, the builder allows for a step-by-step approach, making the code easier to read and understand.
- **Flexibility**: The builder provides flexibility to change or add features without modifying the object’s structure directly. You can easily adapt to different configurations of the same object.
- **Encapsulation**: The construction process is kept separate from the rest of the business logic, adhering to the Single Responsibility Principle.
- **Consistency**: By using the builder, you can ensure that objects are consistently created with the correct configurations, reducing the chance of errors and inconsistencies.

And finally, let’s see it in action.

```php
$builder = new SmartHomeBuilder();

$smartHome = $builder
    ->setWalls("Reinforced concrete walls")
    ->setRoof("Energy-efficient green roof")
    ->setDoors("Biometric access doors")
    ->addSmartDevice("Smart thermostat")
    ->addSmartDevice("Smart fridge")
    ->addSmartDevice("Smart security cameras")
    ->setSecuritySystem("AI-driven facial recognition")
    ->setEnergyManagementSystem("Off-grid solar battery storage")
    ->enableSolarPanels()
    ->setGarageType("EV charging-enabled garage")
    ->setPoolType("Heated infinity pool")
    ->setIrrigationSystem("AI-controlled drip irrigation")
    ->setVoiceAssistant("Integrated voice assistant")
    ->setEmergencyBackup("Gas generator with solar recharging")
    ->build();
```

In this example, the builder allows us to create a SmartHome object step by step, enabling customization and avoiding the complexity of a long constructor. The builder pattern makes it easier to add new features or adjust configurations without breaking existing code, improving maintainability and scalability over time.