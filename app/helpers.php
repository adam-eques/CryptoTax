<?php

if (! function_exists('money')) {
    /**
     * @param float|mixed $value
     * @param int $decimals
     * @return string
     */
    function money($value, int $decimals = 2) {
        return number_format($value, $decimals, ".", ",");
    }
}
