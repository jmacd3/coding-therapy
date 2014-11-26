<?php

require_once '../bootstrap.php';
use CodingTherapy\ChangeMaker\CurrencyContainer;

define('DEFAULT_CONFIG', 'currency_us');

// Set up options
$shortOpts = 'c:h';
$longopts  = array(
    'config:',     // Required value
    'help'
);

$options = getopt($shortOpts, $longopts);

// Show help message
if (isset($options['h']) || isset($options['help'])) {
    showUsage();
    exit;
}

// Read in config file
$amountIndex = 1;
$paymentIndex = 2;
if (isset($options['c'])) {
    $filePath = $options['c'];
} elseif (isset($options['config'])) {
    $filePath = $options['config'];
} else {
    $filePath = DEFAULT_CONFIG;
}

if (isset($options['c']) || isset($options['config'])) {
    $amountIndex = 3;
    $paymentIndex = 4;

}


// Check file path
if (! file_exists($filePath)) {
    echo 'Invalid config file path' . PHP_EOL;
    exit;
} else {
    // If we have a currency config load it up
    $currencyConfig = include_once $filePath;

    $currencyContainer = new CurrencyContainer($currencyConfig);

}



if (!isset($argv[$amountIndex], $argv[$paymentIndex])) {
    echo 'Invalid params... '. PHP_EOL;
    showUsage();

    exit;
}

$currencyCnts = array();

$amountDue = floatval($argv[$amountIndex]);
$payment = floatval($argv[$paymentIndex]);

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
$changeDelta = round($fraction * 100);

foreach($currencyContainer as $currencyUnit) {

    if ($currencyUnit['value'] >= 1) {
        if ($dollarDelta >= $currencyUnit['value']) {
            $currencyCnt = intval($dollarDelta / $currencyUnit['value']);
            $currencyCnts[$currencyUnit['name']] = $currencyCnt;
            $dollarDelta -= ( $currencyUnit['value'] * $currencyCnt );
        }
    } else {
        $adjustedCurrencyUnit = $currencyUnit['value'] * 100;
        if ($changeDelta >= $adjustedCurrencyUnit) {
            $currencyCnt = intval($changeDelta / ($adjustedCurrencyUnit));
            $currencyCnts[$currencyUnit['name']] = $currencyCnt;
            $changeDelta -= ( $adjustedCurrencyUnit * $currencyCnt );

        }
    }
}

$remainder = intval($dollarDelta) + $changeDelta;

if ($remainder > 0) {
    echo 'Unable to provide sufficiet change with currency config.' . PHP_EOL;
    echo 'Remainder: ' . $remainder . PHP_EOL;
}

// Display Denomination Cnts
foreach ($currencyCnts as $name => $count) {
    echo $name . ': ' . $count . PHP_EOL;
}

function showUsage() {
    echo "Usage: php calculateChange [OPTION]... {amountDue} {payment};" . PHP_EOL;
    echo PHP_EOL;
    echo "OPTIONS" . PHP_EOL;
    echo "\t   -c,--config \t Path to denomniation config file (see currency_us for example)" . PHP_EOL;
}

exit;