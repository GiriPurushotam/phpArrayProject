<?php

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH',  $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . '/');
define('VIEW_PATH', $root . 'view' . '/');

require APP_PATH . 'App.php';
require  APP_PATH . 'helper.php';
$files = getTransactionFiles(FILES_PATH);
$transactions = [];
foreach ($files as $file) {
    //accessing the method 
    // $transactions = array_merge($transactions, getTransactions($file));

    // this extractTransaction addel later after creating the handler in app.php file now we can directly all the multiple method like this --//
    $transactions = array_merge($transactions, getTransactions($file, 'extractTransaction'));
}

// this is dublicate line one advantage of creating the handler that if we have multiple payment files we dont have to make multiple method and functions we can simppley dublicate this line and this works perfectly fine //
/* *
files = getTransactionFiles(OTHERS_FILES_PATH);
$transactions = [];
foreach ($files as $file) {
    $transactions = array_merge($transactions, getTransactions($file, 'extractTransactionFromOtherFile'));
}
    */
//var_dump($files);
//print_r($transactions);

$totals = calculateTotal($transactions);

require VIEW_PATH . 'Transactions.php';
