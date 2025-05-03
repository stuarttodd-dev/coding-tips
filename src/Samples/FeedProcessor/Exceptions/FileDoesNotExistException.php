<?php

namespace HalfShellStudios\CodingTips\Samples\FeedProcessor\Exceptions;

use Exception;

class FileDoesNotExistException extends Exception
{
    public function __construct(string $path)
    {
        parent::__construct('File does not exist: ' . $path);
    }
}
