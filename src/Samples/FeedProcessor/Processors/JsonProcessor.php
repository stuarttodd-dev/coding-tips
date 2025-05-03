<?php

namespace HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors;

use HalfShellStudios\CodingTips\Samples\FeedProcessor\Abstractions\BaseProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Exceptions\FileIsMalformedException;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Interface\FeedProcessor;
use Exception;

class JsonProcessor extends BaseProcessor implements FeedProcessor
{
    /**
     * @throws FileIsMalformedException
     * @throws \Exception
     */
    #[\Override]
    public function process(): void
    {
        try {
            $this->recordsJson = (string)file_get_contents($this->filePath);
            $this->dataObject = json_decode($this->recordsJson);
            if ($this->dataObject === null) {
                throw new FileIsMalformedException('unable to parse');
            }

            $this->recordsArray = (array)json_decode($this->recordsJson, true);
        } catch (Exception $exception) {
            throw new FileIsMalformedException(
                $exception->getMessage()
            );
        }
    }
}
