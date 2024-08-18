<?php

if (!function_exists('getExcerpt')) {
    /**
     * Generate a text excerpt with a specified word limit.
     *
     * @param string $text
     * @param int $limit
     * @return string
     */
    function getExcerpt($text, $limit = 50)
    {
        $words = explode(' ', $text);

        if (count($words) <= $limit) {
            return $text;
        }

        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }

    
}

