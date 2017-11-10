<?php

namespace Zerifas\iTunes;

use SimpleXMLElement;

class Track
{
    const KEY_ARTIST = 'Artist';
    const KEY_ALBUM = 'Album';
    const KEY_NAME = 'Name';

    private $artist;
    private $album;
    private $name;

    public static function sort(Track $a, Track $b)
    {
        $artistSort = strnatcasecmp($a->getArtist(), $b->getArtist());
        if ($artistSort !== 0) {
            return $artistSort;
        }

        $albumSort = strnatcasecmp($a->getAlbum(), $b->getAlbum());
        if ($albumSort !== 0) {
            return $albumSort;
        }

        $nameSort = strnatcasecmp($a->getName(), $b->getName());
        if ($nameSort !== 0) {
            return $nameSort;
        }

        return 0;
    }

    public function __construct(SimpleXMLElement $xml)
    {
        $this->data = [];

        $key = null;
        foreach ($xml->children() as $tagName => $tag) {
            if ($tagName === Library::TAG_KEY) {
                $key = (string) $tag;
                continue;
            }

            switch ($key) {
                case self::KEY_ARTIST:
                    $this->artist = (string) $tag;
                    break;

                case self::KEY_ALBUM:
                    $this->album = (string) $tag;
                    break;

                case self::KEY_NAME:
                    $this->name = (string) $tag;
                    break;
            }
        }
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getAlbum()
    {
        return $this->album;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return "{$this->artist} - {$this->album} - {$this->name}";
    }
}
