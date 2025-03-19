<?php

declare(strict_types=1);

function getTransactionFiles(string $dirpath): array
{
    $files = [];

    foreach (scandir($dirpath) as $file) {
        // checking if file is directory or not 
        if (is_dir($file)) {
            continue;
        }

        // defining empty array to the variable 
        $files[] = $dirpath . $file;
    }
    return ($files);
}


// Extracting csv file and displaying 
// This ?callable $transactionHandler added later to use different types of files from single function. even if we remove this handler the code works perfectly fine --//
function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    if (!file_exists($fileName)) {
        trigger_error('File "' . $fileName . '"does not exist.', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    fgetcsv($file);
    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {

        // -- Check for handler  -- //
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }

        // setting variable for transactions.php file //
        $transactions[] = $transaction;
        // this extractTransaction is from before makeing handler so this works perfectly fine too //
        // $transactions[] = extractTransaction($transaction);
    }
    return $transactions;
}

function extractTransaction(array $transactionRow): array
{
    [$date, $checkNumber, $discription, $ammount] = $transactionRow;
    // -- Replacing $ sign and , from transaction ammount  -- //
    $ammount = (float) str_replace(['$', ','], '', $ammount);
    // -- Replacing the date format / to -  --// 
    //$date = (string) str_replace(['/'], '-', $date);

    // changing date format within same function without helper //
    $newDateFormat = strtotime($date);
    $displayDate = date('M j, Y', $newDateFormat);
    return [
        'date' => $displayDate,
        'checkNumber' => $checkNumber,
        'discription' => $discription,
        'ammount'  => $ammount

    ];
}

// calculating the total // 
function calculateTotal(array $transactions): array
{

    // using array instead of variables //
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
    foreach ($transactions as $transaction) {
        $totals['netTotal'] += $transaction['ammount'];

        // creating check if total ammount is greater than 0 increase totalIncome else increase totalExpense //
        if ($transaction['ammount'] >= 0) {
            $totals['totalIncome'] += $transaction['ammount'];
        } else {
            $totals['totalExpense'] += $transaction['ammount'];
        }
    }
    return $totals;
}
