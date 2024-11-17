# Composition Over Inheritance
Inheritance and composition are both tools in object-oriented programming. Like any tool, they have their purposes, but misuse can lead to messy, inflexible code. 
While composition is often favoured for its flexibility, this doesn’t mean inheritance is bad—it simply has a narrower scope of ideal use cases. 
The real problem lies in how we use these tools, not the tools themselves.

Let’s explore the **Coffee Shop Problem**, where inheritance becomes problematic, and then refactor it using composition (with a sprinkle of inheritance).

## Directory Structure
```
└── src  
    └── DesignPrinciples  
        └── CompositionOverInheritance   
            └── TheProblem  
                └── Coffee.php  
                └── Espresso.php  
                └── EspressoWithMilk.php  
                └── EspressoWithMilkAndSugar.php  
                └── EspressoWithSugar.php             
            └── TheSolution  
                ├── Abstractions
                    ├── AbstractIngredient.php   
                ├── Ingredients
                    ├── FlavouredSyrup.php 
                    ├── Milk.php
                    ├── Sugar.php
                    ├── WhippedCream.php
                ├── Interfaces
                    ├── Ingredient.php   
                └── Drink.php  
└── tests  
    └── Unit  
        └── DesignPrinciples  
            └── CompositionOverInheritanceTest.php 
```

### Files Overview

- **Interfaces/Ingredient.php**: Defines the Ingredient interface, ensuring that all ingredient classes (e.g., Milk, Sugar, etc.) implement the required methods for getting descriptions and costs.
- **Abstractions/AbstractIngredient.php**: An abstract class that implements the Ingredient interface, providing a base for specific ingredient classes to extend. It contains common properties ($description and $cost) and their getter methods.
- **Ingredients/FlavouredSyrup.php**: A concrete implementation of AbstractIngredient representing a flavored syrup with a dynamic description based on the type (e.g., Caramel, Vanilla) and a predefined cost.
- **Ingredients/Milk.php**: A concrete implementation of AbstractIngredient representing milk as an ingredient, with a fixed description ("Milk") and cost.
- **Ingredients/Sugar.php**: A concrete implementation of AbstractIngredient representing sugar, with a fixed description ("Sugar") and cost.
- **Ingredients/WhippedCream.php**: A concrete implementation of AbstractIngredient representing whipped cream, with a fixed description ("Whipped Cream") and cost.
- **Drink.php**: A class representing a drink that can have multiple ingredients added. It includes methods for adding ingredients, getting the drink’s description, and calculating its total cost.
- **tests/Unit/DesignPrinciples/CompositionOverInheritanceTest.php**: Unit tests for the CompositionOverInheritance principle, specifically testing the behavior of Drink and its interaction with various ingredient classes. These tests validate the correct description and cost calculations when ingredients are added to drinks like Espresso, Americano, and Hot Chocolate.

## Running Tests

You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPrinciples/CompositionOverInheritanceTest.php 
```

## The Problem
Lets start off with a basic `Coffee` class, which has two methods, one to get the description and another to get the cost.

```php
class Coffee
{
    public function getDescription(): string
    {
        return "Generic Coffee";
    }

    public function getCost(): float
    {
        return 2.00;
    }
}
```

Say we’d like to accommodate an `Espresso`, which is a child of `Coffee` but we also need an `EspressoWithMilk` and an `EspressoWithSugar`, you might end up with something like this?

```php
class Espresso extends Coffee
{
    public function getDescription(): string
    {
        return "Espresso";
    }

    public function getCost(): float
    {
        return 2.50;
    }
}

class EspressoWithMilk extends Espresso
{
    public function getDescription(): string
    {
        return parent::getDescription() . " with Milk";
    }

    public function getCost(): float
    {
        return parent::getCost() + 0.50;
    }
}

class EspressoWithMilkAndSugar extends EspressoWithMilk
{
    public function getDescription(): string
    {
        return parent::getDescription() . " and Sugar";
    }

    public function getCost(): float
    {
        return parent::getCost() + 0.20;
    }
}
```

But what would happen if we then needed an `Americano`, `Latte`, or a `Hot Chocolate`. 

Maybe the Hot Chocolate has tonnes of different options such as extra marshmallows, whipped cream, or flavoured syrups.

Suddenly, our class hierarchy spirals out of control. For every new drink type or combination of ingredients, we need another subclass. **This is the dreaded class explosion problem**.

What happens if we need to change the price of milk across several subclasses? Well, the rigidity of this inheritance-based approach rears its ugly head. Since the price of milk is hardcoded in each subclass (e.g., `EspressoWithMilk`, `LatteWithMilkAndSugar`), we would need to hunt down every subclass where milk is used and manually update the cost.

This not only increases the risk of inconsistent updates (what if you miss one class?) but also violates the DRY principle (Don’t Repeat Yourself). The more subclasses you have, the more tedious and error-prone this process becomes.

For example:
- Update `EspressoWithMilk` to add $0.60 for milk instead of $0.50.
- Update `AmericanoWithMilk` for the same.
- Update `LatteWithMilkAndSugar`, etc.

If you have dozens of subclasses, this task can quickly spiral into a nightmare of repetitive edits, all while praying you don’t miss one.

## The Solution

To fix this, we can use composition. Instead of hardcoding add-ons and their costs in subclasses, we’ll separate the concerns into smaller, reusable components. 
Each drink remains a single class, and we dynamically compose the final product by attaching add-ons to the base drink.

Here’s how we’ll tackle it:
- **Base Drink Class**: Represents a basic drink class.
- **Ingredients**: Modular classes for extras like milk, sugar, whipped cream, etc.
- **Composition**: Add ingredients to the drink at runtime, rather than in the class hierarchy.

Lets’s define the base `Drink` class.

```php
class Drink
{
    private array $ingredients = [];

    public function __construct(
        private string $description, 
        private float $baseCost
    )
    {
        //
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    public function getDescription(): string
    {
        $descriptions = array_map(fn(Ingredient $ingredient) => $ingredient->getDescription(), $this->ingredients);

        return $this->description . (empty($descriptions) ? "" : " with " . implode(", ", $descriptions));
    }

    public function getCost(): float
    {
        $costs = array_reduce($this->ingredients, fn($sum, Ingredient $ingredient) => $sum + $ingredient->getCost(), 0);
        return $this->baseCost + $costs;
    }
}
```

Next, lets create the `Ingredient` subclasses, lets also use an abstract class to eliminate boilerplate (duplicated code) throughout these sub classes.

```php
interface Ingredient
{
    public function getDescription(): string;
    public function getCost(): float;
}

abstract class AbstractIngredient implements Ingredient
{
    protected string $description;
    protected float $cost;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCost(): float
    {
        return $this->cost;
    }
}

class Milk extends AbstractIngredient
{
    protected string $description = 'Milk';
    protected float $cost = 0.5;
}

class Sugar extends AbstractIngredient
{
    protected string $description = 'Sugar';
    protected float $cost = 0.25;
}

class WhippedCream extends AbstractIngredient
{
    protected string $description = 'Whipped Cream';
    protected float $cost = 0.85;
}

class FlavouredSyrup extends AbstractIngredient
{
    protected string $description = 'Flavoured Syrup';
    protected float $cost = 0.45;

    public function __construct(string $type) 
    {
        $this->description .= " " . $type;
    }
}
```

Now, using the `Drink` class and the `Ingredient` subclasses, we can dynamically assemble any drink.

```php
// Espresso
$espresso = new Drink("Espresso", 2.50);
$espressoWithMilk = $espresso->addIngredient(new Milk());

// Americano
$americano = new Drink("Americano", 2.30);
$americanoWithMilkAndSugar = $americano
    ->addIngredient(new Milk())
    ->addIngredient(new Sugar());

// Hot Chocolate
$hotChocolate = new Drink("Hot Chocolate", 3.50);
$deluxeHotChocolate = $hotChocolate
    ->addIngredient(new Milk())
    ->addIngredient(new WhippedCream())
    ->addIngredient(new FlavouredSyrup("Caramel"))
    ->addIngredient(new FlavouredSyrup("Vanilla"));
```

This approach keeps the system **clean**, **modular**, and **easy to extend** or **modify** but it’s also worth mentioning that while we’ve largely used composition to manage the ingredients and drink assembly, inheritance still plays an important role here in the structure of the ingredients.

We’ve leveraged inheritance to define an `abstractIngredient` class, from which all specific ingredients (like `Milk`, `Sugar`, `WhippedCream`, etc.) inherit. This allows us to centralise shared functionality, such as the `getDescription()` and `getCost()` methods, while letting each subclass define its unique behaviour.

In this case, inheritance ensures that every ingredient shares the same base structure while maintaining flexibility for individual customisations (like description and cost). Without inheritance, we’d have to manually define the description and cost methods for each ingredient separately, leading to unnecessary duplication of code.

In summary, we've used composition for dynamic drink construction, and inheritance for structuring common ingredient behaviours. 

This hybrid approach gives us the benefits of both techniques while avoiding their potential pitfalls.
