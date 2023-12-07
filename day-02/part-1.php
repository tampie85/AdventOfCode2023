<?php

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/advent-of-code-2023/day-02/input.txt';

// Maximum number of cubes of each color in the bag
$maxCubes = ['red' => 12, 'green' => 13, 'blue' => 14];

// Function to check if a game is possible
function isGamePossible($gameStr, $maxCubes): array
{
    list($gameIdStr, $roundsStr) = explode(': ', $gameStr);
    $gameId = intval(str_replace('Game ', '', $gameIdStr));
    $rounds = explode('; ', $roundsStr);

    foreach ($rounds as $round) {
        $cubes = explode(', ', $round);
        foreach ($cubes as $cube) {
            list($count, $color) = explode(' ', $cube);
            if (intval($count) > $maxCubes[$color]) {
                return [false, $gameId];
            }
        }
    }
    return [true, $gameId];
}

// Read the file and process each game
$possibleGamesSum = 0;
$games = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($games as $game) {
    list($possible, $gameId) = isGamePossible($game, $maxCubes);
    if ($possible) {
        $possibleGamesSum += $gameId;
    }
}

echo 'Sum of IDs of possible games: ' . $possibleGamesSum;
