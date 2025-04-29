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
                    └── Leaf.php 
                    └── Composite.php 
                └── Client.php
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Composite  
                └── CompositeTest.php  
```

### Files Overview
- **Components/Leaf.php**: The Leaf class represents a simple component in the composition. It doesn't have any children but can perform actions or hold data.
- **Components/Composite.php**: The `Composite` class represents a composite object, which may have child components (both Leaf and other `Composite` objects). It manages adding and removing child components.
- **Client.php**: The `Client` class is responsible for creating and interacting with both leaf and composite objects.
- **tests/Unit/DesignPatterns/Structural/CompositeTest.php**: Unit tests for the above classes.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Structural/CompositeTest.php 
```

## The Problem It Solves
Imagine you're building a graphic editor with a drawing board that supports shapes. You have individual shapes like circles and rectangles, but you also need to handle composite shapes (like groups of shapes). 

Here's how you'd normally approach it (bad example):

```php
function calculateArea($shape) {
    if ($shape instanceof Circle) {
        return $shape->calculateArea();
    } elseif ($shape instanceof Rectangle) {
        return $shape->calculateArea();
    } elseif ($shape instanceof GroupOfShapes) {
        $totalArea = 0;
        foreach ($shape->getShapes() as $subShape) {
            $totalArea += calculateArea($subShape);
        }
        return $totalArea;
    }
}
```

### Why This Is Bad?
- **Hard-Coded Logic**: The function explicitly checks each type of shape, making it difficult to extend.
- **Violation of Open/Closed Principle**: Every time a new shape is added, you have to modify the logic to handle it.
- **Difficult to Manage Complex Hierarchies**: Handling nested groups of shapes becomes cumbersome.

## The Solution
The Composite Pattern fixes this problem by:

- Defining a common interface (`Shape`) for both individual shapes and composite shapes.
- Using `Leaf` objects for individual shapes (e.g., `Circle` and `Rectangle`), and `Composite` objects for groups of shapes.
- Treating both the leaf and composite objects uniformly, so no special logic is required when interacting with them.

```php
interface Shape
{
    public function calculateArea(): float;
}

class Circle implements Shape
{
    public function __construct(private float $radius)
    {
        //
    }

    public function calculateArea(): float
    {
        return pi() * $this->radius * $this->radius;
    }
}

class Rectangle implements Shape
{
    public function __construct(private float $width, private float $height)
    {
        //
    }

    public function calculateArea(): float
    {
        return $this->width * $this->height;
    }
}

class GroupOfShapes implements Shape
{
    private array $shapes = [];

    public function addShape(Shape $shape): void
    {
        $this->shapes[] = $shape;
    }

    public function calculateArea(): float
    {
        $totalArea = 0;
        foreach ($this->shapes as $shape) {
            $totalArea += $shape->calculateArea();
        }
        return $totalArea;
    }
}
```

### Implementation
Here’s how you'd use it:

```php
// Create individual shapes
$circle = new Circle(5);
$rectangle = new Rectangle(10, 20);

// Create a group of shapes
$group = new GroupOfShapes();
$group->addShape($circle);
$group->addShape($rectangle);

// Calculate the total area of the group
echo $group->calculateArea(); // Outputs combined area
```

You can now add new payment gateways without modifying the `PaymentService` class.

### Advantages
- **Uniform Treatment**: Treats both simple and composite objects uniformly.
- **Flexibility**: Easily add new shapes or groupings without modifying existing code.
- **Extensibility**: New types of shapes can be added without changing the structure of the existing code.

### Disadvantages
- **Complexity**: Overuse of composites may lead to an overly complex object structure.
- **Harder to Understand**: Understanding the interactions between composite objects and their children may be challenging in large systems.
