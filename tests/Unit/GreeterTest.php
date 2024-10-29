<?php

declare(strict_types=1);
use HalfShellStudios\PackageSample\Greeter;
beforeEach(function () {
    $this->greeter = new Greeter();
});
test('say hello', function () {
    $expected = 'Well, hello there!';
    $actual = $this->greeter->sayHello();
    expect($actual)->toEqual($expected, 'sayHello() should return the expected greeting.');
});
test('say goodbye', function () {
    $expected = 'Errr... Goodbye!';
    $actual = $this->greeter->sayGoodbye();
    expect($actual)->toEqual($expected, 'sayGoodbye() should return the expected farewell.');
});
test('greet', function () {
    $expected = 'Well, hello there! Errr... Goodbye!';
    $actual = $this->greeter->greet();
    expect($actual)->toEqual($expected, 'greet() should return the concatenated hello and goodbye messages.');
});
