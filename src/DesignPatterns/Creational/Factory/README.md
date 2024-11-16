# Factory Pattern
This project demonstrates the Factory Pattern in PHP by implementing a payment gateway system. 

The Factory pattern is a Creational design pattern that provides an interface for creating objects but allows subclasses to alter the type of objects that will be created.

## Directory Structure

```
└── src  
    └── DesignPatterns  
        └── Creational   
            └── Factory  
                ├── Interfaces
                    ├── PaymentGateway.php   
                └── PaymentGatewayFactory.php  
                └── PayPalGateway.php  
                └── SquareGateway.php  
                └── StripeGateway.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Creational  
                └── FactoryTest.php  
```

### Files Overview

- **Interfaces/PaymentGateway.php**: The interface that all payment gateway implementations adhere to, ensuring a consistent API for interacting with gateways.
- **PaymentGatewayFactory.php**: The factory class that creates instances of specific payment gateways (`PayPalGateway`, `StripeGateway`, `SquareGateway`) based on the type provided.
- **PayPalGateway.php, SquareGateway.php, StripeGateway.php**: Concrete implementations of the `PaymentGateway` interface, each handling payments in their specific way.
- **tests/Unit/DesignPatterns/Creational/FactoryTest.php**: Unit tests that validate the functionality of the factory and its produced objects.
- 
## Running Tests

You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Creational/FactoryTest.php 
```

## Factory Pattern
In this case, the `PaymentGateway` class abstracts the creation of different payment gateways, such as PayPal, Stripe, and Square. By using this pattern, the client code does not need to know the specifics of how to instantiate and work with different gateway classes. Instead, it simply calls the factory to get the appropriate object.

```php
interface PaymentGateway
{
    public function pay(float $amount): string;
}

class PaymentGatewayFactory
{
    public function make(string $gatewayType): PaymentGateway
    {
        return match (strtolower($gatewayType)) {
            'paypal' => new PayPalGateway(),
            'stripe' => new StripeGateway(),
            'square' => new SquareGateway(),
            default => throw new InvalidArgumentException("Unsupported gateway type: $gatewayType"),
        };
    }
}

class PayPalGateway implements PaymentGateway
{
    public function pay(float $amount): string
    {
        return "Charge $amount with Paypal";
    }
}

class SquareGateway implements PaymentGateway
{
    public function pay(float $amount): string
    {
        return "Charge $amount with Square";
    }
}

class StripeGateway implements PaymentGateway
{
    public function pay(float $amount): string
    {
        return "Charge $amount with Stripe";
    }
}
```

### Implementation
Use the Factory Pattern to dynamically create and use different payment gateways. Here's how it works step-by-step:

```php

$gateway = new PaymentGatewayFactory();
$gateway->make('paypal');
$price = $gateway->pay(50); // Pay 50 to paypal

$gateway->make('stripe');
$price = $gateway->pay(14); // Pay 14 to stripe
```

### Advantages
- **Decoupled Code**: The client code doesn't need to know the specific classes of objects it works with.
- **Single Responsibility**: Object creation logic is encapsulated in the factory class.
- **Scalability**: New types can be added without modifying the client code.
- **Flexibility**: The factory logic can dynamically decide which object to create based on runtime conditions.

### Disadvantages
- **Complexity**: Adds additional layers of abstraction, which can make the code harder to follow for simple scenarios.
- **Maintenance Overhead**: Requires updating the factory logic when adding new products.