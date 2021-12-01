<?php

require_once(__DIR__.'/../../vendor/autoload.php');

use Code\Getter;
$Input = new Getter;
$inputDir = __DIR__.'/../../inputs/'.basename(__DIR__);

$countInc = 0;
$countDec = 0;
$previous = 0;

foreach ($Input->getInputAsArray($inputDir.'/input.txt') as $row)  {
    $row = (int) $row;

    if (!$previous) {
        echo "N/A...\n";
        $previous = $row;
        continue;
    }

    if ($previous < $row) {
        $countInc++;
    }

    if ($previous > $row) {
        $countDec++;
    }

    $previous = $row;
}

printf(
    "Number of increase: %d\nNumber of decrease: %d\n\n",
    $countInc,
    $countDec
);
