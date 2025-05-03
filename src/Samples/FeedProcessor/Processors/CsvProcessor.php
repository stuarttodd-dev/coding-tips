<?php

namespace HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors;

use HalfShellStudios\CodingTips\Samples\FeedProcessor\Abstractions\BaseProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Exceptions\FileIsMalformedException;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Interface\FeedProcessor;
use League\Csv\Reader;
use Exception;

class CsvProcessor extends BaseProcessor implements FeedProcessor
{
    /**
     * @throws FileIsMalformedException
     * @SuppressWarnings("StaticAccess")
     */
    #[\Override]
    public function process(): void
    {
        try {
            $this->dataObject = Reader::createFromPath($this->filePath, 'r');
            $this->dataObject->setHeaderOffset(0);
            $this->recordsArray = iterator_to_array($this->dataObject->getRecords());
            $this->recordsJson = (string)json_encode($this->recordsArray);
        } catch (Exception $exception) {
            throw new FileIsMalformedException(
                $exception->getMessage()
            );
        }
    }
}
