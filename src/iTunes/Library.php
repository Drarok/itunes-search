<?php

namespace Zerifas\iTunes;

class Library
{
    const TAG_KEY = 'key';
    const KEY_TRACKS = 'Tracks';

    private $xml;

    public function __construct(string $pathname)
    {
        $this->xml = simplexml_load_file($pathname);
    }

    public function getTracks()
    {
        $tracks = $this->findElement(self::KEY_TRACKS);

        foreach ($tracks->children() as $tagName => $tag) {
            if ($tagName === self::TAG_KEY) {
                continue;
            }

            yield new Track($tag);
        }
    }

    private function findElement(string $findKey)
    {
        $key = null;

        foreach ($this->xml->dict->children() as $tagName => $tag) {
            if ($tagName === self::TAG_KEY) {
                $key = (string) $tag;
                continue;
            }

            if ($key !== $findKey) {
                continue;
            }

            return $tag;
        }
    }
}
