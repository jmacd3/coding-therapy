<?php
// Processs cmd line args
if (!isset($argv[1], $argv[2])) {
    echo 'Invalid params... '. PHP_EOL;
    echo "\t usage: php calculateChange {amountDue} {payment};" . PHP_EOL;
    exit;
}

$amountDue = floatval($argv[1]);
$payment = floatval($argv[2]);

$change = $payment - $amountDue;
$dollarDelta = $change;
//Display change
echo $change . PHP_EOL;

if ($change < 0) {
    echo 'Insufficient funds...' . PHP_EOL;
    exit;
}

// Calculate change
$fraction = $change - intval($change);
$changeDelta = $fraction * 100;


$twentyDollarCnt = 0;
$tenDollarCnt    = 0;
$fiveDollarCnt   = 0;
$oneDollarCnt    = 0;

$quarterCnt = 0;
$dimeCnt    = 0;
$nickelCnt  = 0;
$pennyCnt   = 0;

if ($dollarDelta >= 20) {
    $twentyDollarCnt = intval($dollarDelta / 20);
    $dollarDelta -= ( 20 * $twentyDollarCnt );
}

if ($dollarDelta >= 10) {
    $tenDollarCnt = intval($dollarDelta / 10);
    $dollarDelta -= ( 10 * $tenDollarCnt );
}

if ($dollarDelta >= 5) {
    $fiveDollarCnt = intval($dollarDelta / 5);
    $dollarDelta -= ( 5 * $fiveDollarCnt );
}

if ($dollarDelta >= 1) {
    $oneDollarCnt = intval($dollarDelta);
}

if ($changeDelta >= 25) {
    $quarterCnt = intval($changeDelta / 25);
    $changeDelta -= ( 25 * $quarterCnt );
}

if ($changeDelta >= 10) {
    $dimeCnt = intval($changeDelta / 10);
    $changeDelta -= ( 10 * $dimeCnt );
}

if ($changeDelta >= 5) {
    $nickelCnt = intval($changeDelta / 5);
    $changeDelta -= ( 5 * $nickelCnt );
}

if ($changeDelta) {
    $pennyCnt = round($changeDelta);
}

if ($twentyDollarCnt) {
    echo 'Twenty Dollar: ' . $twentyDollarCnt . PHP_EOL;
}

if ($tenDollarCnt) {
    echo 'Ten Dollar: ' . $tenDollarCnt . PHP_EOL;
}

if ($fiveDollarCnt) {
    echo 'Five Dollar: ' . $fiveDollarCnt . PHP_EOL;
}

if ($oneDollarCnt) {
    echo 'One Dollar: ' . $oneDollarCnt . PHP_EOL;
}

if ($quarterCnt) {
    echo 'Quarter: ' . $quarterCnt . PHP_EOL;
}

if ($dimeCnt) {
    echo 'Dime: ' . $dimeCnt . PHP_EOL;
}

if ($nickelCnt) {
    echo 'Nickel: ' . $nickelCnt . PHP_EOL;
}

if ($pennyCnt >=  1) {
    echo 'Penny: ' . $pennyCnt . PHP_EOL;
}


exit;