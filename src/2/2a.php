<?php

require_once(__DIR__.'/../../vendor/autoload.php');

use Code\Getter;
$Input = new Getter;
$inputDir = __DIR__.'/../../inputs/'.basename(__DIR__);

$x = 0;
$depth = 0;

foreach ($Input->getInputAsArray($inputDir.'/inputTest.txt') as $row)  {
    $row = explode(' ', $row);

    if ('forward' === $row[0]) {
        $x = $x + (int) $row[1];
    } elseif ('up' === $row[0]) {
        $depth = $depth - (int) $row[1];
    } elseif ('down' === $row[0]) {
        $depth = $depth + (int) $row[1];
    }
}

printf(
    "Result: %d x %d = %d\n\n",
    $x,
    $depth,
    $x * $depth
);
