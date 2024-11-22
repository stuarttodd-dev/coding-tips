# Fluent Interface
This project demonstrates the use of the **Fluent Interface** Pattern to simplify object interaction and provide a clear, chainable API. The examples showcase how this design pattern can be applied to various scenarios, such as performing calculations, constructing database queries, and building a car configuration.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Behavioural   
            └── FluentInterface  
                ├── Calculator.php
                ├── Query.php
                ├── Car.php
                
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── FluentInterfaceTest.php  
```

### Files Overview
- **Calculator.php**: A class that performs mathematical calculations in a chainable manner using fluent methods.
- **Query.php**: A class that builds SQL-like queries with an expressive API.
- **Car.php**: A class to configure a car's attributes using a fluent interface.

### Advantages
- **Improved Readability**: Fluent interfaces allow for method chaining, resulting in code that reads like natural language and reduces the cognitive load for developers.
- **Reduced Boilerplate**: By chaining methods, the need for repetitive variable assignments is minimised, leading to cleaner code.
- **Consistent API**: A fluent interface enforces a predictable and intuitive API design, making it easier for others to understand and use your code.
- **Compact Code**: Complex sequences of actions can be performed in a single expression, reducing the overall number of lines in your codebase.

### Disadvantages
- **Challenging Debugging**: Long chains of method calls can be difficult to debug, as tracing the exact cause of an issue may require breaking the chain.
- **Immutability Concerns**: Fluent interfaces often require modifying the object state directly, which may not align with functional programming principles.
- **Limited Applicability**: This pattern works best for scenarios involving object configuration or sequential operations, but it may not be suitable for all use cases.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/FluentInterfaceTest.php 
```

### Calculator Example
The `Calculator` class demonstrates the use of a fluent interface for performing mathematical calculations. Instead of performing operations step-by-step with intermediate variables, developers can chain methods to achieve the desired result in a single expression.

```php
<?php

namespace DesignPatterns\Behavioural\FluentInterface;

class Calculator
{
    private float $result = 0;

    public function add(float $value): self
    {
        $this->result += $value;
        return $this;
    }

    public function subtract(float $value): self
    {
        $this->result -= $value;
        return $this;
    }

    public function multiply(float $value): self
    {
        $this->result *= $value;
        return $this;
    }

    public function divide(float $value): self
    {
        if ($value === 0) {
            throw new \InvalidArgumentException("Division by zero.");
        }
        $this->result /= $value;
        return $this;
    }

    public function getResult(): float
    {
        return $this->result;
    }
}
```

#### Implementation
```php
$calculator = new Calculator();
$result = $calculator
    ->add(10)
    ->subtract(2)
    ->multiply(5)
    ->divide(4)
    ->getResult();

echo "The result is: $result";
```

### Query Example
The `Query` class provides a fluent interface for constructing SQL-like queries. This example showcases how method chaining can simplify the process of building complex query strings, making the code more expressive and readable.

```php
<?php

namespace DesignPatterns\Behavioural\FluentInterface;

class Query
{
    private string $query = '';

    public function select(string $columns): self
    {
        $this->query .= "SELECT {$columns} ";
        return $this;
    }

    public function from(string $table): self
    {
        $this->query .= "FROM {$table} ";
        return $this;
    }

    public function where(string $condition): self
    {
        $this->query .= "WHERE {$condition} ";
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->query .= "ORDER BY {$column} {$direction} ";
        return $this;
    }

    public function getQuery(): string
    {
        return trim($this->query);
    }
}
```

#### Implementation

```php
// Building a SQL-like query using the fluent interface
$query = new Query();
$sql = $query
    ->select('id, name, email')
    ->from('users')
    ->where('status = "active"')
    ->orderBy('created_at', 'DESC')
    ->getQuery();

echo $sql;
// Output: SELECT id, name, email FROM users WHERE status = "active" ORDER BY created_at DESC
```

### Car Example
The `Car` class uses a fluent interface to configure a car's attributes. It demonstrates how method chaining can be employed for object configuration, allowing for expressive and intuitive object customisation.

```php
<?php

namespace DesignPatterns\Behavioural\FluentInterface;

class Car
{
    private array $attributes = [];

    public function setColor(string $color): self
    {
        $this->attributes['color'] = $color;
        return $this;
    }

    public function setEngine(string $engine): self
    {
        $this->attributes['engine'] = $engine;
        return $this;
    }

    public function addFeature(string $feature): self
    {
        $this->attributes['features'][] = $feature;
        return $this;
    }

    public function getConfiguration(): array
    {
        return $this->attributes;
    }
}
```
#### Implementation
```php
$car = new Car();
$configuration = $car
    ->setColor('blue')
    ->setEngine('V6')
    ->addFeature('sunroof')
    ->addFeature('heated seats')
    ->getConfiguration();

print_r($configuration);
/*
Output:
Array
(
    [color] => blue
    [engine] => V6
    [features] => Array
        (
            [0] => sunroof
            [1] => heated seats
        )
)
*/
```

