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
                └── _OriginalCode
                    └── AdvancedRadioRemote.php  
                    └── AdvancedTVRemote.php
                    └── RadioRemote.php
                    └── TVRemote.php
                └── Devices  
                    └── Interface
                        └── Device.php 
                    └── Radio.php 
                    └── Television.php 
                └── Remotes
                    └── AdvancedRemoteControl.php
                    └── BasicRemoteControl.php
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Structural  
                └── BridgeTest.php  
```

## Implementation Example
Let’s say you’re designing a universal remote control system.

### Step 1: Define the Device Interface
```php
interface Device
{
    public function turnOn(): string;
    public function mute(): string;
}
```

### Step 2: Implement Concrete Devices
```php
class Television implements Device
{
    public function turnOn(): string
    {
        return "Turning on the TV";
    }

    public function mute(): string
    {
        return "Muting the TV";
    }
}

class Radio implements Device
{
    public function turnOn(): string
    {
        return "Turning on the radio";
    }

    public function mute(): string
    {
        return "Muting the radio";
    }
}
```

### Step 3: Create the Remote Abstractions (Bridge Part)
We create a `RemoteControl` that delegates to the Device.

```php
class RemoteControl
{
    public function __construct(protected Device $device)
    {
        //
    }

    public function turnOn(): string
    {
        return $this->device->turnOn();
    }
}
```
Now, the remote doesn’t care what kind of device it’s controlling. Plug in a `TV`, `Radio`, whatever — the API stays the same.

And if f you wanted an advanced remote control?
```php
class AdvancedRemoteControl extends RemoteControl
{
    public function mute(): string
    {
        return $this->device->mute();
    }
}
```

### Step 4: Putting it together
```php
$tv = new Television();
$radio = new Radio();

$basicRemote = new RemoteControl($tv);
echo $basicRemote->turnOn(); // "Turning on the TV"

$advancedRemote = new AdvancedRemoteControl($radio);
echo $advancedRemote->turnOn(); // "Turning on the radio"
echo $advancedRemote->mute();   // "Muting the radio"
```

### File Overview
- **_OriginalCode/TvRemote.php, RadioRemote.php, AdvancedTvRemote.php, AdvancedRadioRemote.php**: Contains tightly coupled code where each remote is directly associated with a specific device (e.g., TV or Radio). As new devices or remote control features are introduced, this will lead to class explosion, creating more subclasses for each combination (e.g., AdvancedRadioRemote, AdvancedTVRemote, etc.), which is difficult to maintain and scale.
- **Devices/Interface/Device.php**: Defines a generic interface for devices that can be controlled by remotes. This interface enforces a common contract for devices, such as turning on, turning off, etc., making the design more extensible and adaptable.
- **Devices/Television.php, Radio.php**: These are concrete classes that implement the Device interface. The Television class handles TV-specific logic (e.g., turning on the TV), while the Radio class handles radio-specific logic. By using the Device interface, these classes allow flexibility, enabling the use of different types of devices without tightly coupling them with specific remotes.
- **Remotes/BasicRemoteControl.php, AdvancedRemoteControl.php**: These are the remote control classes that implement the respective capabilities (e.g., power, mute, input). BasicRemoteControl provides basic functionality like turning a device on or off, while AdvancedRemoteControl can include additional features like muting or changing input. These classes use interfaces like Powerable, Muteable, etc., to allow behavior flexibility without unnecessary class inheritance. For example, a remote can implement only the capabilities it needs.
- **tests/Unit/DesignPatterns/Structural/BridgeTest.php**: This file contains Pest tests to verify that the Bridge pattern works as expected. The tests would check the correct behavior when switching between different devices (e.g., TV and Radio) and remotes (e.g., basic and advanced). It ensures that the Bridge pattern decouples the device and remote control logic properly and allows flexibility when introducing new devices or new capabilities (like mute or change input).

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