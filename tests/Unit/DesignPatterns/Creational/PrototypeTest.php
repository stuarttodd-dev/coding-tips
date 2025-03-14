<?php

declare(strict_types=1);

use HalfShellStudios\CodingTips\DesignPatterns\Creational\Prototype\Book;

it('clones a book and modifies it without affecting the original', function (): void {
    $originalBook = new Book("The Pragmatic Programmer", "Andrew Hunt & David Thomas");

    $clonedBook = $originalBook->clone();
    $clonedBook->title = "Clean Code";
    $clonedBook->author = "Robert C. Martin";

    expect($originalBook->title)->toBe("The Pragmatic Programmer");
    expect($originalBook->author)->toBe("Andrew Hunt & David Thomas");

    expect($clonedBook->title)->toBe("Clean Code");
    expect($clonedBook->author)->toBe("Robert C. Martin");

    expect($clonedBook)->not->toBe($originalBook);
});
