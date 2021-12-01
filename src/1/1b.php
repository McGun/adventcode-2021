<?php

require_once(__DIR__.'/../../vendor/autoload.php');

use Code\Getter;
$Input = new Getter;
$inputDir = __DIR__.'/../../inputs/'.basename(__DIR__);

$inputArray = $Input->getInputAsArray($inputDir.'/input.txt');

$slidingWindowArray = [];
$rowCount = 0;
$sum = 0;

$rows = count($inputArray);

for ($i=0; $i<$rows; $i++) {
    $next = $i + 1;

    if ($next + 1 >= $rows) {
        break;
    }

    $slidingWindowArray[] = $inputArray[$i] + $inputArray[$next] + $inputArray[$next + 1];
}

$countInc = 0;
$countDec = 0;
$previous = 0;

foreach ($slidingWindowArray as $row)  {
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
