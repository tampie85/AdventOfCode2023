<?php

// Path to the text file containing the games
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/advent-of-code-2023/day-02/input.txt';

// Function to find the minimum number of cubes and their power for each game
function findMinimumCubesAndPower($games): float|int
{
    $totalPower = 0;

    foreach ($games as $game) {
        list(, $roundsStr) = explode(': ', $game);
        $rounds = explode("; ", $roundsStr);

        // Initializing the minimum required cubes for each color
        $minCubes = ['red' => 0, 'green' => 0, 'blue' => 0];

        foreach ($rounds as $round) {
            $cubes = explode(", ", $round);
            foreach ($cubes as $cube) {
                list($count, $color) = explode(" ", $cube);
                $minCubes[$color] = max($minCubes[$color], intval($count));
            }
        }

        // Calculating the power of the game
        $power = $minCubes['red'] * $minCubes['green'] * $minCubes['blue'];
        $totalPower += $power;
    }

    return $totalPower;
}

// Read the file and process each game
$games = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$totalPower = findMinimumCubesAndPower($games);

echo 'Sum of the power of the minimum sets of cubes: ' . $totalPower;
