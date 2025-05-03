<?php

namespace HalfShellStudios\CodingTips\Samples\FeedProcessor\Processors;

use HalfShellStudios\CodingTips\Samples\FeedProcessor\Abstractions\BaseProcessor;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Exceptions\FileIsMalformedException;
use HalfShellStudios\CodingTips\Samples\FeedProcessor\Interface\FeedProcessor;
use SimpleXMLElement;
use Throwable;

class RssProcessor extends BaseProcessor implements FeedProcessor
{
    private string $namespacePrefix = 'g';

    public function setNamespacePrefix(string $prefix): self
    {
        $this->namespacePrefix = $prefix;

        return $this;
    }

    /**
     * @throws FileIsMalformedException
     */
    #[\Override]
    public function process(): void
    {
        try {
            libxml_use_internal_errors(true);
            $contents = (string)file_get_contents($this->filePath);
            $this->dataObject = new SimpleXMLElement($contents);

            $index = 0;
            $items = $this->dataObject->channel->item;
            foreach ($items as $item) {
                $children = $item->children($this->namespacePrefix, true) ?? null;
                if ($children === null) {
                    continue;
                }

                foreach ($children as $key => $value) {
                    $key = trim((string) $key);
                    $value = trim((string) $value);
                    $this->recordsArray[$index][$key] = $value;
                }

                $index++;
            }

            $this->recordsJson = (string)json_encode($this->recordsArray);
        } catch (Throwable $throwable) {
            throw new FileIsMalformedException(
                $throwable->getMessage()
            );
        }
    }
}
