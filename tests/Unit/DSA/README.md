# Data Structures And Algorithms
In modern programming languages, we’re quite fortunate—many of the intricate details of Data Structures and Algorithms (DSA) are abstracted away for us. Over the course of my career, I've rarely had to implement a full-fledged algorithm or custom data structure from scratch. However, understanding the basics has been invaluable for debugging, optimising, and appreciating how the tools we rely on every day actually work.

We focus on some foundational concepts that every developer should know: arrays, linked lists, stacks, queues, trees, and graphs. These structures form the building blocks of efficient code, and even if you’re not writing them by hand, knowing how they function can be useful.

## Directory Structure
```
└── src  
    └── DSA  
        └── ArrayDemo.php   
   
└── tests  
    └── Unit  
        └── DSA  
            └── ArrayTest.php 
```

## Running Tests
You can execute the tests using the following command:

```bash
docker exec coding-tips  ./vendor/bin/pest tests/Unit/DSA
```

## Arrays
An array is one of the simplest and most widely used data structures. Arrays allow for efficient access to data using an index, making operations like reading or updating a value at a specific position almost instantaneous.

However, arrays have their limitations. Their fixed size means you need to know the number of elements in advance, and operations like inserting or deleting elements can be costly, as they often require shifting elements. Despite these drawbacks, arrays are a foundational data structure that serves as the building block for more complex structures like matrices, hash tables, and more.

### Files Overview

- **DSA/ArrayDemo.php**: Contains examples of basic array operations such as creation, insertion, deletion, and access.
- **tests/Unit/DSA/ArrayTest.php**: Includes unit tests to verify the functionality of array operations, ensuring the reliability of the implementation.