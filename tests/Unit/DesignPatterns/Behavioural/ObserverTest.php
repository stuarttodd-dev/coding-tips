<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\AlternativeVersion\UserRegisters as AltVersion;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Observers\LogActivity;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Observers\SaveUserAccount;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Observers\SendWelcomeEmail;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Observer;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\Interfaces\Subject;
use HalfShellStudios\CodingTips\DesignPatterns\Behavioural\Observer\UserRegisters;

it('can attach observers', function (): void {

    $logActivity = new LogActivity();
    $sendWelcomeEmail = new SendWelcomeEmail();
    $saveUserAccount = new SaveUserAccount();

    $subject = (new UserRegisters())
        ->attach($logActivity)
        ->attach($sendWelcomeEmail)
        ->attach($saveUserAccount);

    expect($subject->observers)->toContain($logActivity);
    expect($subject->observers)->toContain($sendWelcomeEmail);
    expect($subject->observers)->toContain($saveUserAccount);
    expect($subject->observers)->toHaveCount(3);
});

it('can detach observers', function (): void {

    $logActivity = new LogActivity();
    $sendWelcomeEmail = new SendWelcomeEmail();
    $saveUserAccount = new SaveUserAccount();

    $subject = (new UserRegisters())
        ->attach($logActivity)
        ->attach($sendWelcomeEmail)
        ->attach($saveUserAccount)
        ->detach($sendWelcomeEmail)
        ->detach($saveUserAccount);

    expect($subject->observers)->toContain($logActivity);
    expect($subject->observers)->not()->toContain($sendWelcomeEmail);
    expect($subject->observers)->not()->toContain($saveUserAccount);
    expect($subject->observers)->toHaveCount(1);
});

it('calls logActivity, saveUserAccount, and sendWelcomeEmail when notify is called', function (): void {

    $logActivityMock = Mockery::mock(LogActivity::class);
    $sendWelcomeEmailMock = Mockery::mock(SendWelcomeEmail::class);
    $saveUserAccountMock = Mockery::mock(SaveUserAccount::class);

    $logActivityMock->shouldReceive('handle')->once();
    $sendWelcomeEmailMock->shouldReceive('handle')->once();
    $saveUserAccountMock->shouldReceive('handle')->once();

    $subject = (new UserRegisters())
        ->attach($logActivityMock)
        ->attach($sendWelcomeEmailMock)
        ->attach($saveUserAccountMock);

    $subject->notify();

    expect($subject->observers)->toHaveCount(3);

    Mockery::close();
});

test('UserRegisters class implements Subject interface', function (): void {
    $class = new UserRegisters();
    expect($class)->toBeInstanceOf(Subject::class);
});

test('LogActivity class implements Observer interface', function (): void {
    $class = new LogActivity();
    expect($class)->toBeInstanceOf(Observer::class);
});

test('SaveUserAccount class implements Observer interface', function (): void {
    $class = new SaveUserAccount();
    expect($class)->toBeInstanceOf(Observer::class);
});

test('SendWelcomeEmail class implements Observer interface', function (): void {
    $class = new SendWelcomeEmail();
    expect($class)->toBeInstanceOf(Observer::class);
});

test('Alternative version calls logActivity, saveUserAccount, and sendWelcomeEmail when notify is called', function (): void {
    $mock = Mockery::mock(AltVersion::class)->makePartial();
    $mock->shouldReceive('logActivity')->once();
    $mock->shouldReceive('saveUserAccount')->once();
    $mock->shouldReceive('sendWelcomeEmail')->once();
    $mock->notify();
});
