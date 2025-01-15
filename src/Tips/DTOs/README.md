# Data Transfer Objects
A DTO is a simple object designed to carry data between layers or systems. Think of it as a glorified envelope for your data: it’s lightweight, neatly organised, and has one job—to move data without any behaviour or extra baggage.

If your database is the kitchen and your API is the dining room, a DTO is the server delivering your meal without dropping the plate.

## Directory Structure
```
└── src  
    └── Tips  
        └── DTOs   
            └── SimpleUserDTO.php 
            └── UserDTO.php 
└── tests  
    └── Tips  
        └── DTOs  
            └── DTOTest.php  
```

## Why Use DTOs?
Why should you care? Here are a few reasons:
- **Separation of Concerns**: DTOs keep your business logic, database models, and API responses clean and distinct.
- **Readability**: A DTO lets you see at a glance what data is being passed around.
- **Validation**: You can validate data at the DTO level, preventing sneaky invalid values from creeping into your code.
- **Flexibility**: DTOs make it easier to tweak data representations without breaking your core application logic.

### A Simple DTO
Here, `UserDTO` encapsulates user data in a structured way. It’s easy to see what’s going on—no digging through nested arrays or guessing what keys exist.

```php
class UserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly int $age
    ) {}
}

// Usage
$userDto = new UserDTO(
    'Taylor Swift', 
    'tswift@example.com', 
    33
);

// Accessing properties
echo $userDto->name; // Taylor Swift
```

### A DTO with Static Function
DTOs often act as intermediaries between your database models and other layers, like APIs or views. Let’s say you’ve got an API response, you can add a static function to create the DTO, like so:

```php
class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public int $age
    ) {}

    /**
     * Creates a UserDTO from an API response.
     */
    public static function fromResponse(array $response): self
    {
        return new self(
            name: $response['full_name'],
            email: $response['email_address'],
            age: (int) $response['age']
        );
    }
}

// Simulated API response
$apiResponse = [
    'id' => 42,
    'full_name' => 'Jane Doe',
    'email_address' => 'jane.doe@example.com',
    'age' => '28',
    'other_field' => 'not needed'
];

// Transform API response to DTO
$userDto = UserDTO::fromResponse($apiResponse);

// Access DTO data
echo $userDto->name;  // Outputs: Jane Doe
echo $userDto->email; // Outputs: jane.doe@example.com
echo $userDto->age;   // Outputs: 28
```

### Files Overview
- **SimpleUserDTO.php**: This file contains the `SimpleUserDTO` class, a data transfer object with immutable properties. It is designed to encapsulate user data such as name, email, and age in a simple, read-only structure.
- **UserDTO.php**: This file contains the `UserDTO` class, a data transfer object for user data. It includes a constructor for direct instantiation and a fromResponse static method to transform API response data into a UserDTO instance. This class demonstrates flexibility in handling user data while maintaining clear data encapsulation.
- **tests/Unit/Tips/DTOs/DtoTest.php**: This file contains unit tests for the `UserDTO` and `SimpleUserDTO` classes. The tests verify that instances of these classes are created correctly and that the UserDTO::fromResponse method accurately converts response arrays into objects.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/Tips/DTOs/DtoTest.php 
```