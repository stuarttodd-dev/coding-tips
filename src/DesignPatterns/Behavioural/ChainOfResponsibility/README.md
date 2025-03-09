# Chain Of Responsibility Pattern

This project demonstrates the use of the Chain of Responsibility Pattern to process a sequence of validation and authorisation steps within a request handling pipeline. Each step in the chain checks certain conditions and either processes the request or passes it along to the next handler in line.

## Directory Structure

```
└── src  
    └── DesignPatterns  
        └── Behavioural   
            └── ChainOfResponsibility  
                └── Abstractions  
                    └── AbstractHandler.php  
                └── AlternativeVersion  
                    └── RequestProcessor.php  
                ├── Exceptions
                    ├── AuthException.php  
                    ├── PermissionException.php  
                    ├── ValidationException.php 
                └── Interfaces  
                    └── Handler.php  
                └── AuthHandler.php  
                └── PermissionHandler.php  
                └── ValidationHandler.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── ChainOfResponsibilityTest.php  
```

### Files Overview

- **AuthHandler.php**: A handler that checks if the user is authenticated. If not, it throws an AuthException.
- **PermissionsHandler.php**: A handler that verifies if the user has the correct permissions (e.g., admin role) and throws a PermissionException if unauthorized.
- **ValidationHandler.php**: A handler that validates the request data, throwing a ValidationException if data is missing or invalid.
- **Abstractions/AbstractHandler.php**: Contains an abstract class that implements shared functionality for all handlers in the chain, facilitating the management of the next handler.
- **Exceptions/AuthException.php**: Defines the `AuthException` class, which is thrown when authentication fails.
- **Exceptions/PermissionException.php**: Defines the `PermissionException` class, which is thrown when a user lacks the required permissions.
- **Exceptions/ValidationException.php**: Defines the `ValidationException` class, which is thrown when request data validation fails.
- **Interfaces/Handler.php**: Defines the Handler interface, ensuring each handler has a setNext method to attach another handler and a handle method to process the request or pass it along.
- **AlternativeVersion/RequestProcessor.php**: An alternative approach that processes all validation steps in a single class.
- **tests/Unit/DesignPatterns/Behavioural/ChainOfResponsibilityTest.php**: Contains tests to validate the functionality of each handler and exception.

## Running Tests

You can execute the tests using the following command:
```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/ChainOfResponsibilityTest.php 
```

## Chain Of Responsibility Pattern

### Implementation

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\AuthHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\PermissionsHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\ValidationHandler;

// Bootstrap the chain
$authHandler = new AuthHandler();
$permissionsHandler = new PermissionsHandler();
$validationHandler = new ValidationHandler();

$authHandler
    ->setNext($permissionsHandler)
    ->setNext($validationHandler);
    
// Set request
$request = [
    'user' => [
        'name' => 'John Doe',
        'roles' => ['USER', 'ADMIN']
    ],
    'data' => 'Some important data'
];
    
// Run the request through the chain.
// If request is invalid, an appropriate exception is thrown.
$authHandler->handle($request);
```

### Advantages
- **Single Responsibility Principle**: Each handler performs a single responsibility, making it easier to understand, maintain, and test independently.
- **Flexible and Extensible**: Handlers can be added, removed, or reordered easily within the chain, allowing for flexible request handling as requirements evolve.
- **Reduced Complexity**: Distributing responsibilities among multiple classes keeps each handler lightweight and allows for complex condition processing without creating a large monolithic class.

```php
namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Abstractions\AbstractHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\AuthException;

class AuthHandler extends AbstractHandler
{
    /**
     * @throws AuthException
     */
    public function handle(array $request): ?string
    {
        if (!isset($request['user'])) {
            throw new AuthException('User not authenticated');
        }

        return parent::handle($request);
    }
}
```

### Disadvantages
- **Overhead of Multiple Classes**: Each step requires a new class, which may add to the number of classes in the project and increase overall file management complexity.
- **Potential Debugging Complexity**: Debugging can become challenging with multiple handlers, as errors might be caused by dependencies or a handler further down the chain.

## Alternative Version

### Implementation

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\AlternativeVersion\RequestProcessor;

$processor = new RequestProcessor();

$request = [
    'user' => [
        'name' => 'John Doe',
        'roles' => ['USER', 'ADMIN'],
    ],
    'data' => 'Some important data',
];

// If request is invalid, an appropriate exception is thrown.
$processor->process($request);
```

### Advantages
- **Simplicity**: By consolidating all validation and authorization logic in a single class, the design is easier to follow, especially for smaller-scale applications.
- **Centralised Management**: All request checks are in one place, making it simpler to add new conditions or modify existing ones without managing multiple handlers.

```php
namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\AlternativeVersion;

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\AuthException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\PermissionException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\ValidationException;

class RequestProcessor
{
    /**
     * @throws PermissionException
     * @throws ValidationException
     * @throws AuthException
     */
    public function process(array $request): void
    {
        if (!isset($request['user'])) {
            throw new AuthException('User not authenticated.');
        }

        if (!in_array('ADMIN', $request['user']['roles'] ?? [])) {
            throw new PermissionException('User not authorized.');
        }

        if (empty($request['data'])) {
            throw new ValidationException('Invalid data provided.');
        }
    }
}
```

### Disadvantages
- **Less Flexibility**: The single-class approach limits the ability to rearrange or selectively apply only some validation steps, which can become limiting as the application grows.
- **Monolithic**: Over time, adding additional checks can make the class bloated and harder to maintain, breaking the single responsibility principle.
