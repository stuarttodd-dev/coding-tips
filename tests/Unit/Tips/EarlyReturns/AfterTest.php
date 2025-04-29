<?php

use HalfShellStudios\CodingTips\Tips\EarlyReturns\After;

beforeEach(function (): void {
    $this->validator = new After();
});

test('valid user returns true', function (): void {
    $user = [
        'age' => 25,
        'email' => 'test@example.com',
        'name' => 'Stu',
    ];

    expect($this->validator->isValid($user))->toBeTrue();
});

test('returns false if age is under or equal to 18', function (): void {
    $user = [
        'age' => 18,
        'email' => 'test@example.com',
        'name' => 'Stu',
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});

test('returns false if email is missing', function (): void {
    $user = [
        'age' => 25,
        'name' => 'Stu',
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});

test('returns false if email is invalid', function (): void {
    $user = [
        'age' => 25,
        'email' => 'not-an-email',
        'name' => 'Stu',
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});

test('returns false if name is 0', function (): void {
    $user = [
        'age' => 25,
        'email' => 'test@example.com',
        'name' => 0,
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});

test('returns false if name is "0"', function (): void {
    $user = [
        'age' => 25,
        'email' => 'test@example.com',
        'name' => '0',
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});

test('returns false if name is empty string', function (): void {
    $user = [
        'age' => 25,
        'email' => 'test@example.com',
        'name' => '',
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});

test('returns false if name is missing', function (): void {
    $user = [
        'age' => 25,
        'email' => 'test@example.com',
    ];

    expect($this->validator->isValid($user))->toBeFalse();
});
