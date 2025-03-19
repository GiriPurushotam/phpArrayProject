<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee value;
        }

        tfoot tr th,
        tfoot tr,
        td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Ammount</th>
            </tr>
        </thead>
        <tbody>
            <!-- your code -->
            <?php if (! empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['date'] ?></td>
                        <td><?php echo $transaction['checkNumber'] ?></td>
                        <td><?php echo $transaction['discription'] ?></td>
                        <td>
                            <?php if ($transaction['ammount'] < 0): ?>
                                <span style="color: red;">
                                    <?php echo formatDollar($transaction['ammount']) ?>
                                </span>
                            <?php elseif ($transaction['ammount'] > 0): ?>
                                <span style="color: green;">
                                    <?php echo formatDollar($transaction['ammount']) ?>
                                </span>
                            <?php else: ?> <?php ($transaction['ammount'] < 0) ?>
                                <span>
                                    <?php echo formatDollar($transaction['ammount']) ?>
                                </span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <!-- your code -->
                    <?php echo formatDollar($totals['totalIncome']) ?? 0 ?>
                </td>
                <th colspan="3">Total Expense:</th>
                <td>
                    <!-- your code -->
                    <?php echo formatDollar($totals['totalExpense']) ?? 0 ?>
                </td>
                <th colspan="3">Net total:</th>
                <td><!-- your code -->
                    <?php formatDollar($totals['netTotal']) ?? 0 ?>
                </td>
            </tr>
        </tfoot>
    </table>

</body>

</html>