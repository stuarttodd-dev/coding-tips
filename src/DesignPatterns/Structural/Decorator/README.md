# Decorator Pattern

This project demonstrates the use of the Decorator Pattern to dynamically add functionality to a Pizza object by "wrapping" it with additional components (like different crust types or toppings). Each component (e.g., a crust or topping) is a decorator that augments the pizza with a specific price and toppings, creating flexible and extensible pizza customisation.

## Directory Structure

```
└── src  
    └── DesignPatterns  
        └── Structural   
            └── Decorator  
                └── Abstractions  
                    └── BaseComponent.php 
                    └── ToppingDecorator.php 
                └── AlternativeVersion  
                    └── PizzaMaker.php  
                ├── Bases
                    ├── NewYorkStyleCrust.php  
                    ├── ThickCrust.php  
                    ├── ThinCrust.php 
                └── Interfaces  
                    └── Pizza.php  
                └── Toppings  
                    └── Ham.php  
                    └── Mushroom.php  
                    └── Pepperoni.php  
                    └── Pineapple.php  
                    └── Sweetcorn.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Structural  
                └── DecoratorTest.php  
```

### Files Overview

- **Abstractions/BaseComponent.php**: Defines a base component class for the pizza, implementing core functionality and acting as a base for the crust and topping components.
- **Abstractions/ToppingDecorator.php**: An abstract decorator class that wraps a Pizza component and adds additional behavior or state (e.g., price and toppings).
- **AlternativeVersion/PizzaMaker.php**: A simplified, standalone version of the PizzaMaker class that creates a basic pizza with a selected crust and list of toppings.
- **Bases/NewYorkStyleCrust.php, ThickCrust.php, ThinCrust.php**: Concrete implementations of crusts that add specific prices and descriptions, serving as base pizzas in the decorator structure.
- **Interfaces/Pizza.php**: Defines the Pizza interface, which mandates a getPrice() and getDescription() method to ensure each component provides the necessary pizza information.
- **Toppings/Ham.php, Mushroom.php, Pepperoni.php, Pineapple.php, Sweetcorn.php**: Concrete decorator classes for each topping, adding the respective topping’s price and topping name to the Pizza.
- **tests/Unit/DesignPatterns/Structural/DecoratorTest.php**: Unit tests that validate the functionality of each pizza and topping decorator, ensuring correct pricing and topping names.
## Running Tests

You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Structural/DecoratorTest.php 
```

## Decorator Pattern
This example demonstrates building a custom pizza with flexible, runtime-set toppings. Starting with a `Pizza` interface that defines a contract, we enforce that every pizza or topping component must provide `getPrice` and `getToppings` methods.
The `Pizza` interface standardises our pizza components, ensuring each component offers both a price and a toppings list.
The abstract `BaseComponent` serves as a foundation for crusts, implementing `Pizza` to avoid boilerplate across crust classes. 
This lets us create base pizzas with standardised methods.

```php
interface Pizza
{
    public function getPrice(): float;
    public function getToppings(): array;
}

abstract class BaseComponent implements Pizza
{
    protected float $price;
    protected array $toppings;

    public function getPrice(): float
    {
        return round($this->price, 2);
    }

    public function getToppings(): array
    {
        return $this->toppings;
    }
}

class ThickCrust extends BaseComponent
{
    protected float $price = 5.99;
    protected array $toppings = [];
}
```

Using concrete decorators (toppings), we add components at runtime. These decorators extend an abstract `ToppingDecorator`, which accepts any `Pizza` object and augments 
its `getPrice` and `getToppings` by adding each topping's specific data.

```php
interface Pizza
{
    public function getPrice(): float;
    public function getToppings(): array;
}

abstract class ToppingDecorator implements Pizza
{
    protected float $price;
    protected array $toppings;

    public function __construct(protected Pizza $pizza)
    {
        //
    }

    public function getPrice(): float
    {
        return round($this->pizza->getPrice() + $this->price, 2);
    }

    public function getToppings(): array
    {
        return array_merge($this->pizza->getToppings(), $this->toppings);
    }
}

class Ham extends ToppingDecorator
{
    protected float $price = 1.29;
    protected array $toppings = [
        'Ham'
    ];
}
```

### Implementation
Using decorators, we dynamically add or remove toppings, wrapping each topping around the previous one to build a fully customised pizza. 

Here’s how to create a pizza with various toppings, using `ThinCrust` as our base.

```php
// Make a thin crust pizza with pepperoni, mushrooms and ham
$pizza = new Pepperoni(new Mushroom(new Ham(new ThinCrust())));
$price = $pizza->getPrice(); // 7.26
$toppings = $pizza->getToppings(); // ['Ham', 'Mushrooms', 'Pepperoni']
```

### Advantages
- **Single Responsibility Principle**: Each decorator has a single responsibility, making it easier to understand, maintain, and test individual components.
- **Flexible and Extensible**: Decorators can be added or removed easily, allowing for flexible pizza customization as requirements evolve.
- **Reduced Complexity in Core Class**: Distributing responsibilities among decorators keeps the core Pizza class lightweight and allows for extended functionality without modifying the core class.

### Disadvantages
- **Overhead of Multiple Classes**: Each topping or crust requires a new decorator class, which can add to the overall class count and increase file management complexity.
- **Potential Debugging Complexity**: Debugging may become challenging with nested decorators, as identifying the source of issues in a long decorator chain can be complicated.

## Alternative Version
For simpler cases, the alternative `PizzaMaker` class can be used. This approach allows for flexible crust and topping choices without needing multiple decorator classes. It’s ideal for small-scale applications where the full power of the Decorator Pattern might be overkill.

### Implementation

```php
$pizzaMaker = new PizzaMaker();
$result = $pizzaMaker->makePizza('Thin', ['Ham', 'Pineapple']);
$price = $result['price']; // 7.77
$toppings = $result['toppings']; // ['Ham', 'Pineapple']
```

### Advantages
- **Simplicity**: The single PizzaMaker class is straightforward, making it easy to follow for smaller projects.
- **Centralised Management**: Crust and topping data are managed in one place, making it easy to add or modify options without creating additional classes.
- **Easy Price Updates**: Prices are centrally managed, reducing complexity when prices need updating across toppings or crusts.

```php
class PizzaMaker
{
    private array $crustPrices = [
        'Thin' => 3.49,
        'NewYorkStyle' => 4.49,
        'Thick' => 5.99,
    ];

    private array $toppingPrices = [
        'Ham' => 1.29,
        'Mushrooms' => 0.99,
        'Pepperoni' => 1.49,
        'Pineapple' => 2.99,
        'Sweetcorn' => 0.49,
    ];

    public function makePizza(string $crust, array $toppings): array
    {
        $price = $this->crustPrices[$crust] ?? 0.00;

        $toppingsList = [];
        foreach ($toppings as $topping) {
            $price += $this->toppingPrices[$topping] ?? 0.00;
            $toppingsList[] = $topping;
        }

        return [
            'price' => round($price, 2),
            'toppings' => $toppingsList,
        ];
    }
}
```

### Disadvantages
- **Less Flexibility**: This single-class approach limits flexibility for mix-and-match or rearranged components, meaning it’s less adaptable to runtime changes.
- **Monolithic Growth**: Over time, adding new toppings and crusts can make the class bloated, eventually reducing maintainability and violating the Single Responsibility Principle.
