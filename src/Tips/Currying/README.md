# Currying
Currying is a functional programming technique that transforms a function with multiple arguments into a sequence of functions, each taking their own argument(s), allowing for more flexible and reusable code.

For instance, rather than invoking a function in the usual manner:
`calculateArea(length, width);`

A curried version would be structured as:
`calculateArea(length)(width);`

## Directory Structure
```
└── src  
    └── Tips  
        └── Currying   
            └── Calculator.php 
└── tests  
    └── Tips  
        └── Currying  
            └── CalculatorTest.php  
```

## Advantages
Ok but why is it beneficial? Let’s create a function to multiply two numbers.

Here's the original version.
```php
function multiply($a, $b) {
    return $a * $b;
}

echo multiply(2, 5); // Output: 10
```

**With currying:**
```php
function multiply($a) {
    return function ($b) use ($a) {
        return $a * $b;
    };
}

$double = multiply(2); // Partially apply the first argument
echo $double(5);       // Output: 10
echo $double(8);       // Output: 16
```

By leveraging closures, we can create a powerful chain of functions where each function remembers the context in which it was created.

This approach allows us to break a function into smaller, reusable pieces and defer execution until all arguments are provided.

### Files Overview
- **Calculator.php**: This file contains the Calculator class, showcasing examples of currying in PHP. The class includes methods that demonstrate how to partially apply arguments to create new functions dynamically. It serves as the primary implementation for the concepts being tested.
- **tests/Unit/Tips/Currying/CalculatorTest.php**: This file contains unit tests for the Calculator class. It validates the functionality of the currying implementation, ensuring that partial application works correctly and produces the expected results across various scenarios.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/Tips/Currying/CalculatorTest.php 
```