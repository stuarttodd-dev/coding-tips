<?php

namespace HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors;

use HalfShellStudios\CodingTips\Samples\FeedProcessor\Abstractions\BaseProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Exceptions\FileIsMalformedException;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Interface\FeedProcessor;
use League\Csv\Reader;
use Exception;

class TxtProcessor extends BaseProcessor implements FeedProcessor
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
            $this->dataObject->setDelimiter("\t");
            $this->dataObject->setHeaderOffset(0);
            $this->recordsArray = iterator_to_array($this->dataObject->getRecords());

            foreach ($this->recordsArray as &$record) {
                array_walk_recursive($record, function (&$item): void {
                    if (!mb_check_encoding($item, 'UTF-8')) {
                        $item = mb_convert_encoding($item, 'UTF-8', 'auto');
                    }
                });
            }

            $this->recordsJson = (string)json_encode($this->recordsArray);
        } catch (Exception $exception) {
            throw new FileIsMalformedException(
                $exception->getMessage()
            );
        }
    }
}
