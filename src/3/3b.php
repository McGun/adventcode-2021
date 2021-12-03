<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use Code\Getter;

$Input = new Getter;
$inputDir = __DIR__ . '/../../inputs/' . basename(__DIR__);

$input = $Input->getInputAsArray($inputDir . '/input.txt');

$oxygenRating = '';
$co2Rating = '';
$numberOfBits = strlen($input[0]);
$position = 1;

function compareBits(array $rows, int $position, string $condition): string
{
    $position = $position - 1;
    $ones = 0;
    $zeros = 0;

    foreach ($rows as $row) {
        if ('1' === substr($row, $position, 1)) {
            $ones++;
        } else {
            $zeros++;
        }
    }

    if ($zeros < $ones || $zeros === $ones) {
        return ('mostCommon' === $condition) ? '1' : '0';
    } else {
        return ('mostCommon' === $condition) ? '0' : '1';
    }
}

function getFilteredArray(array $inputArray, string $filter, int $position): array
{
    $filteredArray = [];
    $position = $position - 1;

    foreach ($inputArray as $row) {
        if (substr($row, $position, 1) === $filter) {
            $filteredArray[] = $row;
        }
    }

    return $filteredArray;
}

$oxygenFiltered = $input;
$co2Filtered = $input;

foreach ($input as $i) {
    if (count($oxygenFiltered) !== 1) {
        $mostCommonBit = compareBits($oxygenFiltered, $position, 'mostCommon');
        $oxygenFiltered = getFilteredArray($oxygenFiltered, $mostCommonBit, $position);
    }

    if (count($co2Filtered) !== 1) {
        $leastCommonBit = compareBits($co2Filtered, $position, 'leastCommon');
        $co2Filtered = getFilteredArray($co2Filtered, $leastCommonBit, $position);
    }

    if (count($oxygenFiltered) === 1) {
        $oxygenRating = $oxygenFiltered[0];
    }

    if (count($co2Filtered) === 1) {
        $co2Rating = $co2Filtered[0];
    }

    if (count($co2Filtered) === 1 && count($oxygenFiltered) === 1) {
        break;
    }

    $position++;
}

printf(
    "Oxygen: %s (Decimal: %d)\nCO2: %s (Decimal: %s)\nLife support rating: %d\n",
    $oxygenRating,
    bindec($oxygenRating),
    $co2Rating,
    bindec($co2Rating),
    bindec($oxygenRating) * bindec($co2Rating)
);
