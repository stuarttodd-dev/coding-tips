# Data Structures And Algorithms
In modern programming languages, we’re quite fortunate—many of the intricate details of Data Structures and Algorithms (DSA) are abstracted away for us. Over the course of my career, I've rarely had to implement a full-fledged algorithm or custom data structure from scratch. However, understanding the basics has been invaluable for debugging, optimising, and appreciating how the tools we rely on every day actually work.

We focus on some foundational concepts that every developer should know: arrays, linked lists, stacks, queues, trees, and graphs. These structures form the building blocks of efficient code, and even if you’re not writing them by hand, knowing how they function can be useful.

## Directory Structure
```
└── src  
    └── DSA  
        └── Array 
            └── ArrayDemo.php   
        └── LinkedList
            └── CircularLinkedList
                └── LinkedList.php
                └── Node.php
            └── DoublyLinkedList
                └── LinkedList.php
                └── Node.php
            └── SinglyLinkedList
                └── LinkedList.php
                └── Node.php
└── tests  
    └── Unit  
        └── DSA  
            └── Array
                └── ArrayTest.php 
        └── LinkedList
            └── SinglyLinkedListTest.php 
            └── DoublyLinkedListTest.php 
            └── CircularLinkedListTest.php 
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

## Linked List
A Linked List is a fundamental data structure that consists of a sequence of nodes, where each node contains data and a reference (or pointer) to the next node in the sequence. Linked lists allow for dynamic resizing as elements are added or removed. This makes linked lists more flexible than arrays in certain scenarios.

There are three main types of linked lists:

- **Singly Linked List**: Each node contains data and a pointer to the next node.
- **Doubly Linked List**: Each node contains data, a pointer to the next node, and a pointer to the previous node.
- **Circular Linked List**: The last node points back to the first node, forming a circular structure.

### Files Overview
- **DSA/LinkedList/SinglyLinkedList/LinkedList.php**: Implements the basic operations of a singly linked list, such as insertion, deletion, and traversal.
- **DSA/LinkedList/DoublyLinkedList/LinkedList.php**: Implements a doubly linked list, allowing traversal in both directions (forward and backward).
- **DSA/LinkedList/CircularLinkedList/LinkedList.php**: Implements a circular linked list, where the last node points to the first node to create a circular reference.