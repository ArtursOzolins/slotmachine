<?php

$cash = 200;
echo "Your current amount: {$cash}$" . PHP_EOL;
$inputPlayAgain = readline('SPIN? y/n: ');


while ($inputPlayAgain === 'y') {

    $inputPlaceBet = (int)readline('How much you want to bet: ');

if ($inputPlaceBet > $cash) {
    echo 'You dont have that much cash :(' . PHP_EOL;
    exit;
}

    $uniqueSymbolsWon = [];

    $wonCount = 0;

    $symbols = [
        1 => 'A',
        2 => 'A',
        3 => 'A',
        4 => 'A',
        5 => 'A',
        6 => 'B',
        7 => 'B',
        8 => 'B',
        9 => 'B',
        10 => 'C',
        11 => 'C',
        12 => 'C',
        13 => 'Ra',
        14 => 'Ra',
        15 => 'A',
        16 => 'A',
        17 => 'A',
        18 => 'A',
        19 => 'A',
        20 => 'B',
        21 => 'B',
        22 => 'B',
        23 => 'C',
        24 => 'C',
        25 => 'Ra'
    ];  // possible symbols

    $coefficient = [
      1 => 'A',
      2 => 'B',
      3 => 'C',
      4 => 'Ra'
    ];

    $screen = [
        [],
        [],
        []
    ];  // empty screen data array

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 4; $j++) {
            array_push($screen[$i], $symbols[array_rand($symbols)]);
        }
    }     // makes screen data full with symbol values

    $winCheck = [
        1 => [$screen[0][0], $screen[0][1], $screen[0][2], $screen[0][3]],
        2 => [$screen[1][0], $screen[1][1], $screen[1][2], $screen[1][3]],
        3 => [$screen[2][0], $screen[2][1], $screen[2][2], $screen[2][3]],
        4 => [$screen[0][0], $screen[0][1], $screen[1][2], $screen[2][3]],
        5 => [$screen[0][0], $screen[1][1], $screen[2][2], $screen[2][3]],
        6 => [$screen[2][0], $screen[1][1], $screen[0][2], $screen[0][3]],
        7 => [$screen[2][0], $screen[2][1], $screen[1][2], $screen[0][3]],
    ];   // winning combos


    foreach ($screen as $value) {
        echo implode(' ', $value) . PHP_EOL;
    }   // shows screen with symbols in console

    foreach ($winCheck as $value) {
        if (count(array_unique($value)) === 1) {
            array_push($uniqueSymbolsWon, $value[0]);
            $wonCount++;
            echo PHP_EOL;
            echo "{$value[0]} won" . PHP_EOL;
        }
    }  // checks if a combo appeared

    if ($wonCount > 0) {
        $cashToAdd = 0;
        foreach ($uniqueSymbolsWon as $value) {
            $cashToAdd += array_search($value, $coefficient) * $inputPlaceBet;
        }

        $cash += $cashToAdd;
        echo PHP_EOL;
        echo "{$cashToAdd}$ added to your funds!" . PHP_EOL;
    } else {
        $cash -= $inputPlaceBet;
    }

    echo PHP_EOL;
    echo "Your current amount: {$cash}$" . PHP_EOL;
    echo PHP_EOL;
    $inputPlayAgain = readline('SPIN? y/n: ');
    if ($cash === 0) {
        echo 'You have lost your funds, game is for people who HAVE money ONLY!' . PHP_EOL;
        $inputPlayAgain = 'n';
    }
}
