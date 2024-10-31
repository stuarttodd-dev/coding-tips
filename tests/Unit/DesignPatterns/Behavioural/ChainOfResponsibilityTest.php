<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\AuthHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\PermissionsHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\ValidationHandler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Interfaces\Handler;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\AuthException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\PermissionException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\Exceptions\ValidationException;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\ChainOfResponsibility\AlternativeVersion\RequestProcessor;

beforeEach(function (): void {
    $this->processor = new RequestProcessor();
    $this->authHandler = new AuthHandler();
    $this->permissionsHandler = new PermissionsHandler();
    $this->validationHandler = new ValidationHandler();

    $this->authHandler
        ->setNext($this->permissionsHandler)
        ->setNext($this->validationHandler);
});

it('ensures each handler implements HandlerInterface', function (): void {
    expect($this->authHandler)->toBeInstanceOf(Handler::class);
    expect($this->permissionsHandler)->toBeInstanceOf(Handler::class);
    expect($this->validationHandler)->toBeInstanceOf(Handler::class);
});

it('handles a valid request successfully', function (): void {
    $request = [
        'user' => [
            'name' => 'John Doe',
            'roles' => ['USER', 'ADMIN']
        ],
        'data' => 'Some important data'
    ];

    expect(fn() => $this->authHandler->handle($request))->not->toThrow(Exception::class);
});

it('throws an AuthenticationException for unauthenticated user', function (): void {
    $request = [
        'data' => 'Some important data'
    ];

    $this->authHandler->handle($request);
})->throws(AuthException::class, 'User not authenticated');

it('throws an PermissionException for unauthorised user', function (): void {
    $request = [
        'user' => [
            'name' => 'Jane Doe',
            'roles' => ['USER']
        ],
        'data' => 'Some important data'
    ];

    $this->authHandler->handle($request);
})->throws(PermissionException::class, 'User not authorised');

it('throws a ValidationException for missing data field', function (): void {
    $request = [
        'user' => [
            'name' => 'John Doe',
            'roles' => ['USER', 'ADMIN']
        ],
        'data' => ''
    ];

    $this->authHandler->handle($request);
})->throws(ValidationException::class, 'Request data is invalid');

it('processes a valid request successfully (alternative version)', function (): void {
    $request = [
        'user' => [
            'name' => 'John Doe',
            'roles' => ['USER', 'ADMIN'],
        ],
        'data' => 'Some important data',
    ];

    expect(fn() => $this->processor->process($request))->not->toThrow(Exception::class);
});

it('throws AuthException when user is not authenticated (alternative version)', function (): void {
    $request = [
        'data' => 'Some important data',
    ];

    $this->processor->process($request);
})->throws(AuthException::class, 'User not authenticated.');

it('throws PermissionException when user does not have admin role (alternative version)', function (): void {
    $request = [
        'user' => [
            'name' => 'Jane Doe',
            'roles' => ['USER'],
        ],
        'data' => 'Some important data',
    ];

    $this->processor->process($request);
})->throws(PermissionException::class, 'User not authorized.');

it('throws ValidationException when data field is empty (alternative version)', function (): void {
    $request = [
        'user' => [
            'name' => 'John Doe',
            'roles' => ['USER', 'ADMIN'],
        ],
        'data' => '', // Empty data
    ];

    $this->processor->process($request);
})->throws(ValidationException::class, 'Invalid data provided.');