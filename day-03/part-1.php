<?php

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/advent-of-code-2023/day-03/input.txt';

// Function to find numbers in a line and their positions
function findNumbers($line): array
{
    preg_match_all('/\d+/', $line, $matches, PREG_OFFSET_CAPTURE);
    return array_map(function($match) {
        return ['number' => intval($match[0]), 'position' => $match[1]];
    }, $matches[0]);
}

// Function to check if a substring contains any symbols
function containsSymbol($substring): false|int
{
    return preg_match('/[^0-9.]+/', $substring);
}

// Function to calculate the total for a line
function calculateLineTotal($line, $prevLine, $nextLine): mixed
{
    $numberMatches = findNumbers($line);
    $totalForLine = 0;

    foreach ($numberMatches as $num) {
        $numStrLength = strlen((string)$num['number']);
        $startPos = max(0, $num['position'] - 1);
        $length = $numStrLength + ($num['position'] > 0 ? 2 : 1);

        foreach ([$line, $prevLine, $nextLine] as $l) {
            if ($l && containsSymbol(substr($l, $startPos, $length))) {
                $totalForLine += $num['number'];
                break; // No need to check other lines if one line has a symbol
            }
        }
    }

    return $totalForLine;
}

// Reading the file and processing each line
    $data = file($filePath, FILE_IGNORE_NEW_LINES);
    $result = array_reduce(array_keys($data), function($acc, $idx) use ($data) {
        return $acc + calculateLineTotal($data[$idx], $data[$idx - 1] ?? null, $data[$idx + 1] ?? null);
    }, 0);

    echo $result . "\n";
