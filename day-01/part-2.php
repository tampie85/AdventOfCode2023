<?php

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/advent-of-code-2023/day-01/input.txt';
$sum = 0;

/**
 * Replaces spelled-out digit words and specific word combinations in a string with their numeric equivalents.
 *
 * @param string $word The input string containing spelled-out digit words and specific combinations.
 * @return array|string The modified string with digit words and specific combinations replaced by numeric values.
 */
function replaceSubstringsWithNumbers(string $word): array|string
{
    $replacements = [
        'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'
    ];

    // Specific replacements to handle combinations
    $specificReplacements = [
        'oneight' => 'oneeight',
        'threeight' => 'threeeight',
        'fiveight' => 'fiveeight',
        'nineight' => 'nineeight',
        'twone' => 'twoone',
        'sevenine' => 'sevennine',
        'eightwo' => 'eighttwo'
    ];

    // Apply specific replacements
    foreach ($specificReplacements as $search => $replace) {
        $word = str_replace($search, $replace, $word);
    }

    // Replace spelled-out digits with numbers
    foreach ($replacements as $index => $replacement) {
        $word = str_replace($replacement, $index + 1, $word);
    }

    return $word;
}

/**
 * Retrieves the first numeric digit found in a given string.
 *
 * @param string $word The string to be scanned for the first numeric digit.
 * @return string|null The first numeric digit found in the string, or null if no digit is found.
 */
function getFirstNum(string $word): ?string
{
    return preg_match('/\d/', $word, $match) ? $match[0] : null;
}

/**
 * Retrieves the last numeric digit found in a given string.
 *
 * @param string $word The string to be scanned for the last numeric digit.
 * @return string|null The last numeric digit found in the string, or null if no digit is found.
 */
function getLastNum(string $word): ?string
{
    if (preg_match('/\d(?!.*\d)/', $word, $match)) {
        return $match[0];
    }
    return null;
}


    $data = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $sum = 0;

    foreach ($data as $line) {
        $line = replaceSubstringsWithNumbers($line);
        $firstNum = getFirstNum($line);
        $lastNum = getLastNum($line);

        if ($firstNum !== null && $lastNum !== null) {
            $sum += (int)("$firstNum$lastNum");
        }
    }
    echo $sum;
