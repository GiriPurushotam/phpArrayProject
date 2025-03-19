<?php

declare(strict_types=1);

function formatDollar(float $ammount): string
{
    $isNegative = $ammount < 0;
    return ($isNegative ? '-' : '') . '$' . number_format(abs($ammount), 2);
}
/*
function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
} */
