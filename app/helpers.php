<?php

if (! function_exists('moneyFormat')) {
    /**
     * @param float|mixed $value
     * @param int $decimals
     * @return string
     */
    function moneyFormat($value, int $decimals = 2) {
        return number_format($value, $decimals, ".", ",");
    }
}
