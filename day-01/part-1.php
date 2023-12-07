<?php

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/advent-of-code-2023/day-01/input.txt';
$sum = 0;

// Read the file line by line
$lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    // Extract the first digit
    preg_match('/\d/', $line, $firstDigitMatch);
    $firstDigit = $firstDigitMatch[0];

    // Extract the last digit
    preg_match('/\d(?=\D*$)/', $line, $lastDigitMatch);
    $lastDigit = $lastDigitMatch[0];

    // Combine and add to sum
    $sum += (int)($firstDigit . $lastDigit);
}

echo 'The sum of all calibration values is: ' . $sum ;
