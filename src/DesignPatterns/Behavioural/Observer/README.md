# Observer Pattern

This project demonstrates the use of the Observer Pattern to implement a notification system for various observers. When a certain event occurs, the observers are notified to perform their respective actions.

## Directory Structure

```
└── src  
    └── DesignPatterns  
        └── Behavioural   
            └── Observer  
                ├── UserRegisters.php
                ├── Observers
                    ├── LogActivity.php  
                    ├── SaveUserAccount.php  
                    ├── SendWelcomeEmail.php 
                └── Interfaces  
                    └── Observer.php  
                    └── Subject.php  
                └── AlternativeVersion  
                    └── UserRegisters.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── ObserverTest.php  
```

### Files Overview

- **UserRegisters.php**: The subject class that manages the registration process and notifies attached observers when a new user registers.
- **LogActivity.php**: Observer class that logs user registration activities.
- **SendWelcomeEmail.php**: Observer class that sends a welcome email to the new user.
- **SaveUserAccount.php**: Observer class that saves the user account details.
- **Interfaces/Observer.php**: Defines the interface that all observers must implement, ensuring they have a `handle` method.
- **Interfaces/Subject.php**: Defines the interface that all subjects must implement, ensuring they have a `attach`, `detach` and `notify` method.
- **AlternativeVersion/UserRegisters.php**: An alternative approach to the Observer pattern.
- **tests/Unit/DesignPatterns/Behavioural/ObserverTest.php**: Contains tests that validate the functionality of the observer notifications.
-
## Running Tests

You can execute the tests using the following command:
```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/ObserverTest.php 
```

## Observer Pattern

### Implementation

```php
// Bootstrap the subject and attach Observers
$subject = (new UserRegisters())
    ->attach(new LogActivity())
    ->attach(new SendWelcomeEmail())
    ->attach(new SaveUserAccount());

// Notify the observers
$subject->notify();
```

### Advantages
- **Loose Coupling**: Observers are decoupled from the subject, meaning the subject only needs to know the observer implements a specific interface. This promotes modular code and makes it easy to extend functionality by adding new observers without changing existing code.
- **Flexibility**: You can easily add or remove observers at runtime without altering the subject's code, making it straightforward to introduce new functionality or notifications in response to state changes.
- **Automatic Updates**: Observers automatically receive updates when the subject changes, ensuring consistency without manually updating each observer.

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Observer;

class AssignPermissions implements Observer
{
    public function handle(): void
    {
        // Logic to assign permissions
    }
}

```
### Disadvantages

- **Complexity**: Adding multiple observers can introduce complexity, particularly if they perform asynchronous actions. The system's behaviour can become harder to predict if multiple observers are dependent on specific timings.
- **Memory Usage**: Observers remain in memory as long as they are registered, which can cause memory leaks if not properly removed when they are no longer needed.
- **Debugging Challenges**: Debugging and testing can become challenging, as issues in one observer may cause unexpected behaviour across the system, making it difficult to isolate problems.

## Alternative Version

### Implementation

```php
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\AlternativeVersion\UserRegisters as AltVersion;

$subject = new AltVersion();
$subject->notify();
```

### Advantages
- **Simplicity**: This central approach reduces the number of classes and interfaces, making the design easier to follow for small-scale applications where a single notification is sufficient.
- **Easier Maintenance**: Since the notification logic is contained within a single class, making changes is straightforward. It also removes the need to manage and store multiple observer objects.

```php
namespace HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\AlternativeVersion;

class UserRegisters
{
    public function notify(): void
    {
        $this->logActivity();
        $this->saveUserAccount();
        $this->sendWelcomeEmail();
    }

    public function logActivity(): void
    {
        // logic to log activity
    }

    public function saveUserAccount(): void
    {
        // logic to save user account
    }

    public function sendWelcomeEmail(): void
    {
        // logic to send welcome email
    }
}
```

### Disadvantages
- **Less Flexibility**: Adding new types of notifications requires modifying the single notification class, which can lead to a monolithic class over time. This approach lacks the flexibility of adding or removing notifications without changing core code.
- **Single Point of Failure**: Since all notifications are handled by one class, any issue here could disrupt all notifications.
