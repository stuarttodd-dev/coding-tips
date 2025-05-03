<?php

namespace HalfShellStudios\CodingTips\Samples\FeedProcessor;

use HalfShellStudios\CodingTips\Samples\FeedProcessor\Interface\FeedProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors\CsvProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors\JsonProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors\RssProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors\TxtProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors\XmlProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Exceptions\FileDoesNotExistException;
use InvalidArgumentException;

class FeedProcessorFactory
{
    /**
     * @throws FileDoesNotExistException
     */
    public static function make(string $filePath): FeedProcessor
    {
        if (!file_exists($filePath)) {
            throw new FileDoesNotExistException($filePath);
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        return match ($extension) {
            'csv'  => new CsvProcessor($filePath),
            'rss'  => new RssProcessor($filePath),
            'txt'  => new TxtProcessor($filePath),
            'xml'  => new XmlProcessor($filePath),
            'json' => new JsonProcessor($filePath),
            default => throw new InvalidArgumentException('Unsupported file type: ' . $extension),
        };
    }
}
