<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Devices\Radio;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Devices\Television;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Remotes\BasicRemoteControl;
use HalfShellStudios\CodingTips\DesignPatterns\Structural\Bridge\Remotes\AdvancedRemoteControl;

it('can turn on the radio using the basic remote', function (): void {
    $radio = new Radio();
    $basicRemote = new BasicRemoteControl($radio);

    expect($basicRemote->turnOn())->toEqual('Turning on the radio');
});

it('can mute the radio using the advanced remote', function (): void {
    $radio = new Radio();
    $advancedRemote = new AdvancedRemoteControl($radio);

    expect($advancedRemote->mute())->toEqual('Muting the radio');
});

it('can turn on the television using the basic remote', function (): void {
    $tv = new Television();
    $basicRemote = new BasicRemoteControl($tv);

    expect($basicRemote->turnOn())->toEqual('Turning on the television');
});

it('can mute the television using the advanced remote', function (): void {
    $tv = new Television();
    $advancedRemote = new AdvancedRemoteControl($tv);

    expect($advancedRemote->mute())->toEqual('Muting the television');
});

it('can switch between devices and remotes', function (): void {
    $radio = new Radio();
    $tv = new Television();

    $basicRemoteForRadio = new BasicRemoteControl($radio);
    $advancedRemoteForTV = new AdvancedRemoteControl($tv);

    expect($basicRemoteForRadio->turnOn())->toEqual('Turning on the radio');
    expect($advancedRemoteForTV->mute())->toEqual('Muting the television');
});
