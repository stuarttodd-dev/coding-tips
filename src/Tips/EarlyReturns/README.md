# Return Early
Return Early is a simple yet effective refactoring technique that encourages returning from a function or method at the earliest possible point. 

This technique improves readability by reducing the need for deep nesting of conditional blocks and makes it easier to understand the flow of logic.

## When to Use
- To avoid deep nesting and increase code clarity.
- Handling failure cases early to skip the core logic.
- Simplifying long functions with multiple conditionals.

## Directory Structure
```
└── src  
    └── Tips  
        └── EarlyReturns   
            └── After.php  
            └── Before.php  
└── tests  
    └── Unit  
        └── Tips  
            └── EarlyReturns
                └── AfterTest.php
                └── BeforeTest.php
```

## A Before and After
Let's check out a quick example...

### Before
Oh dear, oh dear...

```php
class UserValidator
{
    public function isValid(array $user): bool
    {
        if ($user['age'] > 18) {
            if (isset($user['email']) && filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                if (isset($user['name']) && !empty($user['name'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
```

### After
Now, the function is easier to read because we handle failures upfront and let the function continue only if everything is valid.

```php
class UserValidator
{
    public function isValid(array $user): bool
    {
        if ($user['age'] <= 18) {
            return false;
        }

        if (!isset($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (empty($user['name'])) {
            return false;
        }

        return true;
    }
}
```

### Files Overview
- **Before.php**: Contains the original deeply nested implementation of the UserValidator class without using the return early pattern.
- **After.php**: Contains the refactored version of the `UserValidator` class using the return early technique for cleaner and more readable code.
- **BeforeTest.php**: Includes unit tests for the original (nested) implementation of the validator, verifying behavior under various input conditions.
- **AfterTest.php**: Includes unit tests for the refactored (return early) implementation, confirming that functionality remains consistent while improving code structure.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/Tips/EarlyReturns/AfterTest.php
docker exec coding-tips  ./vendor/bin/pest tests/Unit/Tips/EarlyReturns/BeforeTest.php
```
