# Command Pattern
This project demonstrates the use of the **Command Pattern** to encapsulate a request as an object, allowing you to parameterize methods, delay execution, or manage a queue of requests (e.g., a task scheduler). Each command encapsulates an action and its associated data, making it easy to manage tasks independently.

## Directory Structure
```
└── src  
    └── DesignPatterns  
        └── Behavioural   
            └── Command  
                └── Interfaces  
                    └── Command.php  
                    └── FileManager.php  
                ├── Receivers
                      ├── LocalStorage.php  
                      ├── CloudStorage.php  
                ├── ConcreteCommands  
                    ├── OpenFileCommand.php  
                    ├── SaveFileCommand.php  
                    ├── CloseFileCommand.php  
                └── CommandInvoker.php  
└── tests  
    └── Unit  
        └── DesignPatterns  
            └── Behavioural  
                └── CommandTest.php  
```

### Files Overview
- **Interfaces/Command.php**: Defines the `Command` interface with a method execute() that all concrete commands must implement.
- **Interfaces/FileManager.php**: Defines the `FileManager` interface with a method `open()`, `save()` and `close()` methods that all concrete file managers must implement.
- **Receivers/LocalStorage.php**: Implements a concrete file manager for managing storage locally.
- **Receivers/CloudStorage.php**: Implements a concrete file manager for managing storage via the cloud.
- **ConcreteCommands/OpenFileCommand.php**: Implements a concrete command for opening a file.
- **ConcreteCommands/SaveFileCommand.php**: Implements a concrete command for saving a file.
- **ConcreteCommands/CloseFileCommand.php**: Implements a concrete command for closing a file.
- **CommandInvoker.php**: Defines the actual actions that the commands delegate their work to. For instance, sending an email or generating a report.

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DesignPatterns/Behavioural/CommandTest.php 
```

## An Example

### 1. Define Receivers
The receiver separates **command logic** from **specific actions**. It centralises the **"how"**. 

Examples include:
- Database Operations: Switching between MySQL and SQLite.
- File Systems: Supporting local, cloud, or FTP storage.
- Notification Systems: Sending emails vs. push notifications.

Here we have an example of a `FileManager` acting as a receiver:
```php
interface FileManager
{
    public function open(string $fileName): void;
    public function save(string $fileName): void;
    public function close(string $fileName): void;
}

class LocalStorage implements FileManager
{
    public function open(string $fileName): void
    {
        echo "Opening local file: {$fileName}" . PHP_EOL;
    }

    public function save(string $fileName): void
    {
        echo "Saving local file: {$fileName}" . PHP_EOL;
    }

    public function close(string $fileName): void
    {
        echo "Closing local file: {$fileName}" . PHP_EOL;
    }
}

class CloudStorage implements FileManager
{
    public function open(string $fileName): void
    {
        echo "Connecting to cloud storage..." . PHP_EOL;
        echo "Opening cloud file: {$fileName}" . PHP_EOL;
    }

    public function save(string $fileName): void
    {
        echo "Saving file to cloud storage: {$fileName}" . PHP_EOL;
    }

    public function close(string $fileName): void
    {
        echo "Closing connection for cloud file: {$fileName}" . PHP_EOL;
    }
}
```

### 2. Create a Command Interface
The Command interface declares a method, often named `execute()`. This method is meant to encapsulate a specific operation. The interface sets a contract for concrete command classes, defining the `execute()` method that encapsulates the operation to be performed.

```php
interface Command
{
    public function execute(): void;
}
```

### 3. Create Concrete Command Classes
Concrete commands implement the `Command` interface and are responsible for delegating the operation to a specific receiver. 

These commands act as intermediaries between the `Invoker` and the `Receiver`, allowing you to centralize business logic within the receiver while keeping the commands lightweight.

```php
class OpenFileCommand implements Command
{
    public function __construct(
        private FileManager $fileManager, 
        string $fileName
    )
    {
        //
    }

    public function execute(): void
    {
        $this->fileManager->open($this->fileName);
    }
}

class SaveFileCommand implements Command
{
    public function __construct(
        private FileManager $fileManager, 
        string $fileName
    )
    {
        //
    }

    public function execute(): void
    {
        $this->fileManager->save($this->fileName);
    }
}

class CloseFileCommand implements Command
{
    public function __construct(
        private FileManager $fileManager, 
        string $fileName
    )
    {
        //
    }

    public function execute(): void
    {
        $this->fileManager->close($this->fileName);
    }
}
```

### 4. Create an Invoker
The invoker is responsible for managing commands. It allows commands to be queued, executed in sequence, or even executed conditionally, making it an essential part of task scheduling or macro systems.

```php
class CommandInvoker
{
    private array $commands = [];

    public function addCommand(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function executeAll(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
        
        $this->commands = [];
    }
}
```

### 5. Implementation
```php
$fileManager = new LocalStorage();
$fileName = "example.txt";

// Create commands
$openCommand = new OpenFileCommand($fileManager, $fileName);
$saveCommand = new SaveFileCommand($fileManager, $fileName);
$closeCommand = new CloseFileCommand($fileManager, $fileName);

// Use the invoker to queue and execute commands
$invoker = new CommandInvoker();
$invoker->addCommand($openCommand);
$invoker->addCommand($saveCommand);
$invoker->addCommand($closeCommand);

// Execute all queued commands
$invoker->executeAll();

// Output
// Opening local file: example.txt
// Saving local file: example.txt
// Closing local file: example.txt
```

Switching to `CloudStorage` is as simple as swapping out the receiver:

```php
$fileManager = new CloudStorage();
$openCommand = new OpenFileCommand($fileManager, $fileName);
$saveCommand = new SaveFileCommand($fileManager, $fileName);
$closeCommand = new CloseFileCommand($fileManager, $fileName);

$invoker = new CommandInvoker();
$invoker->addCommand($openCommand);
$invoker->addCommand($saveCommand);
$invoker->addCommand($closeCommand);

$invoker->executeAll();

// Output
// Connecting to cloud storage...
// Opening cloud file: example.txt
// Saving file to cloud storage: example.txt
// Closing connection for cloud file: example.txt
```

### Advantages
- **Encapsulation of Requests**: Each command encapsulates its data and logic, enabling easier modification and maintenance.
- **Decoupling of Sender and Receiver**: The sender (invoker) doesn’t need to know anything about the receiver, promoting loose coupling.
- **Queueing and Delayed Execution**: Commands can be stored and executed later, making them suitable for task scheduling or undo/redo systems.
- **Extensibility**: New commands can be added without modifying existing code

### Disadvantages
- **Increased Complexity**: The pattern introduces multiple classes and abstractions, which might be overkill for simple tasks.
- **Memory Overhead**: Storing commands in a queue may require additional resources, especially for complex or high-frequency tasks.

## What happens we if remove the 'Receiver' classes?
Here’s how the `OpenFileCommand` class might look when handling both `LocalStorage` and `CloudStorage` directly within the `execute()` method, without using a separate receiver class. 

This example directly handles the different types of storage within the command:

```php
class OpenFileCommand
{
    public function __construct(
        private string $fileName,
        private string $storageType
    )
    {
        //
    }

    public function execute(): void
    {
        if ($this->storageType === 'local') {
            echo "Opening local file: {$this->fileName}" . PHP_EOL;
        } elseif ($this->storageType === 'cloud') {
            echo "Connecting to cloud storage..." . PHP_EOL;
            echo "Opening cloud file: {$this->fileName}" . PHP_EOL;
        } else {
            echo "Unknown storage type: {$this->storageType}" . PHP_EOL;
        }
    }
}
```

In this example, the `execute()` method checks the $storageType property to decide whether to use local storage or cloud storage logic directly within the command. If the storage type is 'local', it handles the file opening with local logic. If it's 'cloud', it handles it with cloud logic.
This approach works for simple scenarios but quickly becomes problematic as the complexity grows.
If more storage types or actions (like saving or closing files) are introduced, the command class would grow in size, violating the **Single Responsibility Principle**.
Additionally, maintaining and extending this logic becomes harder as it’s embedded directly in the command.
By keeping the receiver classes (like `LocalStorage` and `CloudStorage`), you separate concerns and allow the commands to remain simple and focused on orchestration, delegating the actual work to the appropriate receiver.

## What happens we don't use the Command Pattern at all?
Without the **Command Pattern**, you would directly invoke methods on the `FileManager` (or any other class), which would lead to tight coupling between the invoker and the receiver. 

For example, consider the following code:
```php
$fileManager = new FileManager();
$fileManager->open("example.txt");
$fileManager->save("example.txt");
$fileManager->close("example.txt");
```

We'd have to manually edit the FileManager class, maybe passing in a $storageType parameter:
```php
$storageType = 'local';
$fileManager = new FileManager($storageType);
```

Then maybe, we're adding something like this throughout the class:
```php
if ($storageType == 'local') {
    // Do local stuff
} elseif ($storageType == 'cloud') {
    // Do cloud stuff
}
```
Without the **Command Pattern**, you forgo the flexibility and structure it offers. You end up with tightly coupled classes, harder-to-maintain code, and a lack of extensibility. This approach works fine for small, simple use cases, but as complexity grows, the drawbacks become more apparent.

