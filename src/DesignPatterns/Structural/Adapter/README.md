# Adapter Pattern
The *Adapter Pattern* is a structural design pattern that allows two incompatible interfaces to work together. It acts as a bridge between two systems, converting the interface of one class into another interface that a client expects.

In simpler terms:

- You have third-party code (like a payment gateway).
- Your app expects a standard interface (pay() method).
- The Adapter makes the third-party code conform to your app’s expected interface.

## Directory Structure
Here’s the full directory structure for our Adapter Pattern example:

```
└── src  
    └── DesignPatterns  
        └── Structural   
            └── Adapter  
                └── Adapters  
                    └── PaypalAdapter.php 
                    └── StripeAdapter.php 
                └── Interface  
                    └── PaymentGateway.php  
                ├── VendorFiles
                    ├── Paypal  
                        ├── Paypal.php  
                    ├── Stripe  
                        ├── Stripe.php  
                └── PaymentService.php
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Structural  
                └── AdapterTest.php  
```

### Files Overview

- **Adapters/PaypalAdapter.php**: The `PaypalAdapter` is responsible for adapting the `Paypal` class to the `PaymentGateway` interface. It converts the `sendPayment()` method to `pay()` so it aligns with your app’s expectations.
- **Adapters/StripeAdapter.php**: The `StripeAdapter` is responsible for adapting the `Stripe` class to the `PaymentGateway` interface. It converts the `createCharge()` method to `pay()` so it aligns with your app’s expectations.
- **Interface/PaymentGateway.php**: This interface defines the standard method (`pay()`) that all payment gateways must implement. It ensures that the core application is not tightly coupled to any specific payment gateway.
- **VendorFiles/Paypal/Paypal.php**: This is a fake third-party `PayPal` SDK. It has its own method called `sendPayment()`, which does not conform to our application’s standard interface.
- **VendorFiles/Stripe/Stripe.php**: This is a fake third-party `Stripe` SDK. It has its own method called `createCharge()`, which does not conform to our application’s standard interface.
- **PaymentService.php**: The `PaymentService` class handles all payment processing through a `PaymentGateway`. It doesn't care which gateway is being used — it only expects a class implementing the `PaymentGateway` interface. This makes it decoupled and highly extendable.
- **tests/Unit/DesignPatterns/Structural/AdapterTest.php**: Unit tests for the above.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Structural/AdapterTest.php 
```

## The Problem It Solves
Imagine you're building an e-commerce platform that supports multiple payment gateways like Stripe, PayPal, and Klarna.

Here’s how you'd normally write it (bad example):

```php
function pay(string $gateway, float $amount): void {
    if ($gateway === 'stripe') {
        $stripe = new StripeAPI();
        $stripe->createCharge($amount);
    } elseif ($gateway === 'paypal') {
        $paypal = new PayPalAPI();
        $paypal->sendPayment($amount);
    } elseif ($gateway === 'klarna') {
        $klarna = new KlarnaAPI();
        $klarna->processPayment($amount);
    }
}
```

### Why This Is Bad?

- **Tightly Coupled Code**: Your `pay()` function directly depends on third-party APIs.
- **Violation of Open/Closed Principle**: Every time you add a new payment gateway, you modify the core logic.
- **Impossible To Test**: You can't mock the payment gateway without hitting a real API.

## The Solution
The Adapter Pattern fixes this problem by:

- Creating a standard interface (`PaymentGateway`).
- Wrapping each third-party API inside an `Adapter` class.
- Injecting the `Adapter` into the `PaymentService` without modifying core logic.

```php
interface PaymentGateway
{
    public function pay(float $amount): string;
}

class PaypalAdapter implements PaymentGateway
{
    private readonly Paypal $paypal;

    public function __construct()
    {
        $this->paypal = new Paypal();
    }

    #[\Override]
    public function pay(float $amount): string
    {
        return $this->paypal->sendPayment($amount);
    }
}

class StripeAdapter implements PaymentGateway
{
    private readonly Stripe $stripe;

    public function __construct()
    {
        $this->stripe = new Stripe();
    }

    #[\Override]
    public function pay(float $amount): string
    {
        return $this->stripe->createCharge($amount);
    }
}

class PaymentService
{
    public function __construct(private readonly PaymentGateway $gateway)
    {
        //
    }

    public function pay(float $amount): string
    {
        return $this->gateway->pay($amount);
    }
}
```

### Implementation
Here’s how you'd use it:

```php
// Pay 100 to Stripe
$paymentService = new PaymentService(new StripeAdapter());
$paymentService->pay(100);

// Pay 50 to Paypal
$paymentService = new PaymentService(new PaypalAdapter());
$paymentService->pay(50);
```

You can now add new payment gateways without modifying the `PaymentService` class.

### Advantages
- **Loose Coupling**: The core application doesn't know or care which payment gateway is being used.
- **Easy Expansion**: Adding a new gateway? Just create a new Adapter. No core changes.
- **Better Testability**: You can mock the adapter without hitting a live API.

### Disadvantages
- **More Classes**: You'll need an adapter class for every third-party integration.
- **Slight Overhead**: Adds a bit of boilerplate, but the scalability benefit is worth it.
