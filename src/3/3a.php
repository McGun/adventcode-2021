<?php

require_once(__DIR__.'/../../vendor/autoload.php');

use Code\Getter;
$Input = new Getter;
$inputDir = __DIR__.'/../../inputs/'.basename(__DIR__);

$input = $Input->getInputAsArray($inputDir.'/input.txt');

$gamma = '';
$epsilon = '';
$numberOfBits = strlen($input[0]);
$position = -1;

for ($i=0; $i<$numberOfBits; $i++) {
    $ones = 0;
    $zeros = 0;

    foreach ($input as $row)  {
        if ('1' === substr($row, $position, 1)) {
            $ones++;
        } else {
            $zeros++;
        }
    }

    if ($zeros < $ones) {
        $gamma = '1'.$gamma;
        $epsilon = '0'.$epsilon;
    } else {
        $gamma = '0'.$gamma;
        $epsilon = '1'.$epsilon;
    }

    $position--;
}

printf(
    "Gamma: %s (Decimal: %d)\nEpsilon: %s (Decimal: %d)\nPower consumption: %d\n\n",
    $gamma,
    bindec($gamma),
    $epsilon,
    bindec($epsilon),
    bindec($gamma) * bindec($epsilon)
);


