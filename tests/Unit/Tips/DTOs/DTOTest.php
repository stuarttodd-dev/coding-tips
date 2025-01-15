<?php

use HalfShellStudios\CodingTips\Tips\DTOs\UserDTO;
use HalfShellStudios\CodingTips\Tips\DTOs\SimpleUserDTO;

it('can create a UserDTO instance', function () {
    $user = new UserDTO(
        name: 'John Doe',
        email: 'johndoe@example.com',
        age: 30
    );

    expect($user)
        ->name->toBe('John Doe')
        ->email->toBe('johndoe@example.com')
        ->age->toBe(30);
});

it('can create a UserDTO instance from response', function () {
    $response = [
        'full_name' => 'Jane Smith',
        'email_address' => 'janesmith@example.com',
        'age' => '25',
    ];

    $user = UserDTO::fromResponse($response);

    expect($user)
        ->name->toBe('Jane Smith')
        ->email->toBe('janesmith@example.com')
        ->age->toBe(25);
});

it('can create a SimpleUserDTO instance', function () {
    $user = new SimpleUserDTO(
        name: 'Alice Johnson',
        email: 'alicejohnson@example.com',
        age: 22
    );

    expect($user)
        ->name->toBe('Alice Johnson')
        ->email->toBe('alicejohnson@example.com')
        ->age->toBe(22);
});
