# Strategy Pattern

This project demonstrates the use of the Strategy Pattern to calculate the area of various geometric shapes. It includes implementations for different shapes as well as an alternative approach for area calculation.

## Directory Structure

```
HalfShellStudios  
└── CodingTips  
    └── DesignPatterns  
        └── Behavioural  
            └── Strategy  
                ├── Circle.php  
                ├── Ellipse.php  
                ├── Hexagon.php  
                ├── Octagon.php  
                ├── Pentagon.php  
                ├── Rectangle.php  
                ├── Square.php  
                ├── Trapezoid.php  
                ├── Triangle.php  
                └── Interfaces  
                    └── Shape.php  
                └── AlternativeVersion  
                    └── Shape.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── StrategyTest.php  
```

### Files Overview

- **Circle.php**: Class to calculate the area of a circle given its radius.
- **Ellipse.php**: Class to calculate the area of an ellipse given its semi-major and semi-minor axes.
- **Hexagon.php**: Class to calculate the area of a hexagon given the length of a side.
- **Octagon.php**: Class to calculate the area of an octagon given the length of a side.
- **Pentagon.php**: Class to calculate the area of a pentagon given the length of a side.
- **Rectangle.php**: Class to calculate the area of a rectangle given its width and height.
- **Square.php**: Class to calculate the area of a square given the length of a side.
- **Trapezoid.php**: Class to calculate the area of a trapezoid given its two bases and height.
- **Triangle.php**: Class to calculate the area of a triangle given its base and height.
- **Interfaces/Shape**: Ensures the strategy classes adhere to a given interface, i.e it **must** have the getArea method.
- **AlternativeVersion/Shape.php**: Provides a static method to calculate the area of various shapes using a common interface.
- **tests/Unit/DesignPatterns/Behavioural/StrategyTest**: Contains tests that validate the functionality of the area calculations for each shape.

## Running Tests

You can execute the tests using the following command:
```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/StrategyTest.php 
```

## Strategy Pattern

### Advantages
- **Encapsulation**: Each shape's area calculation is encapsulated within its own class, promoting separation of concerns. This means that the logic for calculating the area of a shape is isolated from other shapes, making the codebase easier to understand.
- **Flexibility**: New shapes can be added easily by creating new classes that implement the same interface without modifying existing code. This allows developers to extend functionality without worrying about breaking existing implementations.

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Interfaces\Shape as ShapeInterface;

class Pentagon implements ShapeInterface {
    private $side;

    public function __construct(float $side) {
        $this->side = $side;
    }

    public function getArea(): float {
        return (1 / 4) * sqrt(5 * (5 + 2 * sqrt(5))) * $this->side ** 2;
    }
}
```

- **Ease of Maintenance**: Code is easier to maintain since each class has a single responsibility. If a bug is found in the area calculation of a specific shape, developers can easily locate and fix it in the corresponding class without affecting others.
- **No Single Point of Failure**: Since each shape's logic is contained in its own class, there's no single point of failure in the system.

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Circle;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Rectangle;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\Triangle;

$shapes = [
    new Circle(3),
    new Rectangle(4, 5),
    new Triangle(6, 4),
];

foreach ($shapes as $shape) {
    echo "The area of the " . $shape::class . " is: " . $shape->getArea() . PHP_EOL;
}
```

### Disadvantages

- **Complexity**: The implementation may require more classes, which can complicate the codebase for simple applications. This increased number of classes might be overwhelming for small projects or for new developers who are not familiar with the design pattern.
- **Learning Curve**: It may be less intuitive for developers unfamiliar with the Strategy Pattern, requiring a learning curve. Understanding how different classes interact through interfaces can take time for new team members.

## Alternative Version

### Implementation

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Strategy\AlternativeVersion\Shape;

$shapes = [
    'circle' => ['radius' => 3],
    'rectangle' => ['width' => 4, 'height' => 5],
    'triangle' => ['base' => 6, 'height' => 4],
];

foreach ($shapes as $shapeType => $dimensions) {
    echo "The area of the $shapeType is: " . Shape::getArea($shapeType, $dimensions) . PHP_EOL;
}
```

### Advantages
- **Simplicity**: A single class handles area calculation for all shapes, reducing the number of classes and simplifying the design. This can make it easier to grasp the overall functionality of the application at a glance.
- **Ease of Use**: Developers can quickly use the Shape class without worrying about multiple class implementations. This can speed up development time, particularly for smaller projects where the overhead of multiple classes isn't justified.

```php
    public static function getArea(string $shapeType, array $parameters): float
    {
        return match ($shapeType) {
            'circle' => M_PI * ($parameters['radius'] ** 2),
            'rectangle' => $parameters['width'] * $parameters['height'],
            'square' => $parameters['side'] ** 2,
            'triangle' => 0.5 * $parameters['base'] * $parameters['height'],
            'trapezoid' => 0.5 * ($parameters['base1'] + $parameters['base2']) * $parameters['height'],
            'ellipse' => M_PI * $parameters['semiMajorAxis'] * $parameters['semiMinorAxis'],
            'hexagon' => (3 * sqrt(3) / 2) * ($parameters['side'] ** 2),
            'pentagon' => (1 / 4) * sqrt(5 * (5 + 2 * sqrt(5))) * ($parameters['side'] ** 2),
            'octagon' => 2 * (1 + sqrt(2)) * ($parameters['side'] ** 2),
            // Add a new shape here.
        };
    }
```

- **Easier Editing**: Modifying area calculation logic is straightforward, as everything is centralized in one class. Developers can quickly adjust formulas without navigating through multiple files.
- **Easier Removal**: If a shape is no longer needed, it can simply be removed from the single class. There's no need to delete multiple files or classes, which simplifies the cleanup process.

### Disadvantages
- **Less Encapsulation**: All shape calculations are handled in one place, which can lead to a bloated class with multiple responsibilities. This can make the codebase harder to maintain as the class grows in size.
- **Reduced Flexibility**: Adding new shapes may require modifying the Shape class, leading to potential regressions or breaking changes. If a new shape needs a complex calculation, the logic can clutter the class further, making it harder to manage.
- **Single Point of Failure**: With all logic centralised, an issue in the Shape class could cause failures across multiple shape calculations. This interdependence can complicate debugging and testing.