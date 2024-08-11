<?php

if (!function_exists('format_price')) {
    /**
     * Formate un prix en string avec deux décimales et le symbole euro.
     *
     * @param float $price
     * @return string
     */
    function format_price($price)
    {
        return number_format($price, 2, ',', ' ') . ' €';
    }
}

if (!function_exists('apply_discount')) {
    /**
     * Applique un pourcentage de réduction sur un prix donné.
     *
     * @param float $price
     * @param float $discountPercentage
     * @return float
     */
    function apply_discount($price, $discountPercentage)
    {
        return $price - ($price * ($discountPercentage / 100));
    }
}

if (!function_exists('calculate_tax')) {
    /**
     * Calcule la taxe sur un prix donné.
     *
     * @param float $price
     * @param float $taxPercentage
     * @return float
     */
    function calculate_tax($price, $taxPercentage)
    {
        return $price * ($taxPercentage / 100);
    }
}

if (!function_exists('format_price_with_tax')) {
    /**
     * Formate un prix avec la taxe incluse.
     *
     * @param float $price
     * @param float $taxPercentage
     * @return string
     */
    function format_price_with_tax($price, $taxPercentage)
    {
        $priceWithTax = $price + calculate_tax($price, $taxPercentage);
        return format_price($priceWithTax);
    }
}
