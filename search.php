<?php

use Zerifas\iTunes\Library;
use Zerifas\iTunes\Track;

require_once __DIR__ . '/vendor/autoload.php';

$terms = array_slice($argv, 1);
if (!count($terms)) {
    echo 'You must pass in some search terms!', PHP_EOL;
    exit(1);
}

// Tracks that match the search
$tracks = [];

// Loop over the library, matching against each term
$library = new Library(__DIR__ . '/Library.xml');
foreach ($library->getTracks() as $track) {
    $s = (string) $track;

    foreach ($terms as $term) {
        if (stripos($s, $term) !== false) {
            $tracks[] = $track;
            break; // Don't match the same track more than once
        }
    }
}

usort($tracks, [Track::class, 'sort']);

foreach ($tracks as $track) {
    echo (string) $track, PHP_EOL;
}
