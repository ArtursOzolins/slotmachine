<?php

$cash = 200;
echo "Your current amount: {$cash}$" . PHP_EOL;
$inputPlayAgain = readline('SPIN? y/n: ');
if ($inputPlayAgain === 'y') {
    $inputPlaceBet = (int)readline('10/20/40/80?: ');
}

while ($inputPlayAgain === 'y') {

    $won = false;

    $bets = [
        1 => 10,
        2 => 20,
        3 => 40,
        4 => 80
    ];

    $symbols = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D'
    ];  // possible symbols

    $screen = [
        [],
        [],
        []
    ];  // empty screen data array

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            array_push($screen[$i], $symbols[array_rand($symbols)]);
        }
    }     // makes screen data full with symbol values

    $winCheck = [
        1 => [$screen[0][0], $screen[0][1], $screen[0][2]],
        2 => [$screen[1][0], $screen[1][1], $screen[1][2]],
        3 => [$screen[2][0], $screen[2][1], $screen[2][2]],
        4 => [$screen[0][0], $screen[1][1], $screen[2][2]],
        5 => [$screen[0][2], $screen[1][1], $screen[2][0]],
    ];   // winning combos


    foreach ($screen as $value) {
        echo implode(' ', $value) . PHP_EOL;
    }   // shows screen with symbols in console

    foreach ($winCheck as $value) {
        if (count(array_unique($value)) === 1) {
            $won = true;
            echo PHP_EOL;
            echo "{$value[0]} won" . PHP_EOL;
        }
    }  // checks if a combo appeared

    if ($won === true) {
        $cashToAdd = array_search($inputPlaceBet, $bets) * $inputPlaceBet;
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
    if ($inputPlayAgain === 'y') {
        $inputPlaceBet = (int)readline('10/20/40/80?: ');
    }
}

